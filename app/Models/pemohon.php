<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemohon extends Model
{
    use HasFactory;
    protected $table = 'pemohon';
    protected $primaryKey = 'id_pemohon';
    protected $fillable =['user_id','nama','email', 'jabatan', 'kategori', 'foto_profil'];
    public $timestamps = false;

    
    
}
