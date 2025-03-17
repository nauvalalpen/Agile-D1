<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    protected $fillable = [
        'name',
        'id_card',
        'phone',
        'entry_date',
        'checkout_time',
        'status'
    ];

    protected $dates = [
        'entry_date',
        'checkout_time'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }
}

?>