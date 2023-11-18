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
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('id_admin', true);
            $table->integer('user_id', false)->index('user_id');
            $table->string('email', 60)->nullable(false);
            $table->string('jabatan', 60)->nullable(false);
            $table->text('foto_profil')->nullable(false);

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
        Schema::dropIfExists('admin');
    }
};
