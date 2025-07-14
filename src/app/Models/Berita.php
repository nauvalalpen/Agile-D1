<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    //
    protected $fillable = ['judul', 'deskripsi', 'foto', 'tanggal'];
    use SoftDeletes; 
    protected $casts = [
        'tanggal' => 'datetime',
    ];
}
