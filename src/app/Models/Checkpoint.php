<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $fillable = [
        'tourist_id',
        'location',
        'timestamp',
        'status'
    ];

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }
}


?>