<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = ['id_sumber_dana', 'id_bendahara', 'nama_pemasukan', 'nominal', 'waktu', 'foto'];
    public $timestamps = false;
    
    public function sumber_dana()
    {
        return $this->belongsTo(sumber_dana::class, 'id_sumber_dana');
    }
    public function akun()
    {
        
        return $this->belongsTo(bendahara_sekolah::class, 'id_bendahara');
    }
}
