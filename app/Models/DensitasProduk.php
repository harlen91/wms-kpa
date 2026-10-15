<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DensitasProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "densitas_produk";
    protected $primaryKey = "id_densitasproduk";
    protected $fillable = ['id_densitasproduk', 'nama_densitasproduk'];
}
