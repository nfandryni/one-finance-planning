<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS createProfileAcc');
        //menambah akun baru 
        DB::unprepared('
            CREATE PROCEDURE createProfileAcc(
                IN new_username VARCHAR(60),
                IN new_password TEXT,
                IN new_role TEXT
            )
            BEGIN 
                DECLARE pesan_error CHAR(5) DEFAULT "00000";
                DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING
    
            BEGIN
                GET DIAGNOSTICS CONDITION 1 pesan_error = RETURNED_SQLSTATE;
            END;
    
            START TRANSACTION;
            SAVEPOINT satu;
    
            INSERT INTO akun (username, password, role) VALUES (new_username, new_password, new_role);
            
            IF pesan_error != "00000" THEN ROLLBACK TO satu;
            END IF;
            
            COMMIT;
            END;
                
        ');
    }

    
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS createProfileAcc');
    }
};
