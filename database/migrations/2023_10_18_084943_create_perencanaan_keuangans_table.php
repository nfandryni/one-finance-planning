<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perencanaan_keuangan', function (Blueprint $table) {
            $table->integer('id_perencanaan_keuangan', true)->nullable(true);
            $table->integer('id_pengajuan_kebutuhan', false)->index('id_pengajuan_kebutuhan')->nullable(true);
            $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
            $table->string('judul_perencanaan', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->decimal('total_dana_perencanaan', 10, 0)->nullable(true);
           

            $table->foreign('id_pengajuan_kebutuhan')->on('pengajuan_kebutuhan')->references('id_pengajuan_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate
            ('cascade')->onDelete('cascade');
        });

    // TRIGGER
    DB::unprepared("
    CREATE TRIGGER tambah_perencanaan_keuangan AFTER INSERT ON perencanaan_keuangan FOR EACH ROW
    BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('INSERT', CONCAT('Menambahkan Perencanaan Keuangan baru dengan nama_kegiatan ', NEW.judul_perencanaan), NOW());
    END
    ");
    
    DB::unprepared("
        CREATE TRIGGER update_perencanaan_keuangan AFTER UPDATE ON perencanaan_keuangan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('UPDATE', CONCAT('Memperbarui Perencanaan Keuangan dengan nama_kegiatan ', OLD.judul_perencanaan, ' dan ID Perencanaan Keuangan', OLD.id_perencanaan_keuangan), NOW());
        END
    ");
    
    DB::unprepared("
        CREATE TRIGGER hapus_perencanaan_keuangan AFTER DELETE ON perencanaan_keuangan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('DELETE', CONCAT('Menghapus Perencanaan Keuangan dengan nama_kegiatan ', OLD.judul_perencanaan), NOW());
        END
    ");

   
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perencanaan_keuangan');
    }
};
