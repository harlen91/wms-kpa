<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kodebenang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "kodebenangs";
    protected $primaryKey = "id_kodebenang";
    protected $fillable = ['id_kodebenang', 'kode_benang'];
}
