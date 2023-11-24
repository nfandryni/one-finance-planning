<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_pengeluaran', function (Blueprint $table) {
         $table->integer('id_jenis_pengeluaran', true);
         $table->string('kategori', 225)->nulllable(false);
        });

        // Stored Procedur dan Commit Rollback
        DB::unprepared('DROP PROCEDURE IF EXISTS tambah_jenis_pengeluaran');
        DB::unprepared('
        CREATE PROCEDURE tambah_jenis_pengeluaran( IN kategori VARCHAR(255))
        BEGIN
        DECLARE pesan_error CHAR(5) DEFAULT "000";
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING

        BEGIN
        GET DIAGNOSTICS CONDITION 1
        pesan_error = RETURNED_SQLSTATE;
        END;
        
        START TRANSACTION;
        SAVEPOINT satu;
        INSERT INTO jenis_pengeluaran(kategori) VALUES (kategori);

        IF pesan_error != "000" THEN ROLLBACK TO satu;
        END IF;
        COMMIT;
        END;
        '); 

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pengeluaran');
    }
};