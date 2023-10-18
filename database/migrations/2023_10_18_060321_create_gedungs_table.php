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
        Schema::create('gedung', function (Blueprint $table) {
         $table->integer('id_gedung', true);
         $table->string('nama_gedung', 60)->nullable(false);
         $table->string('nama_ruangan', 60)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
};
