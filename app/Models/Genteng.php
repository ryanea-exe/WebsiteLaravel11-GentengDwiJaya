<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genteng extends Model
{
    protected $table = 'genteng';

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'stok',
        'deskripsi',
        'jarak_reng',
        'dimensi',
        'isi_per_m2',
        'foto',
        'is_unggulan',
    ];
}