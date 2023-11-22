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
            $table->integer('id_perencanaan_keuangan', false)->nullable(true)->index('id_perencanaan_keuangan');
            $table->integer('id_pengeluaran', false)->index('id_pengeluaran')->nullable(true);
            $table->string('judul_realisasi', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->integer('total_pembayaran', false)->nullable(false);
           

            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_pengeluaran')->on('pengeluaran')->references('id_pengeluaran')->onUpdate
            ('cascade')->onDelete('cascade');
        });

        DB::unprepared("
        CREATE TRIGGER tambah_realisasi AFTER INSERT ON perencanaan_keuangan FOR EACH ROW
        BEGIN
            INSERT INTO realisasi(id_perencanaan_keuangan, judul_realisasi, tujuan, waktu, total_pembayaran)
            VALUES (NEW.id_perencanaan_keuangan, NEW.judul_perencanaan, NEW.tujuan, NEW.waktu, NEW.total_dana_perencanaan);
        END
    ");

    DB::unprepared('DROP VIEW IF EXISTS view_realisasi');

    DB::unprepared(
        "CREATE VIEW view_realisasi AS 
        SELECT r.id_realisasi,
        r.id_perencanaan_keuangan, 
        k.nama, 
        r.judul_realisasi, 
        r.tujuan, 
        r.waktu, 
        r.total_pembayaran
        FROM realisasi AS r
        INNER JOIN perencanaan_keuangan AS p ON r.id_perencanaan_keuangan = p.id_perencanaan_keuangan
        INNER JOIN pengeluaran AS k ON r.id_pengeluaran = k.id_pengeluaran
        "
    );        
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
