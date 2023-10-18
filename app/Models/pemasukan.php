<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = ['id_sumber_dana', 'id_bendahara', 'nominal', 'waktu'];
    public $timestamps = false;
}
