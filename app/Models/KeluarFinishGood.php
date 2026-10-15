<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluarFinishGood extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "keluar_finish_good";
    protected $primaryKey = "id_finishkeluar";
    protected $fillable = ['id_finishkeluar', 'id', 'id_specproduk', 'tgl_fg', 'jam_fg', 'tgl_keluar', 'jam_keluar', 'jumlah_ikatan_perball', 'lot_ball_press', 'brutto'];
}
