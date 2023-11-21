<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $primaryKey = 'id_gedung';
    protected $fillable = ['nama_gedung', 'nama_ruangan'];
    public $timestamps = false;
}
