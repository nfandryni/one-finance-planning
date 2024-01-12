<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_SuperAdmin');

        DB::unprepared(
            "CREATE VIEW v_SuperAdmin AS SELECT
                super_admin.id_superadmin, 
                akun.user_id, 
                akun.role, 
                super_admin.nama, 
                super_admin.email,
                super_admin.jabatan, 
                super_admin.foto_profil
            FROM super_admin INNER JOIN akun  
            ON super_admin.user_id = akun.user_id;
            "
        );

        DB::unprepared('DROP VIEW IF EXISTS v_admin');

        DB::unprepared(
            "CREATE VIEW v_admin AS SELECT
                admin.id_admin, 
                akun.user_id, 
                akun.role, admin.nama, 
                admin.email, 
                admin.jabatan, 
                admin.foto_profil
            FROM admin INNER JOIN akun  
            ON admin.user_id = akun.user_id; "
        );

        DB::unprepared('DROP VIEW IF EXISTS v_bendahara');

        DB::unprepared(
            "CREATE VIEW v_bendahara AS SELECT
                bendahara_sekolah.id_bendahara, 
                akun.user_id, 
                akun.role, 
                bendahara_sekolah.nama, 
                bendahara_sekolah.email, 
                bendahara_sekolah.jabatan, 
                bendahara_sekolah.foto_profil
            FROM bendahara_sekolah INNER JOIN akun  
            ON bendahara_sekolah.user_id = akun.user_id;"
        );

        DB::unprepared('DROP VIEW IF EXISTS v_pemohon');

        DB::unprepared(
            "CREATE VIEW v_pemohon AS SELECT
                pemohon.id_pemohon, 
                akun.user_id, akun.role, 
                pemohon.nama, 
                pemohon.email, 
                pemohon.jabatan,
                pemohon.kategori, 
                pemohon.foto_profil
            FROM pemohon INNER JOIN akun 
            ON pemohon.user_id = akun.user_id;"
        );
    }

    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS v_SuperAdmin');
    }
};
