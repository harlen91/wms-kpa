<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DenierProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "denier_produk";
    protected $primaryKey = "id_denierproduk";
    protected $fillable = ['id_denierproduk', 'nama_denierproduk'];
}
