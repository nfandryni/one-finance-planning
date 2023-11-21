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
        Schema::create('gedung', function (Blueprint $table) {
         $table->integer('id_gedung', true);
         $table->string('nama_gedung', 60)->nullable(false);
         $table->string('nama_ruangan', 60)->nullable(false);
        });

        DB::unprepared('DROP PROCEDURE IF EXISTS tambah_gedung');
        DB::unprepared('
        CREATE PROCEDURE tambah_gedung( IN gedung VARCHAR(255), IN ruangan VARCHAR(255))
        BEGIN
        DECLARE pesan_error CHAR(5) DEFAULT "000";
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING

        BEGIN
        GET DIAGNOSTICS CONDITION 1
        pesan_error = RETURNED_SQLSTATE;
        END;
      
        START TRANSACTION;
        savepoint satu;
        INSERT INTO gedung(nama_gedung, nama_ruangan) VALUES (gedung, ruangan);

        IF pesan_error != "000" THEN ROLLBACK TO satu;  
        END IF;
        COMMIT;

        END;
        '); 
       

        // DB::unprepared('DROP PROCEDURE IF EXISTS rollback');

        // DB::unprepared('
        // CREATE PROCEDURE ROLLBACK()
        // BEGIN
      
        // START TRANSACTION;
        // DELETE * FROM gedung WHERE nama_gedung = gedung AND nama_ruangan = ruangan;
        // ROLLBACK;
        // END;
        // ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
};
