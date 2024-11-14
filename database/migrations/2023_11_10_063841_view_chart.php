<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_chart');

        DB::unprepared(
            "CREATE VIEW v_chart AS 
            SELECT COUNT(user_id) AS totalRole, role
            FROM akun 
            GROUP BY role
            "
        );
    }

    
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS v_chart');
    }
};
