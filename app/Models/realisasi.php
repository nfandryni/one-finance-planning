<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class realisasi extends Model
{
    use HasFactory;
    protected $table = 'realisasi';
    protected $primaryKey = 'id_realisasi';
    protected $fillable = ['id_perencanaan_keuangan', 'judul_realisasi', 'tujuan', 'waktu', 'total_pembayaran'];
    public $timestamps = false;
}
