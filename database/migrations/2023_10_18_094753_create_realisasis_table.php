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
        Schema::create('realisasi', function (Blueprint $table) {
            $table->integer('id_realisasi', true);
            $table->integer('id_perencanaan_keuangan', false)->index('id_perencanaan_keuangan');
            $table->string('judul_realisasi', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->decimal('total_pembayaran', 10, 0)->nullable(false);
           

            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate
            ('cascade')->onDelete('cascade');
        });
    
    // VIEW
    // DB::unprepared('DROP VIEW IF EXISTS view_realisasi');
    // DB::unprepared(
    //     "CREATE VIEW view_realisasi AS 
    //     SELECT r.id_realisasi,
    //     r.id_perencanaan_keuangan, 
    //     r.judul_realisasi, 
    //     r.tujuan, 
    //     r.waktu, 
    //     r.total_pembayaran
    //     FROM realisasi AS r
    //     INNER JOIN perencanaan_keuangan AS p ON r.id_perencanaan_keuangan = p.id_perencanaan_keuangan
    //     "
    // );        

    // TRIGGER
    DB::unprepared("
    CREATE TRIGGER tambah_realisasi_trigger AFTER INSERT ON realisasi FOR EACH ROW
    BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('INSERT', CONCAT('Menambahkan Realisasi baru dengan nama_kegiatan ', NEW.judul_realisasi), NOW());
    END
    ");
    
    DB::unprepared("
        CREATE TRIGGER update_realisasi_trigger AFTER UPDATE ON realisasi FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('UPDATE', CONCAT('Memperbarui Realisasi dengan nama_kegiatan ', OLD.judul_realisasi, ' dan ID Realisasi ', OLD.id_realisasi), NOW());
        END
    ");
    
    DB::unprepared("
        CREATE TRIGGER hapus_realisasi_trigger AFTER DELETE ON realisasi FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('DELETE', CONCAT('Menghapus Realisasi dengan nama_kegiatan ', OLD.judul_realisasi), NOW());
        END
    ");
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
