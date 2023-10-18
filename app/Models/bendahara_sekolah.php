<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bendahara_sekolah extends Model
{
    use HasFactory;
    protected $table = 'bendahara_sekolah';
    protected $primaryKey = 'id_bendaharasekolah';
    protected $fillable =['email', 'jabatan', 'foto_profil'];
    public $timestamps = false;
}
