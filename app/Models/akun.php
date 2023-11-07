<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class akun extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    protected $fillable = ['username', 'password', 'role'];
    public $timestamps = false;
    protected $casts = [
        'password' => 'hashed',
    ];

    public function bendahara()
    {
        return $this->hasOne(bendahara_sekolah::class, 'id_bendahara', 'id_bendahara');
    }
}
