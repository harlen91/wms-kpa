<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarnaJahitan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "warna_jahitan";
    protected $primaryKey = "id_warna";
    protected $fillable = ['id_warna', 'nama_warna'];
}
