<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'app_name',
        'app_logo',
    ];

    /**
     * Ambil setting aktif (baris pertama, selalu ada karena di-seed).
     */
    public static function get(): self
    {
        return static::firstOrCreate([], [
            'app_name' => 'Genteng Dwijaya',
            'app_logo' => null,
        ]);
    }
}
