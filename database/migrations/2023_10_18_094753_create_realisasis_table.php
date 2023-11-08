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
        Schema::create('realisasi', function (Blueprint $table) {
            $table->integer('id_realisasi', true);
            $table->integer('id_perencanaan_keuangan', false)->nullable(true)->index('id_perencanaan_keuangan');
            $table->integer('id_pengeluaran', false)->index('id_pengeluaran');
            $table->string('judul_realisasi', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->datetime('waktu')->nullable(false);
            $table->decimal('total_pembayaran', 10,2)->nullable(false);
           

            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_pengeluaran')->on('pengeluaran')->references('id_pengeluaran')->onUpdate
            ('cascade')->onDelete('cascade');

            DB::unprepared('DROP VIEW IF EXISTS view_realisasi');

            DB::unprepared(
                "CREATE VIEW view_realisasi AS 
                SELECT .id_pemasukan, s.nama_sumber, b.email, p.nama, p.nominal, p.waktu, p.file from pemasukan AS p
                INNER JOIN perencanaan_keuangan AS p ON p.id_sumber_dana = s.id_sumber_dana
                INNER JOIN item_perencanaan AS i ON p.id_sumber_dana = s.id_sumber_dana
                INNER JOIN realisasi AS r ON p.id_bendahara = b.id_bendahara
                "
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
