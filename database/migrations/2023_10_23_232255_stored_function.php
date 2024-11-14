<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        
        DB::unprepared('DROP FUNCTION IF EXISTS TotalAcc');
        //digunakan untuk menghitung total akun yang ada pada table akun
        DB::unprepared(
            'CREATE FUNCTION TotalAcc() RETURNS INT
            BEGIN 
            DECLARE TotalAccount INT;
            SELECT COUNT(user_id) INTO TotalAccount FROM akun ;
            RETURN TotalAccount;
            END'
        );

        DB::unprepared('DROP FUNCTION IF EXISTS TotalRealisasi');
        DB::unprepared(
            'CREATE FUNCTION TotalRealisasi() RETURNS INT
            BEGIN 
            DECLARE total_realisasi INT;
            SELECT COUNT(*) INTO total_realisasi FROM item_perencanaan WHERE status = "Terbeli";
            RETURN total_realisasi;
            END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
