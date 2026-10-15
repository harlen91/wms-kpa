<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BallPress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ball_press';
    protected $primaryKey = 'id_ballpress';
    protected $fillable = ['id_ballpress', 'nama_ballpress', 'nomor_ballpress'];
}
