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
            $table->integer('id_pengeluaran', false)->index('id_pengeluaran')->nullable(true);
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
            $table->foreign('id_pengeluaran')->on('pengeluaran')->references('id_pengeluaran')->onUpdate
            ('cascade')->onDelete('cascade');
            
        });
        
        // TRIGGER
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_realisasi');
        DB::unprepared("
        CREATE TRIGGER tambah_realisasi AFTER UPDATE ON item_perencanaan FOR EACH ROW
        BEGIN
        DECLARE judul VARCHAR(60);
        DECLARE tujuanp VARCHAR(255);
        DECLARE cekId INT;
        DECLARE statusi VARCHAR(255);
        DECLARE total_pembayaranp DECIMAL(10,0);
            SELECT id_perencanaan_keuangan into cekId from realisasi where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
            SELECT COUNT(*) into statusi from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan AND status = 'Terbeli';
        IF cekId IS NULL AND statusi >=1 THEN
            SELECT judul_perencanaan, tujuan into judul, tujuanp from perencanaan_keuangan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
            SELECT qty * harga_satuan into total_pembayaranp from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan AND status = 'Terbeli';
            INSERT INTO realisasi(id_perencanaan_keuangan, judul_realisasi, tujuan, waktu, total_pembayaran)
            VALUES (NEW.id_perencanaan_keuangan, judul, tujuanp, NOW(), total_pembayaranp);
        END IF;
        END;
        ");
    
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_realisasi');
        DB::unprepared("
        CREATE TRIGGER update_total_realisasi AFTER UPDATE ON item_perencanaan FOR EACH ROW
        BEGIN
        DECLARE list INT;
        DECLARE cekTotal DECIMAL(10,0);
        DECLARE totalLama DECIMAL(10,0);
        SELECT COUNT(*) into list from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan AND status = 'Terbeli';
        SELECT SUM(qty * harga_satuan) into cekTotal from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        SELECT COALESCE(total_pembayaran, 0) into totalLama from realisasi where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        IF cekTotal != TotalLama THEN
        IF list > 1 THEN
        UPDATE realisasi set total_pembayaran = total_pembayaran + (NEW.qty * NEW.harga_satuan) where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        ELSE
            UPDATE realisasi set total_pembayaran = NEW.qty * NEW.harga_satuan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        END if;
        END if;
        END
    ");

        DB::unprepared('DROP TRIGGER IF EXISTS tambah_total_perencanaan');
        DB::unprepared(
        "CREATE TRIGGER tambah_total_perencanaan AFTER INSERT ON item_perencanaan FOR EACH ROW
        BEGIN
        DECLARE list INT;
        DECLARE cekTotal DECIMAL(10,0);
        DECLARE totalLama DECIMAL(10,0);
        SELECT COUNT(*) into list from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        SELECT SUM(qty * harga_satuan) into cekTotal from item_perencanaan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        SELECT COALESCE(total_dana_perencanaan, 0) into totalLama from perencanaan_keuangan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        IF cekTotal != TotalLama THEN
        IF list > 1 THEN
        UPDATE perencanaan_keuangan set total_dana_perencanaan = totalLama + (NEW.qty * NEW.harga_satuan) where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        ELSE
            UPDATE perencanaan_keuangan set total_dana_perencanaan = NEW.qty * NEW.harga_satuan where id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        END if;
        END if;
        END
    ");
    
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_perencanaan');
        DB::unprepared("
        CREATE TRIGGER update_total_perencanaan AFTER UPDATE ON item_perencanaan FOR EACH ROW
        BEGIN
        DECLARE totalDana DECIMAL(10,0); 
        SELECT SUM(qty * harga_satuan) INTO totalDana FROM item_perencanaan
        WHERE id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        
        UPDATE perencanaan_keuangan
        SET total_dana_perencanaan = totalDana
        WHERE id_perencanaan_keuangan = NEW.id_perencanaan_keuangan;
        END;
    ");

        DB::unprepared('DROP TRIGGER IF EXISTS hapus_total_perencanaan');
        DB::unprepared("
        CREATE TRIGGER hapus_total_perencanaan AFTER DELETE ON item_perencanaan FOR EACH ROW
        BEGIN
        UPDATE perencanaan_keuangan set total_dana_perencanaan = total_dana_perencanaan - (OLD.qty * OLD.harga_satuan) where id_perencanaan_keuangan = OLD.id_perencanaan_keuangan;
        END
    ");

    DB::unprepared("
    CREATE TRIGGER tambah_item_perencanaan AFTER INSERT ON item_perencanaan FOR EACH ROW
    BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('INSERT', CONCAT('Menambahkan Item Perencanaan baru dengan item ', NEW.item_perencanaan), NOW());
    END
    ");
    
    DB::unprepared("
        CREATE TRIGGER update_item_perencanaan AFTER UPDATE ON item_perencanaan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('UPDATE', CONCAT('Memperbarui Item Perencanaan dengan item ', OLD.item_perencanaan, ' dan ID Item Perencanaan ', OLD.id_item_perencanaan), NOW());
        END
    ");
    
    DB::unprepared("
        CREATE TRIGGER hapus_item_perencanaan AFTER DELETE ON item_perencanaan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('DELETE', CONCAT('Menghapus Item Perencanaan dengan item ', OLD.item_perencanaan), NOW());
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
