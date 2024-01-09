<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_kebutuhan', function (Blueprint $table) {
            $table->integer('id_pengajuan_kebutuhan', true);
            $table->integer('id_pemohon', false)->index('id_pemohon');
            $table->string('nama_kegiatan', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->enum('status', ['Draf', 'Terkirim', 'Difilterisasi', 'DiKonfirmasi', 'Ditolak'])->default('Draf')->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->datetime('kedaluwarsa')->nullable(true);
            $table->decimal('total_dana_kebutuhan', 10, 0)->nullable(true);
   
            $table->foreign('id_pemohon')->on('pemohon')->references('id_pemohon')->onUpdate
            ('cascade')->onDelete('cascade');
        });

        DB::unprepared('DROP EVENT IF EXISTS event_kedaluwarsa_pengajuanKebutuhan');
        DB::unprepared("
        CREATE EVENT event_kedaluwarsa_pengajuanKebutuhan
        ON SCHEDULE EVERY 1 DAY
        ON COMPLETION PRESERVE
        DO
        BEGIN
          DELETE FROM pengajuan_kebutuhan
          WHERE status = 'Ditolak' AND kedaluwarsa IS NOT NULL AND kedaluwarsa <= NOW();
        END;        
        ");

        DB::unprepared('DROP TRIGGER IF EXISTS setKedaluwarsaPengajuan');
        DB::unprepared("
        CREATE TRIGGER setKedaluwarsaPengajuan
        BEFORE UPDATE ON pengajuan_kebutuhan
        FOR EACH ROW
        BEGIN
            IF NEW.status = 'Ditolak' THEN
                SET NEW.kedaluwarsa = DATE_ADD(NOW(), INTERVAL 1 MONTH);
            END IF;
        END;
        ");


        DB::unprepared('DROP FUNCTION IF EXISTS total_pengajuan_kebutuhan');
        DB::unprepared('
        CREATE FUNCTION total_pengajuan_kebutuhan() RETURNS INT
        BEGIN
        DECLARE total INT;
        SELECT COUNT(*) INTO total from pengajuan_kebutuhan;
        RETURN total;
        END
        '); 

        DB::unprepared('DROP VIEW IF EXISTS view_pengajuan_pemohon');

        DB::unprepared(
            "CREATE VIEW view_pengajuan_pemohon AS 
            SELECT  p.id_pengajuan_kebutuhan,
                    m.nama, 
                    m.user_id,
                    p.nama_kegiatan, 
                    p.tujuan,
                    p.status,
                    p.waktu,
                    p.total_dana_kebutuhan
            from pengajuan_kebutuhan AS p
            INNER JOIN pemohon AS m ON p.id_pemohon = m.id_pemohon
            "
        );

         DB::unprepared('DROP PROCEDURE IF EXISTS tambah_pengajuan_kebutuhan');
         DB::unprepared('
         CREATE PROCEDURE tambah_pengajuan_kebutuhan( 
            IN id_pemohon INT(11),
            IN nama_kegiatan VARCHAR(255),
            IN tujuan VARCHAR(255),
            IN waktu DATE
            )
         BEGIN
         DECLARE pesan_error CHAR(5) DEFAULT "000";
         DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING
 
         BEGIN
         GET DIAGNOSTICS CONDITION 1
         pesan_error = RETURNED_SQLSTATE;
         END;
         
         START TRANSACTION;
         SAVEPOINT satu;
         INSERT INTO pengajuan_kebutuhan(
            id_pemohon,
            nama_kegiatan,
            tujuan,
            waktu
         ) VALUES (
            id_pemohon,
            nama_kegiatan,
            tujuan,
            waktu
         );
 
         IF pesan_error != "000" THEN ROLLBACK TO satu;
         END IF;
         COMMIT;
         END;
         ');

        DB::unprepared("
        CREATE TRIGGER tambah_pengajuan_kebutuhan AFTER INSERT ON pengajuan_kebutuhan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('INSERT', CONCAT('Menambahkan Pengajuan Kebutuhan baru dengan nama_kegiatan ', NEW.nama_kegiatan), NOW());
        END
        ");
        
        DB::unprepared("
            CREATE TRIGGER update_pengajuan_kebutuhan AFTER UPDATE ON pengajuan_kebutuhan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Memperbarui Pengajuan Kebutuhan dengan nama_kegiatan ', OLD.nama_kegiatan, ' dan ID Pengajuan Kebutuhan ', OLD.id_pengajuan_kebutuhan), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER hapus_pengajuan_kebutuhan AFTER DELETE ON pengajuan_kebutuhan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Pengajuan Kebutuhan dengan nama_kegiatan ', OLD.nama_kegiatan), NOW());
            END
        ");

        DB::unprepared("
        CREATE TRIGGER konfirmasi AFTER UPDATE ON pengajuan_kebutuhan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Mengkonfirmasi Pengajuan Kebutuhan dengan nama_kegiatan ', OLD.nama_kegiatan, ' dan ID Pengajuan Kebutuhan ', OLD.id_pengajuan_kebutuhan), NOW());
            END
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kebutuhan');
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_pengajuan_kebutuhan');
        DB::unprepared('DROP TRIGGER IF EXISTS update_pengajuan_kebutuhan');
        DB::unprepared('DROP TRIGGER IF EXISTS delete_pengajuan_kebutuhan');
    }
};
