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
