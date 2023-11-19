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
        Schema::create('pengajuan_kebutuhan', function (Blueprint $table) {
            $table->integer('id_pengajuan_kebutuhan', true);
            $table->integer('id_pemohon', false)->index('id_pemohon');
            $table->string('nama_kegiatan', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->string('status', 25)->default('Draf')->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->decimal('total_dana_kebutuhan', 10,2)->nullable(true);

            $table->foreign('id_pemohon')->on('pemohon')->references('id_pemohon')->onUpdate
            ('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kebutuhan');
    }
};
