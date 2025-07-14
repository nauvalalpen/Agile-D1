<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukUMKM extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk_umkm';

    protected $fillable = [
        'nama',
        'harga',
        'foto',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];
}
