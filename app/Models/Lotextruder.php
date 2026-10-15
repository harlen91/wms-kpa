<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lotextruder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "lotextruders";
    protected $primaryKey = "id_lotextruder";
    protected $fillable = ['id_lotextruder', 'nama_lotextruder', 'nomor_lotextruder', 'jenis'];
}
