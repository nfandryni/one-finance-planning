<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = ['id_bendahara', 'id_sumber_dana', 'id_jenis_pengeluaran', 'nama', 'nominal', 'waktu'];
    public $timestamps = false;
}
