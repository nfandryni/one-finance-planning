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
            $table->integer('id_gedung', false)->index('id_gedung')->nullable(false);
            $table->string('item_perencanaan', 60)->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->decimal('harga_satuan', 10, 0)->nullable(false);
            $table->string('satuan', 20)->nullable(false);
            $table->string('spesifikasi', 225)->nullable(false);
            $table->string('bulan_rencana_realisasi', 50)->nullable(false);
            $table->enum('status',['Terbeli','Belum Dibeli'])->default("Belum Dibeli")->nullable(false);
            $table->text('foto_barang_perencanaan')->nullable(false);
            $table->text('foto_realisasi')->nullable(true);

            $table->foreign('id_item_kebutuhan')->on('item_kebutuhan')->references('id_item_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_perencanaan_keuangan')->on('perencanaan_keuangan')->references('id_perencanaan_keuangan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_realisasi')->on('realisasi')->references('id_realisasi')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_gedung')->on('gedung')->references('id_gedung')->onUpdate
            ('cascade')->onDelete('cascade');
            
        });
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_realisasi');
        DB::unprepared("
        CREATE TRIGGER tambah_realisasi AFTER UPDATE ON perencanaan_keuangan FOR EACH ROW
        BEGIN
            INSERT INTO realisasi(id_perencanaan_keuangan, judul_realisasi, tujuan, waktu, total_pembayaran)
            VALUES (NEW.id_perencanaan_keuangan, NEW.judul_perencanaan, NEW.tujuan, NEW.waktu, NEW.total_dana_perencanaan);
        END
        ");

        DB::unprepared('DROP VIEW IF EXISTS view_perencanaan_keuangan');

        DB::unprepared(
            "CREATE VIEW view_perencanaan_keuangan AS 
            SELECT i.id_item_perencanaan,
            p.id_perencanaan_keuangan, 
            g.nama_gedung,
            g.nama_ruangan,
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
            INNER JOIN gedung AS g ON i.id_gedung = g.id_gedung
            "
        );        
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_total_perencanaan');
        DB::unprepared("
        CREATE TRIGGER tambah_total_perencanaan AFTER INSERT ON item_perencanaan FOR EACH ROW
        BEGIN
        DECLARE list INT;
        SELECT COUNT(*) into list from item_perencanaan;
        IF list > 1 THEN
        UPDATE perencanaan_keuangan set total_dana_perencanaan = total_dana_perencanaan + (NEW.qty * NEW.harga_satuan);
        ELSE
            UPDATE perencanaan_keuangan set total_dana_perencanaan = NEW.qty * NEW.harga_satuan;
        END if;
        END
    
    ");
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_perencanaan');
        DB::unprepared("
        CREATE TRIGGER update_total_perencanaan AFTER UPDATE ON item_perencanaan FOR EACH ROW
        BEGIN
        UPDATE perencanaan_keuangan set total_dana_perencanaan = (SELECT SUM(NEW.qty * NEW.harga_satuan) FROM perencanaan_keuangan);
        END
    
    ");
        DB::unprepared('DROP TRIGGER IF EXISTS hapus_total_perencanaan');
        DB::unprepared("
        CREATE TRIGGER hapus_total_perencanaan AFTER DELETE ON item_perencanaan FOR EACH ROW
        BEGIN
        UPDATE perencanaan_keuangan set total_dana_perencanaan = total_dana_perencanaan - (OLD.qty * OLD.harga_satuan);
        END
    
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_perencanaan');
    }
};
