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
        Schema::create('sumber_dana', function (Blueprint $table) {
            $table->integer('id_sumber_dana', true);
            $table->string('nama_sumber', 25)->nullable(false);
        });

        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_BOS');
        DB::unprepared('
        CREATE FUNCTION total_dana_BOS() RETURNS INT
        BEGIN

        DECLARE total INT DEFAULT 0;
        DECLARE pemasukan INT DEFAULT 0;
        DECLARE pengeluaran INT DEFAULT 0;

        BEGIN
        DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET total = 0;
        SELECT SUM(nominal) into pemasukan from view_pemasukan where nama_sumber = "BOS";
        SELECT SUM(nominal) into pengeluaran from view_pengeluaran where nama_sumber = "BOS";
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
        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_komite');
        DB::unprepared('
        CREATE FUNCTION total_dana_komite() RETURNS INT
        BEGIN

        DECLARE total INT DEFAULT 0;
        DECLARE pemasukan INT DEFAULT 0;
        DECLARE pengeluaran INT DEFAULT 0;

        BEGIN
        DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET total = 0;
        SELECT SUM(nominal) into pemasukan from view_pemasukan where nama_sumber = "komite";
        SELECT SUM(nominal) into pengeluaran from view_pengeluaran where nama_sumber = "komite";
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
        DB::unprepared('DROP FUNCTION IF EXISTS total_dana_BOPD');
        DB::unprepared('
        CREATE FUNCTION total_dana_BOPD() RETURNS INT
        BEGIN

        DECLARE total INT DEFAULT 0;
        DECLARE pemasukan INT DEFAULT 0;
        DECLARE pengeluaran INT DEFAULT 0;

        BEGIN
        DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET total = 0;
        SELECT SUM(nominal) into pemasukan from view_pemasukan where nama_sumber = "BOPD";
        SELECT SUM(nominal) into pengeluaran from view_pengeluaran where nama_sumber = "BOPD";
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
        CREATE FUNCTION total_dana_anggaran() RETURNS INT
        BEGIN

        DECLARE total INT DEFAULT 0;
        DECLARE pemasukan INT DEFAULT 0;
        DECLARE pengeluaran INT DEFAULT 0;

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
