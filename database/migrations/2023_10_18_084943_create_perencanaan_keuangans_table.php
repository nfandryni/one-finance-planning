<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perencanaan_keuangan', function (Blueprint $table) {
            $table->integer('id_perencanaan_keuangan', true)->nullable(true);
            $table->integer('id_pengajuan_kebutuhan', false)->index('id_pengajuan_kebutuhan')->nullable(true);
            $table->integer('id_sumber_dana', false)->index('id_sumber_dana');
            $table->string('judul_perencanaan', 60)->nullable(false);
            $table->string('tujuan', 225)->nullable(false);
            $table->date('waktu')->nullable(false);
            $table->integer('total_dana_perencanaan', false)->nullable(false);
           

            $table->foreign('id_pengajuan_kebutuhan')->on('pengajuan_kebutuhan')->references('id_pengajuan_kebutuhan')->onUpdate
            ('cascade')->onDelete('cascade');
            $table->foreign('id_sumber_dana')->on('sumber_dana')->references('id_sumber_dana')->onUpdate
            ('cascade')->onDelete('cascade');
        });
        
        DB::unprepared("
        CREATE TRIGGER tambah_perencanaan_keuangan AFTER UPDATE ON pengajuan_kebutuhan FOR EACH ROW
        BEGIN
        if NEW.status = 'Terkonfirmasi' THEN
            INSERT INTO perencanaan_keuangan(judul_perencanaan, tujuan, waktu, total_dana_perencanaan)
            VALUES (NEW.nama_kegiatan, NEW.tujuan, NEW.waktu, NEW.total_dana_kebutuhan);
        END IF;
        END

    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perencanaan_keuangan');
    }
};
