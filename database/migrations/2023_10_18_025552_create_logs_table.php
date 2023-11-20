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
        Schema::create('log', function (Blueprint $table) {
            $table->integer('id_logs',true);
            $table->string('aksi',60)->nullable(false);
            $table->string('aktivitas',225)->nullable(false);
            $table->datetime('waktu')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
