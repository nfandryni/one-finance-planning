<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_kebutuhan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_kebutuhan';
    protected $primaryKey = 'id_pengajuan_kebutuhan';
    protected $fillable = [
    'id_pemohon', 
    'nama_kegiatan', 
    'tujuan', 
    'status', 
    'waktu'];
    public $timestamps = false;
}
