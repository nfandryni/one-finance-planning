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
        Schema::create('pemasukan', function (Blueprint $table) {
         $table->integer('id_pemasukan', true);
         $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
         $table->integer('id_bendahara', false)->index('id_bendahara');
         $table->string('nama_pemasukan', 60)->nullable(false);
         $table->integer('nominal', false)->nullable(false);
         $table->date('waktu')->nullable(false);
         $table->text('foto')->nullable(false);

         $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate('cascade')->onDelete('cascade');
         $table->foreign('id_bendahara')->on('bendahara_sekolah')->references('id_bendahara')->onUpdate('cascade')->onDelete('cascade');

        });

        DB::unprepared('DROP VIEW IF EXISTS view_pemasukan');

        DB::unprepared(
            "CREATE VIEW view_pemasukan AS 
            SELECT p.id_pemasukan, s.nama_sumber, b.nama as penanggung_jawab, p.nama as nama_pemasukan, p.nominal, p.waktu, p.foto from pemasukan AS p
            INNER JOIN sumber_dana AS s ON p.id_sumber_dana = s.id_sumber_dana
            INNER JOIN bendahara_sekolah AS b ON p.id_bendahara = b.id_bendahara
            "
        );


        DB::unprepared("
            CREATE TRIGGER tambah_pemasukan AFTER INSERT ON pemasukan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('INSERT', CONCAT('Menambahkan Pemasukan baru dengan nama ', NEW.nama_pemasukan), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER update_pemasukan AFTER UPDATE ON pemasukan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Memperbarui Pemasukan dengan nama ', OLD.nama_pemasukan, ' dan ID Pemasukan ', OLD.id_pemasukan), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER hapus_pemasukan AFTER DELETE ON pemasukan FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Pemasukan dengan nama ', OLD.nama_pemasukan), NOW());
            END
        ");

        DB::unprepared('DROP FUNCTION IF EXISTS total_pemasukan');
        DB::unprepared('
        CREATE FUNCTION total_pemasukan() RETURNS INT
        BEGIN
        DECLARE total INT;
        SELECT SUM(nominal) INTO total from pemasukan;
        RETURN total;
        END
        '); 
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_pemasukan');
        DB::unprepared('DROP TRIGGER IF EXISTS update_pemasukan');
        DB::unprepared('DROP TRIGGER IF EXISTS delete_pemasukan');
    }
};
