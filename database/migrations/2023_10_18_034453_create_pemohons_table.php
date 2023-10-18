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
        Schema::create('pemohon', function (Blueprint $table) {
            $table->integer('id_pemohon', true);
            $table->integer('id_akun', false)->index('id_akun');
            $table->string('email', 60)->nullable(false);
            $table->string('jabatan', 60)->nullable(false);
            $table->enum('kategori',['WAKA','Kaprog','BK', 'Perpustakaan'])->nullable(false);
            $table->text('foto_profil')->nullable(false);

            //foreign key dengan table akun 
            
            $table->foreign('id_akun')->on('akun')
                ->references('id_akun')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};
