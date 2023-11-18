<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sumber_dana extends Model
{
    use HasFactory;
    protected $table = 'sumber_dana';
    protected $primaryKey = 'id_sumber_dana';
    protected $fillable = ['nama_sumber'];
    public $timestamps = false;
}
