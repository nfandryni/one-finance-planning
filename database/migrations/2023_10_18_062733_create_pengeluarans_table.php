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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->integer('id_pengeluaran', true);
            $table->integer('id_bendahara', false)->index('id_bendahara');
            $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
            $table->integer('id_jenis_pengeluaran', false)->index('id_jenis_pengeluaran');
            $table->string('nama', 60)->nullable(false);
            $table->decimal('nominal', 10, 2)->nullable(false);
            $table->datetime('waktu')->nullable(false);

            $table->foreign('id_bendahara')->on('bendahara_sekolah')->references('id_bendahara')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jenis_pengeluaran')->on('jenis_pengeluaran')->references('id_jenis_pengeluaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
