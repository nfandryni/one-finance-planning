<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    use HasFactory;
    protected $table = 'logs_aplikasi';
    protected $primaryKey = 'id_logs';
    protected $fillable = ['aktor', 'aktivitas', 'waktu'];
    public $timestamps = false;
}
