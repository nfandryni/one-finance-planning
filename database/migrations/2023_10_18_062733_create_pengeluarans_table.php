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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->integer('id_pengeluaran', true);
            $table->integer('id_bendahara', false)->index('id_bendahara');
            $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
            $table->integer('id_jenis_pengeluaran', false)->index('id_jenis_pengeluaran');
            $table->string('nama', 60)->nullable(false);
            $table->decimal('nominal', 10, 0)->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->text('foto')->nullable(false);

            $table->foreign('id_bendahara')->on('bendahara_sekolah')->references('id_bendahara')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jenis_pengeluaran')->on('jenis_pengeluaran')->references('id_jenis_pengeluaran')->onUpdate('cascade')->onDelete('cascade');
        });
       
        // Stored Function => digunakan untuk menghitung jumlah pengeluaran
        DB::unprepared('DROP FUNCTION IF EXISTS total_pengeluaran');
        DB::unprepared('
        CREATE FUNCTION total_pengeluaran() RETURNS decimal(10,0)
        BEGIN
        DECLARE total DECIMAL(10,0);
        SELECT SUM(nominal) INTO total from pengeluaran;
        RETURN total;
        END
        '); 

        DB::unprepared('DROP VIEW IF EXISTS view_pengeluaran');

        DB::unprepared(
            "CREATE VIEW view_pengeluaran AS 
            SELECT p.id_pengeluaran, s.nama_sumber, b.nama as penanggung_jawab, p.nama as nama_pengeluaran, j.kategori, p.nominal, p.waktu, p.foto from pengeluaran AS p
            INNER JOIN sumber_dana AS s ON p.id_sumber_dana = s.id_sumber_dana
            INNER JOIN bendahara_sekolah AS b ON p.id_bendahara = b.id_bendahara
            INNER JOIN jenis_pengeluaran AS j ON p.id_jenis_pengeluaran = j.id_jenis_pengeluaran
            "
        );

        DB::unprepared("
            CREATE TRIGGER tambah_pengeluaran AFTER INSERT ON pengeluaran FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('INSERT', CONCAT('Menambahkan Pengeluaran baru dengan nama ', NEW.nama, ' dan nominal sebesar ', NEW.nominal), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER update_pengeluaran AFTER UPDATE ON pengeluaran FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('UPDATE', CONCAT('Memperbarui Pengeluaran dengan nama ', OLD.nama, ' dan ID Pengeluaran ', OLD.id_pengeluaran), NOW());
            END
        ");
        
        DB::unprepared("
            CREATE TRIGGER hapus_pengeluaran AFTER DELETE ON pengeluaran FOR EACH ROW
            BEGIN
                INSERT INTO logs(aksi, aktivitas, waktu)
                VALUES ('DELETE', CONCAT('Menghapus Pengeluaran dengan nama ', OLD.nama), NOW());
            END
        ");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
        DB::unprepared('DROP TRIGGER IF EXISTS tambah_pengeluaran');
        DB::unprepared('DROP TRIGGER IF EXISTS update_pengeluaran');
        DB::unprepared('DROP TRIGGER IF EXISTS delete_pengeluaran');
    }
};
