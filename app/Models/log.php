<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;
    protected $table = 'log';
    protected $primaryKey = 'id_logs';
    protected $fillable = ['aksi', 'aktivitas', 'waktu'];
    public $timestamps = false;
}
