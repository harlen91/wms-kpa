<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluarRoll extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "keluar_roll";
    protected $primaryKey = "id_rollkeluar";
    protected $fillable = ['id_rollkeluar', 'id', 'id_machineloom', 'id_specroll', 'id_kodebenang', 'lotextruder', 'id_circular', 'tgl_roll', 'jam_roll', 'tgl_keluar', 'jam_keluar', 'petugas_timbang', 'operator_ml', 'denier', 'densitas', 'lebar_standart_roll', 'lebar_aktual_roll', 'panjang_standart_roll', 'panjang_aktual_roll', 'panjang_standart_roll', '[panjang_aktual_roll', 'berat_standart_meter', 'berat_standart_roll', 'paper_core', 'brutto', 'netto', 'range_berat_masuk_0', 'range_berat_masuk_3', 'waste', 'hasil_perkalian'];
}
