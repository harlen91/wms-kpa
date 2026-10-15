<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roll extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "roll";
    protected $primaryKey = "id_roll";
    protected $fillable = ['id_roll', 'id', 'id_machineloom', 'id_specroll', 'id_kodebenang', 'lotextruder', 'id_circular', 'tgl_roll', 'jam_roll', 'petugas_timbang', 'operator_ml', 'denier', 'densitas', 'lebar_standart_roll', 'lebar_aktual_roll', 'panjang_standart_roll', 'panjang_aktual_roll', 'panjang_standart_roll', '[panjang_aktual_roll', 'berat_standart_meter', 'berat_standart_roll', 'paper_core', 'brutto', 'netto', 'range_berat_masuk_0', 'range_berat_masuk_3', 'waste', 'qrcode_roll', 'hasil_perkalian', 'status_roll', 'catatan'];
}
