<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_kebutuhan extends Model
{
    use HasFactory;
    protected $table = 'item_kebutuhan';
    protected $primaryKey = 'id_item_kebutuhan';
    protected $fillable = ['id_pengajuan_kebutuhan', 'id_gedung', 'item_kebutuhan', 'qty', 'harga_satuan', 'satuan', 'spesifikasi', 'status', 'foto_barang_kebutuhan'];
    public $timestamps = false;

}
