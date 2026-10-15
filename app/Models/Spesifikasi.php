<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spesifikasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "spesifikasi";
    protected $primaryKey = "id_spesifikasi";
    protected $fillable = ['id_spesifikasi', 'nama_spesifikasi'];
}
