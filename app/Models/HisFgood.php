<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HisFgood extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "history_finish_good";
    protected $primaryKey = "id_finish";
    protected $fillable = ['id_finish', 'id', 'id_specproduk', 'tgl_fg', 'jam_fg', 'lot_ball_press', 'jumlah_ikatan_perball', 'brutto', 'qr_fg'];
}
