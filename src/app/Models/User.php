<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Helpers\SettingsHelper;

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
        'phone',
        'bio',
        'notification_preferences',
        'privacy_settings',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
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
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'notification_preferences' => 'array',
            'privacy_settings' => 'array',
            'two_factor_recovery_codes' => 'array',
            'two_factor_confirmed_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
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
        if ($this->roles()->count() > 0) {
            return $this->roles->contains('slug', $role);
        }
        return false;
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

    // Notification preferences methods
    public function getNotificationPreferences()
    {
        return array_merge(
            SettingsHelper::getDefaultNotificationPreferences(),
            $this->notification_preferences ?? []
        );
    }

    public function updateNotificationPreferences(array $preferences)
    {
        $validated = SettingsHelper::validateNotificationPreferences($preferences);
        return $this->update(['notification_preferences' => $validated]);
    }

    // Privacy settings methods
    public function getPrivacySettings()
    {
        return array_merge(
            SettingsHelper::getDefaultPrivacySettings(),
            $this->privacy_settings ?? []
        );
    }

    public function updatePrivacySettings(array $settings)
    {
        $validated = SettingsHelper::validatePrivacySettings($settings);
        return $this->update(['privacy_settings' => $validated]);
    }

    // Two-Factor Authentication methods
    public function has2FAEnabled()
    {
        return !is_null($this->two_factor_secret) && !is_null($this->two_factor_confirmed_at);
    }

    public function enable2FA($secret, $recoveryCodes = null)
    {
        return $this->update([
            'two_factor_secret' => encrypt($secret),
            'two_factor_recovery_codes' => $recoveryCodes ? encrypt(json_encode($recoveryCodes)) : null,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function disable2FA()
    {
        return $this->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);
    }

    public function getTwoFactorSecret()
    {
        return $this->two_factor_secret ? decrypt($this->two_factor_secret) : null;
    }

    public function getTwoFactorRecoveryCodes()
    {
        if (!$this->two_factor_recovery_codes) {
            return [];
        }
        
        try {
            $decrypted = decrypt($this->two_factor_recovery_codes);
            return is_string($decrypted) ? json_decode($decrypted, true) : $decrypted;
        } catch (\Exception $e) {
            return [];
        }
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

    // Update last login
    public function updateLastLogin()
    {
        return $this->update(['last_login_at' => now()]);
    }
}
