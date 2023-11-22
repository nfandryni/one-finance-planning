<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared(
            'CREATE TRIGGER trgCreateAkun AFTER INSERT ON akun FOR EACH ROW
            BEGIN 
                DECLARE id_user INT;
                DECLARE uname VARCHAR(225);
                DECLARE role_akun TEXT ;

                SET id_user = NEW.user_id;
                SET uname = NEW.username;
                SET role_akun = NEW.role;

                IF role_akun = "superadmin" THEN
                    INSERT INTO super_admin (user_id, nama) VALUES (id_user, uname);
                END IF;

                IF role_akun = "admin" THEN
                    INSERT INTO admin (user_id, nama) VALUES (id_user, uname);
                END IF;

                IF role_akun = "bendaharasekolah" THEN
                    INSERT INTO bendahara_sekolah (user_id, nama) VALUES (id_user, uname);
                END IF;

                IF role_akun = "pemohon" THEN
                    INSERT INTO pemohon (user_id,nama) VALUES (id_user, uname);
                END IF;
            END'
        );
    }

   
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trgCreateAkun'); 
    }
};
