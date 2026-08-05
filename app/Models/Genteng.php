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
        'foto',
        'is_unggulan',
    ];
}