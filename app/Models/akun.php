<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class akun extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'role'];
    protected $casts = [
        'password' => 'hashed',
    ];

    public $timestamps = false;
}
