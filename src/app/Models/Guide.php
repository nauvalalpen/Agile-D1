<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = ['name', 'expertise', 'contact'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}


?>