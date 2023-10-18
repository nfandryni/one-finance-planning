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
        Schema::create('perencanaan_keuangan', function (Blueprint $table) {
            $table->integer('id_perencanaan_keuangan', true)->nullable(true);
            $table->integer('id_pengajuan_kebutuhan', false)->index('id_pengajuan_kebutuhan');
            $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
            $table->string('judul_perencanaan', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->datetime('waktu')->nullable(false);
            $table->decimal('total_dana_perencanaan', 10,2)->nullable(false);
           

            $table->foreign('id_pengajuan_kebutuhan')->on('pengajuan_kebutuhan')->references('id_pengajuan_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate
            ('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perencanaan_keuangan');
    }
};
