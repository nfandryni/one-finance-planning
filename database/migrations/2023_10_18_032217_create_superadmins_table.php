<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('super_admin', function (Blueprint $table) {
            $table->integer('id_superadmin', true);
            $table->integer('user_id', false)->index('user_id');
            $table->string('nama', 225)->nullable(true);
            $table->string('email', 60)->nullable(true);
            $table->string('jabatan', 60)->nullable(true);
            $table->text('foto_profil')->nullable(true);

            //foreign key dengan table akun 
            
            $table->foreign('user_id')->on('akun')
                ->references('user_id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admin');
    }
};
