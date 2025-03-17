<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    protected $table = 'guides';
    
    protected $fillable = [
        'name',
        'expertise',
        'availability',
        'contact'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'guide_id');
    }
}


?>