<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tourguide_id',
        'price_range',
        'status',
        'final_price',
        'admin_notes',
        'notes',
        'is_read'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
