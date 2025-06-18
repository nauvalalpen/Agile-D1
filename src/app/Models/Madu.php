<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Madu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_madu',
        'ukuran',
        'harga',
        'deskripsi',
        'stock',
        'gambar'
    ];

    /**
     * Get the orders for the honey product.
     */
    public function orders()
    {
        return $this->hasMany(OrderMadu::class);
    }
}
