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
        Schema::create('item_perencanaan', function (Blueprint $table) {
            $table->integer('id_item_perencanaan', true);
            $table->integer('id_item_kebutuhan', false)->nullable(true)->index('id_item_kebutuhan');
            $table->integer('id_perencanaan_keuangan', false)->index('id_perencanaan_keuangan');
            $table->integer('id_realisasi', false)->index('id_realisasi');
            $table->string('item_perencanaan', 60)->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->decimal('harga_satuan', 10,2)->nullable(false);
            $table->string('satuan', 20)->nullable(false);
            $table->string('spesifikasi', 225)->nullable(false);
            $table->date('bulan_rencana_realisasi')->nullable(false);
            $table->enum('status',['Terbeli','Belum Dibeli'])->default("Belum Dibeli")->nullable(false);
            $table->text('foto_barang_perencanaan')->nullable(false);
            $table->text('foto_realisasi')->nullable(false);

            $table->foreign('id_item_kebutuhan')->on('item_kebutuhan')->references('id_item_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_realisasi')->on('realisasi')->references('id_realisasi')->onUpdate
            ('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_perencanaan');
    }
};
