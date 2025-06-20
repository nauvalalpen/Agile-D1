<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'role',
        'verification_code',
        'email_verified_at',
        'is_verified',
        'google_id',        // Add this
        'avatar_url',       // Add this
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    // Update the getPhotoUrlAttribute method to include Google avatar
    public function getPhotoUrlAttribute()
    {
        if ($this->avatar_url) {
            return $this->avatar_url; // Google avatar
        } elseif ($this->photo) {
            return Storage::url($this->photo); // Local uploaded photo
        } else {
            return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
        }
    }

    // Add method to check if user registered via Google
    public function isGoogleUser()
    {
        return !is_null($this->google_id);
    }

    // Keep all your existing methods...
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles->contains('slug', $role);
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at) && $this->is_verified;
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => now(),
            'is_verified' => true,
            'verification_code' => null,
        ])->save();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function generateVerificationCode()
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->update(['verification_code' => $code]);
        return $code;
    }

    public function isVerificationCodeExpired()
    {
        if (!$this->verification_code) {
            return true;
        }
        
        return $this->updated_at->diffInHours(now()) > 24;
    }

    public function clearVerificationCode()
    {
        return $this->update(['verification_code' => null]);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true)
                    ->whereNotNull('email_verified_at');
    }

    public function scopeUnverified($query)
    {
        return $query->where('is_verified', false)
                    ->whereNull('email_verified_at');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }
}
