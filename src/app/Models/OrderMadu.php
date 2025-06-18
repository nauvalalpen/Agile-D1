<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMadu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'madu_id',
        'nama_madu',
        'jumlah',
        'tanggal',
        'total_harga',
        'status'
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the honey product that is ordered.
     */
    public function madu()
    {
        return $this->belongsTo(Madu::class);
    }
}
