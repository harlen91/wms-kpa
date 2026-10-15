<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specroll extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "specroll";
    protected $primaryKey = "id_specroll";
    protected $fillable = ['id_specroll', 'kode_roll', 'deskripsi', 'lebar', 'densitas', 'denier', 'standart_panjang'];
}
