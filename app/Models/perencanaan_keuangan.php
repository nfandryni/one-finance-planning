<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perencanaan_keuangan extends Model
{
    use HasFactory;
    protected $table = 'perencanaan_keuangan';
    protected $primaryKey = 'id_perencanaan_keuangan';
    protected $fillable = ['id_pengajuan_kebutuhan', 'id_sumber_dana', 'judul_perencanaan', 'tujuan', 'waktu', 'total_dana_perencanaan'];
    public $timestamps = false;
}
