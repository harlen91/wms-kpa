<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CircularLoomFg extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "circular_loomfg";
    protected $primaryKey = "id_circular";
    protected $fillable = ['id_circular', 'nama_circular', 'nomor_circular'];
}
