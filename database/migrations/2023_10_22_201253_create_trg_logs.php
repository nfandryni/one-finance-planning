<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $trgName = 'trgAkun';
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tambah_akun AFTER INSERT ON akun FOR EACH ROW
            BEGIN
                INSERT INTO log(aksi, aktivitas, waktu)
                VALUES ('INSERT', CONCAT('Menambahkan akun baru dengan username ', NEW.username), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER update_akun AFTER UPDATE ON akun FOR EACH ROW
            BEGIN
                INSERT INTO log(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Memperbarui akun dengan username ', OLD.username, ' dan ID ', OLD.user_id), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER hapus_akun AFTER DELETE ON akun FOR EACH ROW
            BEGIN
                INSERT INTO log(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Akun dengan nama ', OLD.username), NOW());
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trgAkun'); 
    }
};
