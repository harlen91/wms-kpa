<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineLoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "machine_loom";
    protected $primaryKey = "id_machineloom";
    protected $fillable = ['id_machineloom', 'nama_machineloom'];
}
