<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dana_anggaran extends Model
{
    use HasFactory;
    protected $table = 'dana_anggaran';
    protected $primaryKey = 'id_dana_anggaran';
    protected $fillable = ['id_sumber_dana', 'jumlah_dana'];
    public $timestamps = false;
}
