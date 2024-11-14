<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gedung', function (Blueprint $table) {
         $table->integer('id_gedung', true);
         $table->string('nama_gedung', 60)->nullable(false);
         $table->string('nama_ruangan', 60)->nullable(false);
        });

        // STORED PROCEDURE & COMMIT ROLLBACK 
        DB::unprepared('DROP PROCEDURE IF EXISTS tambah_gedung');
        DB::unprepared('
        CREATE PROCEDURE tambah_gedung( IN gedung VARCHAR(255), IN ruangan VARCHAR(255) )
        BEGIN
        DECLARE pesan_error CHAR(5) DEFAULT "000";
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING

        BEGIN
        GET DIAGNOSTICS CONDITION 1
        pesan_error = RETURNED_SQLSTATE;
        END;
      
        START TRANSACTION;
        savepoint satu;
        INSERT INTO gedung(nama_gedung, nama_ruangan) VALUES (gedung, ruangan);

        IF pesan_error != "000" THEN ROLLBACK TO satu;  
        END IF;
        COMMIT;

        END;
        '); 
       
        // TRIGGER
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_gedung');
        DB::unprepared("
        CREATE TRIGGER tambah_gedung AFTER INSERT ON gedung FOR EACH ROW
        BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('INSERT', CONCAT('Menambahkan Gedung baru dengan nama ', NEW.nama_gedung, ' dan ruangan dengan nama ', NEW.nama_ruangan), NOW());
            END
        ");

        DB::unprepared('DROP TRIGGER IF EXISTS update_gedung');
        DB::unprepared("
        CREATE TRIGGER update_gedung AFTER UPDATE ON gedung FOR EACH ROW
        BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('UPDATE', CONCAT('Memperbarui Gedung dari ', OLD.nama_gedung, ' dan ', OLD.nama_ruangan, ' menjadi ', NEW.nama_gedung, ' dan ', NEW.nama_ruangan), NOW());
            END
        ");
        
        DB::unprepared('DROP TRIGGER IF EXISTS hapus_gedung');
        DB::unprepared("
        CREATE TRIGGER hapus_gedung AFTER DELETE ON gedung FOR EACH ROW
        BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Gedung dengan nama ', OLD.nama_gedung), NOW());
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
};
