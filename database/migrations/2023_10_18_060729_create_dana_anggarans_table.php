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
        Schema::create('dana_anggaran', function (Blueprint $table) {
         $table->integer('id_dana_anggaran', true);
         $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
         $table->integer('jumlah_dana', false)->nullable(false);

         $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dana_anggaran');
    }
};
