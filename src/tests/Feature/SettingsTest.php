<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create([
            'email_verified_at' => now(),
            'is_verified' => true,
        ]);
    }

    public function test_user_can_access_settings_page()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('settings.index'));

        $response->assertStatus(200);
        $response->assertViewIs('settings.index');
    }

    public function test_user_can_update_profile()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('settings.profile.update'), [
                             'name' => 'Updated Name',
                             'email' => 'updated@example.com',
                         ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->user->refresh();
        $this->assertEquals('Updated Name', $this->user->name);
        $this->assertEquals('updated@example.com', $this->user->email);
    }

    public function test_user_can_update_password()
    {
        $this->user->update(['password' => Hash::make('oldpassword')]);

        $response = $this->actingAs($this->user)
                         ->post(route('settings.password.update'), [
                             'current_password' => 'oldpassword',
                             'password' => 'newpassword123',
                             'password_confirmation' => 'newpassword123',
                         ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $this->user->password));
    }

    public function test_user_can_update_notification_preferences()
    {
        $preferences = [
            'email_order_updates' => 'on',
            'email_security_alerts' => 'on',
        ];

        $response = $this->actingAs($this->user)
                         ->                         post(route('settings.notifications.update'), $preferences);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->user->refresh();
        $this->assertTrue($this->user->getNotificationPreference('email_order_updates'));
        $this->assertTrue($this->user->getNotificationPreference('email_security_alerts'));
        $this->assertFalse($this->user->getNotificationPreference('email_marketing'));
    }

    public function test_user_can_update_privacy_settings()
    {
        $settings = [
            'profile_public' => 'on',
            'analytics_tracking' => 'on',
        ];

        $response = $this->actingAs($this->user)
                         ->post(route('settings.privacy.update'), $settings);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->user->refresh();
        $this->assertTrue($this->user->getPrivacySetting('profile_public'));
        $this->assertTrue($this->user->getPrivacySetting('analytics_tracking'));
        $this->assertFalse($this->user->getPrivacySetting('show_activity'));
    }

    public function test_password_confirmation_required_for_sensitive_operations()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('settings.password.update'), [
                             'current_password' => 'wrongpassword',
                             'password' => 'newpassword123',
                             'password_confirmation' => 'newpassword123',
                         ]);

        $response->assertRedirect(route('password.confirm'));
    }

    public function test_user_cannot_access_other_users_settings()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)
                         ->get(route('settings.index'));

        $response->assertStatus(200);
        $response->assertViewHas('user', $otherUser);
        $response->assertViewMissing('user', $this->user);
    }

    public function test_guest_cannot_access_settings()
    {
        $response = $this->get(route('settings.index'));

        $response->assertRedirect(route('login'));
    }
}

