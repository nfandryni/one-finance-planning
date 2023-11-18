<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class superadmin extends Model
{
    use HasFactory;
    protected $table = 'super_admin';
    protected $primaryKey = 'id_superadmin';
    protected $fillable =['email', 'jabatan', 'foto_profil'];
    public $timestamps = false;
}
