<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_kebutuhan', function (Blueprint $table) {
            $table->integer('id_item_kebutuhan', true);
            $table->integer('id_pengajuan_kebutuhan', false)->index('id_pengajuan_kebutuhan');
            $table->integer('id_gedung', false)->index('id_gedung');
            $table->string('item_kebutuhan', 60)->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->decimal('harga_satuan', 10, 0)->nullable(false);
            $table->string('satuan', 20)->nullable(false);
            $table->string('spesifikasi', 225)->nullable(false);
            $table->enum('status', ['-', 'Ditolak', 'Diterima'])->default('-')->nullable(false);
            $table->datetime('kedaluwarsa')->nullable(true);
            $table->text('foto_barang_kebutuhan')->nullable(false);

            $table->foreign('id_pengajuan_kebutuhan')->on('pengajuan_kebutuhan')->references('id_pengajuan_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_gedung')->on('gedung')->references('id_gedung')->onUpdate
            ('cascade')->onDelete('cascade');

        });

        // EVENT
        DB::unprepared('DROP EVENT IF EXISTS event_kedaluwarsa_itemKebutuhan');
        DB::unprepared("
        CREATE EVENT event_kedaluwarsa_itemKebutuhan
        ON SCHEDULE EVERY 1 DAY
        ON COMPLETION PRESERVE
        DO
        BEGIN
          DELETE FROM pengajuan_kebutuhan
          WHERE status = 'Ditolak' AND kedaluwarsa IS NOT NULL AND kedaluwarsa <= NOW();
        END;        
        ");
     
        DB::unprepared('DROP TRIGGER IF EXISTS setKedaluwarsaItemKebutuhan');
        DB::unprepared("
        CREATE TRIGGER setKedaluwarsaItemKebutuhan
        BEFORE UPDATE ON pengajuan_kebutuhan
        FOR EACH ROW
        BEGIN
            IF NEW.status = 'Ditolak' THEN
                SET NEW.kedaluwarsa = DATE_ADD(NOW(), INTERVAL 1 MONTH);
            END IF;
        END;
        ");

        DB::statement('SET GLOBAL event_scheduler = "ON"');

        // VIEW
        DB::unprepared('DROP VIEW IF EXISTS view_pengajuan_kebutuhan');
        DB::unprepared(
            "CREATE VIEW view_pengajuan_kebutuhan AS 
            SELECT i.id_item_kebutuhan, 
                    p.id_pengajuan_kebutuhan,
                    g.nama_gedung, g.nama_ruangan, i.item_kebutuhan, 
                    i.qty, 
                    i.harga_satuan,  
                    i.satuan, 
                    i.spesifikasi, 
                    i.status, 
                    i.foto_barang_kebutuhan 
            from item_kebutuhan AS i
            INNER JOIN pengajuan_kebutuhan AS p ON i.id_pengajuan_kebutuhan = p.id_pengajuan_kebutuhan
            INNER JOIN gedung AS g ON i.id_gedung = g.id_gedung
            "
        );

        // VIEW
        DB::unprepared('DROP VIEW IF EXISTS view_item_diterima');
        DB::unprepared(
            "CREATE VIEW view_item_diterima AS 
            SELECT i.id_item_kebutuhan, 
                    p.id_pengajuan_kebutuhan,
                    i.harga_satuan,  
                    i.qty,  
                    i.status
            from item_kebutuhan AS i
            INNER JOIN pengajuan_kebutuhan AS p ON i.id_pengajuan_kebutuhan = p.id_pengajuan_kebutuhan
            where i.status = 'Diterima' OR i.status = '-';
            "
        );

        // STORED FUNCTION
        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_kebutuhan');
        DB::unprepared('
        CREATE FUNCTION total_dana_kebutuhan(p_id_pengajuan_kebutuhan INT) RETURNS DECIMAL(10,0)
        BEGIN
        DECLARE total DECIMAL(10,0);
        SELECT SUM(qty * harga_satuan) INTO total from view_item_diterima where id_pengajuan_kebutuhan = p_id_pengajuan_kebutuhan;
        RETURN total;
        END
        '); 

        // TRIGGER
        DB::unprepared('DROP TRIGGER IF EXISTS setStatusItem');
        DB::unprepared("
        CREATE TRIGGER setStatusItem AFTER UPDATE ON pengajuan_kebutuhan FOR EACH ROW
        BEGIN
        if NEW.status = 'Difilterisasi' THEN
        UPDATE item_kebutuhan set status = 'Diterima' where id_pengajuan_kebutuhan = NEW.id_pengajuan_kebutuhan;
        END IF;
        END
        ");

        DB::unprepared('DROP TRIGGER IF EXISTS emptyItem_DeletePengajuan');
        DB::unprepared("
        CREATE TRIGGER emptyItem_DeletePengajuan AFTER UPDATE ON item_kebutuhan FOR EACH ROW
        BEGIN
        DECLARE list INT;
        SELECT COUNT(*) into list FROM item_kebutuhan where id_pengajuan_kebutuhan = NEW.id_pengajuan_kebutuhan AND (status = '-' OR status = 'Diterima');
        if list = 0 THEN
        UPDATE pengajuan_kebutuhan set status = 'Ditolak' where id_pengajuan_kebutuhan = NEW.id_pengajuan_kebutuhan;
        END IF;
        END
        ");

        DB::unprepared("
        CREATE TRIGGER tambah_item_kebutuhan AFTER INSERT ON item_kebutuhan FOR EACH ROW
        BEGIN
            INSERT INTO logs(aksi, aktivitas, waktu)
            VALUES ('INSERT', CONCAT('Menambahkan Item Kebutuhan baru dengan item ', NEW.item_kebutuhan), NOW());
        END
        ");
        
        DB::unprepared("
            CREATE TRIGGER update_item_kebutuhan AFTER UPDATE ON item_kebutuhan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Memperbarui Item Kebutuhan dengan item ', OLD.item_kebutuhan, ' dan ID Item Kebutuhan ', OLD.id_item_kebutuhan), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER hapus_item_kebutuhan AFTER DELETE ON item_kebutuhan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Item Kebutuhan dengan item ', OLD.item_kebutuhan), NOW());
            END
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_kebutuhan');
        DB::statement('SET GLOBAL event_scheduler = "OFF"');
    }
};
