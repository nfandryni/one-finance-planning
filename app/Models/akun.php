<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    use HasFactory;
    protected $table = 'akun';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'role'];
    public $timestamps = false;
}
