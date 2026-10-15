<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cutting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cutting';
    protected $primaryKey = 'id_cutting';
    protected $fillable = ['id_cutting', 'nama_cutting', 'nomor_cutting'];
}
