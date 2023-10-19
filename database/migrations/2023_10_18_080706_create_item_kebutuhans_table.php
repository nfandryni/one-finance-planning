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
        Schema::create('item_kebutuhan', function (Blueprint $table) {
            $table->integer('id_item_kebutuhan', true);
            $table->integer('id_pengajuan_kebutuhan', false)->index('id_pengajuan_kebutuhan');
            $table->integer('id_gedung', false)->index('id_gedung');
            $table->string('item_kebutuhan', 60)->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->decimal('harga_satuan', 10,2)->nullable(false);
            $table->string('satuan', 20)->nullable(false);
            $table->string('spesifikasi', 225)->nullable(false);
            $table->text('foto_barang_kebutuhan')->nullable(false);

            $table->foreign('id_pengajuan_kebutuhan')->on('pengajuan_kebutuhan')->references('id_pengajuan_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_gedung')->on('gedung')->references('id_gedung')->onUpdate
            ('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_kebutuhan');
    }
};