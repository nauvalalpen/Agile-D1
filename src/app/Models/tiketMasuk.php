<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tiketMasuk extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'nama_ketua',
        'jumlah_rombongan',
        'nohp',
        'alamat',
        'status',
    ];
    protected $casts = [
    'waktu_selesai' => 'datetime',
];

}