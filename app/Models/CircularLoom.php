<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CircularLoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "circular_loom";
    protected $primaryKey = "id_circular";
    protected $fillable = ['id_circular', 'nama_circular', 'nomor_circular'];
}
