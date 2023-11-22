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
        Schema::create('item_perencanaan', function (Blueprint $table) {
            $table->integer('id_item_perencanaan', true);
            $table->integer('id_item_kebutuhan', false)->nullable(true)->index('id_item_kebutuhan');
            $table->integer('id_perencanaan_keuangan', false)->index('id_perencanaan_keuangan');
            $table->integer('id_realisasi', false)->index('id_realisasi')->nullable(true);
            $table->string('item_perencanaan', 60)->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->integer('harga_satuan', false)->nullable(false);
            $table->string('satuan', 20)->nullable(false);
            $table->string('spesifikasi', 225)->nullable(false);
            $table->date('bulan_rencana_realisasi')->nullable(false);
            $table->enum('status',['Terbeli','Belum Dibeli'])->default("Belum Dibeli")->nullable(false);
            $table->text('foto_barang_perencanaan')->nullable(false);
            $table->text('foto_realisasi')->nullable(true);

            $table->foreign('id_item_kebutuhan')->on('item_kebutuhan')->references('id_item_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_realisasi')->on('realisasi')->references('id_realisasi')->onUpdate
            ('cascade')->onDelete('cascade');

            
        });
        DB::unprepared('DROP VIEW IF EXISTS view_realisasi');

        DB::unprepared(
            "CREATE VIEW view_realisasi AS 
            SELECT i.id_item_perencanaan,
            p.id_perencanaan_keuangan, 
            r.id_realisasi, 
            i.item_perencanaan, 
            i.qty, 
            i.harga_satuan, 
            i.satuan, 
            i.spesifikasi, 
            i.bulan_rencana_realisasi, 
            i.status, 
            i.foto_barang_perencanaan, 
            i.foto_realisasi 
            from item_perencanaan AS i
            INNER JOIN perencanaan_keuangan AS p ON i.id_perencanaan_keuangan = p.id_perencanaan_keuangan
            INNER JOIN realisasi AS r ON i.id_realisasi = r.id_realisasi
            "
        );        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_perencanaan');
    }
};
