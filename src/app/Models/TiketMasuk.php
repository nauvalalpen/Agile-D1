<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TiketMasuk extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_ketua',
        'jumlah_rombongan',
        'nohp',
        'alamat',
        'status',
    ];
    
    protected $casts = [
        'waktu_selesai' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope methods for filtering
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
    }

    // Helper method to get status badge class
    public function getStatusBadgeClass()
    {
        return $this->status === 'selesai' ? 'btn-secondary' : 'btn-success';
    }

    // Helper method to check if ticket is completed
    public function isCompleted()
    {
        return $this->status === 'selesai';
    }
}
