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
        Schema::create('sumber_dana', function (Blueprint $table) {
            $table->integer('id_sumber_dana', true);
            $table->string('nama_sumber', 25)->nullable(false);
        });

        // TRIGGER
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_sumber_dana');
        DB::unprepared("
        CREATE TRIGGER tambah_sumber_dana AFTER INSERT ON sumber_dana FOR EACH ROW
        BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('INSERT', CONCAT('Menambahkan Sumber Dana baru dengan nama ', NEW.nama_sumber), NOW());
            END
        ");

        DB::unprepared('DROP TRIGGER IF EXISTS update_sumber_dana');
        DB::unprepared("
        CREATE TRIGGER update_sumber_dana AFTER UPDATE ON sumber_dana FOR EACH ROW
        BEGIN
        INSERT INTO logs(aksi, aktivitas, waktu)
        VALUES ('UPDATE', CONCAT('Memperbarui Sumber Dana dari ', OLD.nama_sumber, ' menjadi ', NEW.nama_sumber), NOW());
            END
        ");
        
        DB::unprepared('DROP TRIGGER IF EXISTS hapus_sumber_dana');
        DB::unprepared("
        CREATE TRIGGER hapus_sumber_dana AFTER DELETE ON sumber_dana FOR EACH ROW
        BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Sumber Dana dengan nama ', OLD.nama_sumber), NOW());
            END
        ");
        
        // STORED FUNCTION 
        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_sumberDana');
        DB::unprepared('
        CREATE FUNCTION total_dana_sumberDana(nama_sum VARCHAR(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci) RETURNS DECIMAL(10,0)
        BEGIN

        DECLARE total DECIMAL(10,0) DEFAULT 0;
        DECLARE pemasukan DECIMAL(10,0) DEFAULT 0;
        DECLARE pengeluaran DECIMAL(10,0) DEFAULT 0;

        BEGIN   
        DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET total = 0;
        SELECT SUM(nominal) into pemasukan from view_pemasukan where nama_sumber = nama_sum;
        SELECT SUM(nominal) into pengeluaran from view_pengeluaran where nama_sumber = nama_sum;
        IF pengeluaran IS NULL THEN 
            SET total = pemasukan;
        ELSEIF pemasukan IS NULL THEN 
            SET total = -pengeluaran;
        ELSE
        SET total = pemasukan - pengeluaran;
        END IF;
        END;

        RETURN total;
        END
        '); 
      
        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_anggaran');
        DB::unprepared('
        CREATE FUNCTION total_dana_anggaran() RETURNS decimal(10,0)
        BEGIN

        DECLARE total DECIMAL(10,0) DEFAULT 0;
        DECLARE pemasukan DECIMAL(10,0) DEFAULT 0;
        DECLARE pengeluaran DECIMAL(10,0) DEFAULT 0;

        BEGIN
        DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET total = 0;
        SELECT SUM(nominal) into pemasukan from view_pemasukan;
        SELECT SUM(nominal) into pengeluaran from view_pengeluaran;
        IF pengeluaran IS NULL THEN 
            SET total = pemasukan;
        ELSEIF pemasukan IS NULL THEN 
            SET total = -pengeluaran;
        ELSE
        SET total = pemasukan - pengeluaran;
        END IF;
        END;

        RETURN total;
        END
        '); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_dana');
    }
};
