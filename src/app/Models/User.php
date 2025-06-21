<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'avatar',
        'google_id',
        'role',
        'verification_code',
        'email_verified_at',
        'is_verified',
        'notification_preferences',
        'privacy_settings',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'last_login_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'notification_preferences' => 'array',
            'privacy_settings' => 'array',
            'two_factor_recovery_codes' => 'array',
        ];
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->avatar) {
            return $this->avatar; // Google avatar
        } elseif ($this->photo) {
            return asset('storage/' . $this->photo);
        } else {
            return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
        }
    }

    public function getProfilePhotoAttribute()
    {
        return $this->getPhotoUrlAttribute();
    }

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

    // Settings-related methods
    public function has2FAEnabled(): bool
    {
        return !empty($this->two_factor_secret);
    }

    public function getNotificationPreferences(): array
    {
        return $this->notification_preferences ?? \App\Helpers\SettingsHelper::getDefaultNotificationPreferences();
    }

    public function getPrivacySettings(): array
    {
        return $this->privacy_settings ?? \App\Helpers\SettingsHelper::getDefaultPrivacySettings();
    }

    public function updateNotificationPreferences(array $preferences): bool
    {
        $validated = \App\Helpers\SettingsHelper::validateNotificationPreferences($preferences);
        return $this->update(['notification_preferences' => $validated]);
    }

    public function updatePrivacySettings(array $settings): bool
    {
        $validated = \App\Helpers\SettingsHelper::validatePrivacySettings($settings);
        return $this->update(['privacy_settings' => $validated]);
    }

    public function getSecurityScore(): array
    {
        return \App\Helpers\SettingsHelper::calculateSecurityScore($this);
    }

    public function canDeleteAccount(): bool
    {
        $pendingOrders = DB::table('order_tour_guides')
            ->where('user_id', $this->id)
            ->where('status', 'pending')
            ->count();
            
        $pendingHoneyOrders = DB::table('order_madus')
            ->where('user_id', $this->id)
            ->where('status', 'pending')
            ->count();
        
        return ($pendingOrders + $pendingHoneyOrders) === 0;
    }

    public function getAccountDeletionRestrictions(): array
    {
        $restrictions = [];
        
        $pendingOrders = DB::table('order_tour_guides')
            ->where('user_id', $this->id)
            ->where('status', 'pending')
            ->count();
            
        if ($pendingOrders > 0) {
            $restrictions[] = "You have {$pendingOrders} pending tour guide order(s)";
        }
        
        $pendingHoneyOrders = DB::table('order_madus')
            ->where('user_id', $this->id)
            ->where('status', 'pending')
            ->count();
            
        if ($pendingHoneyOrders > 0) {
            $restrictions[] = "You have {$pendingHoneyOrders} pending honey order(s)";
        }
        
        return $restrictions;
    }

    // Scopes
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
