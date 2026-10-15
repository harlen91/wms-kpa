<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinishGood extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "finish_good";
    protected $primaryKey = "id_finish";
    protected $fillable = ['id_finish', 'id', 'id_specproduk', 'tgl_fg', 'jam_fg', 'jumlah_ikatan_perball', 'brutto', 'lot_ball_press', 'qr_fg'];
}
