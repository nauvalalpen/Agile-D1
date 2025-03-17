<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tourist_id',
        'guide_id', 
        'booking_date',
        'duration',
        'status'
    ];

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}


?>