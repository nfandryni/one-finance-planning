<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_perencanaan extends Model
{
    use HasFactory;
    protected $table = 'item_perencanaan';
    protected $primaryKey = 'id_item_perencanaan';
    protected $fillable = ['id_pengajuan_kebutuhan', 'id_perencanaan_keuangan', 'id_gedung', 'id_realisasi', 'item_perencanaan', 'qty', 'harga_satuan', 'satuan', 'spesifikasi', 'bulan_rencana_realisasi', 'status', 'foto_barang_perencanaan', 'foto_realisasi'];
    public $timestamps = false;
}
