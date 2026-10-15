<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class specproduk extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "specproduk";
    protected $primaryKey = "id_specproduk";
    protected $fillable = ['id_specproduk', 'nama_specproduk', 'panjang', 'lebar', 'densitas', 'denier', 'jumlah_lembar'];
}
