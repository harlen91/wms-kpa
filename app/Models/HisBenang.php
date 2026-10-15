<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HisBenang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "history_benang";
    protected $primaryKey = "id_benang";
    protected $fillable = ['id_benang', 'id_spesifikasi', 'id_lotextruder', 'id_kodebenang', 'id', 'qty_benang', 'tgl_benang', 'jam_benang', 'bruto', 'berat_palet', 'berat_keranjang_satuan', 'jumlah_keranjang_palet', 'total_berat_keranjang_palet', 'berat_bobin_satuan', 'banyak_bobin_keranjang', 'total_banyakbobin_palet', 'total_beratbobin_palet', 'neto', 'no_palet', 'berat_aktual', 'qrcode'];
}
