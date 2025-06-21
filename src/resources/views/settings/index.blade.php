@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">Account Settings</h2>
                        <p class="text-muted mb-0">Manage your account preferences and security settings</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Settings Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="settings-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile"
                                type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Profile
                            </button>
                            <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security"
                                type="button" role="tab">
                                <i class="fas fa-shield-alt me-2"></i>Security
                            </button>
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="pill"
                                data-bs-target="#notifications" type="button" role="tab">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </button>
                            <button class="nav-link" id="privacy-tab" data-bs-toggle="pill" data-bs-target="#privacy"
                                type="button" role="tab">
                                <i class="fas fa-user-shield me-2"></i>Privacy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-lg-9">
                <div class="tab-content" id="settings-tabContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Profile Information</h5>
                            </div>
                            <div class="card-body">
                                <form id="profileForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-4">
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ $user->profile_photo }}" alt="Profile Photo"
                                                    class="rounded-circle" width="120" height="120"
                                                    style="object-fit: cover;">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="photo" class="btn btn-primary btn-sm rounded-circle">
                                                        <i class="fas fa-camera"></i>
                                                    </label>
                                                    <input type="file" id="photo" name="photo" class="d-none"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $user->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">Bio</label>
                                                <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Tell us about yourself..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Security Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-4 text-center">
                                        <div
                                            class="security-score-circle security-score-{{ strtolower($securityScore['level']) }}">
                                            {{ $securityScore['percentage'] }}%
                                        </div>
                                        <h6 class="mt-2 text-capitalize">{{ $securityScore['level'] }} Security</h6>
                                    </div>
                                    <div class="col-md-8">
                                        <h6>Security Recommendations</h6>
                                        @if (count($securityScore['recommendations']) > 0)
                                            @foreach ($securityScore['recommendations'] as $recommendation)
                                                <div class="alert alert-{{ $recommendation['type'] }} alert-sm">
                                                    <strong>{{ $recommendation['title'] }}</strong><br>
                                                    <small>{{ $recommendation['description'] }}</small>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Your account security is excellent!
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Change Password -->
                                <div class="border-top pt-4">
                                    <h6>Change Password</h6>
                                    <form id="passwordForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label">Current
                                                        Password</label>
                                                    <input type="password" class="form-control" id="current_password"
                                                        name="current_password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">New Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Confirm New
                                                        Password</label>
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-key me-2"></i>Update Password
                                        </button>
                                    </form>
                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="border-top pt-4 mt-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Two-Factor Authentication</h6>
                                            <p class="text-muted mb-0">Add an extra layer of security to your account</p>
                                        </div>
                                        <div>
                                            @if ($user->has2FAEnabled())
                                                <span class="badge bg-success me-2">Enabled</span>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#disable2FAModal">
                                                    Disable 2FA
                                                </button>
                                            @else
                                                <span class="badge bg-warning me-2">Disabled</span>
                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#setup2FAModal">
                                                    Enable 2FA
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Notification Preferences</h5>
                            </div>
                            <div class="card-body">
                                <form id="notificationsForm">
                                    @csrf
                                    @php
                                        $preferences = $user->getNotificationPreferences();
                                        $labels = \App\Helpers\SettingsHelper::getNotificationLabels();
                                    @endphp

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Email Notifications</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'email_'))
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{ $key }}" name="{{ $key }}"
                                                            {{ $preferences[$key] ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $key }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Push Notifications</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'push_'))
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{ $key }}" name="{{ $key }}"
                                                            {{ $preferences[$key] ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $key }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach

                                            <h6 class="mt-4">SMS Notifications</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'sms_'))
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{ $key }}" name="{{ $key }}"
                                                            {{ $preferences[$key] ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $key }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Preferences
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Tab -->
                    <div class="tab-pane fade" id="privacy" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Privacy Settings</h5>
                            </div>
                            <div class="card-body">
                                <form id="privacyForm">
                                    @csrf
                                    @php
                                        $privacySettings = $user->getPrivacySettings();
                                        $privacyLabels = \App\Helpers\SettingsHelper::getPrivacyLabels();
                                        $privacyImpacts = \App\Helpers\SettingsHelper::getPrivacyImpacts();
                                    @endphp

                                    @foreach ($privacyLabels as $key => $label)
                                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-check-label fw-medium" for="{{ $key }}">
                                                        {{ $label }}
                                                    </label>
                                                    <span
                                                        class="badge bg-{{ $privacyImpacts[$key] === 'high' ? 'danger' : ($privacyImpacts[$key] === 'medium' ? 'warning' : 'info') }} ms-2">
                                                        {{ ucfirst($privacyImpacts[$key]) }} Impact
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="{{ $key }}"
                                                    name="{{ $key }}"
                                                    {{ $privacySettings[$key] ?? false ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Settings
                                        </button>
                                    </div>
                                </form>

                                <!-- Data Management -->
                                <div class="border-top pt-4 mt-4">
                                    <h6>Data Management</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-download text-primary mb-2"
                                                        style="font-size: 2rem;"></i>
                                                    <h6>Export Your Data</h6>
                                                    <p class="text-muted small">Download a copy of your personal data</p>
                                                    <a href="{{ route('settings.export') }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-download me-1"></i>Export Data
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card bg-light border-danger">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-trash text-danger mb-2" style="font-size: 2rem;"></i>
                                                    <h6>Delete Account</h6>
                                                    <p class="text-muted small">Permanently delete your account and data
                                                    </p>
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                                        <i class="fas fa-trash me-1"></i>Delete Account
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2FA Setup Modal -->
    <div class="modal fade" id="setup2FAModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setup Two-Factor Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="setup2FAStep1">
                        <p>Two-factor authentication adds an extra layer of security to your account.</p>
                        <ol>
                            <li>Install an authenticator app like Google Authenticator or Authy</li>
                            <li>Scan the QR code below with your authenticator app</li>
                            <li>Enter the 6-digit code from your app to verify</li>
                        </ol>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick="generate2FAQRCode()">
                                Generate QR Code
                            </button>
                        </div>
                    </div>
                    <div id="setup2FAStep2" style="display: none;">
                        <div class="text-center mb-3">
                            <div id="qrCodeContainer"></div>
                            <p class="mt-2">Secret Key: <code id="secretKey"></code></p>
                        </div>
                        <form id="verify2FAForm">
                            <input type="hidden" id="hiddenSecretKey" name="secret_key">
                            <div class="mb-3">
                                <label for="verification_code" class="form-label">Enter 6-digit code from your
                                    app:</label>
                                <input type="text" class="form-control text-center" id="verification_code"
                                    name="verification_code" maxlength="6" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-2"></i>Verify & Enable 2FA
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="setup2FAStep3" style="display: none;">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Two-factor authentication has been enabled successfully!
                        </div>
                        <div class="alert alert-warning">
                            <strong>Important:</strong> Save these backup codes in a safe place. You can use them to access
                            your account if you lose your authenticator device.
                        </div>
                        <div id="backupCodes" class="bg-light p-3 rounded"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Disable 2FA Modal -->
    <div class="modal fade" id="disable2FAModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Disable Two-Factor Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Disabling two-factor authentication will make your account less secure.
                    </div>
                    <form id="disable2FAForm">
                        @csrf
                        <div class="mb-3">
                            <label for="disable_password" class="form-label">Enter your password to confirm:</label>
                            <input type="password" class="form-control" id="disable_password" name="password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="disable2FA()">
                        <i class="fas fa-times me-2"></i>Disable 2FA
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. All your data will be permanently deleted.
                    </div>

                    <div class="mb-3">
                        <h6>What will be deleted:</h6>
                        <ul>
                            <li>Your profile information</li>
                            <li>Order history (anonymized)</li>
                            <li>Account preferences</li>
                            <li>All personal data</li>
                        </ul>
                    </div>

                    <form id="deleteAccountForm">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Enter your password:</label>
                            <input type="password" class="form-control" id="delete_password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="delete_confirmation" class="form-label">Type "DELETE" to confirm:</label>
                            <input type="text" class="form-control" id="delete_confirmation" name="confirmation"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteAccount()">
                        <i class="fas fa-trash me-2"></i>Delete My Account
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .security-score-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin: 0 auto;
        }

        .security-score-poor {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        .security-score-fair {
            background: linear-gradient(135deg, #fd7e14, #e55a00);
        }

        .security-score-good {
            background: linear-gradient(135deg, #ffc107, #e0a800);
        }

        .security-score-excellent {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }

        .nav-pills .nav-link {
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            color: #6c757d;
            font-weight: 500;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color, #2563eb);
            color: white;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--primary-color, #2563eb);
        }

        .alert-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color, #2563eb);
            border-color: var(--primary-color, #2563eb);
        }

        .form-switch .form-check-input {
            width: 2em;
            height: 1em;
        }

        .form-switch .form-check-input:checked {
            background-color: var(--primary-color, #2563eb);
            border-color: var(--primary-color, #2563eb);
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .modal-content {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        #qrCodeContainer {
            display: inline-block;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .backup-codes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
        }

        .backup-code {
            padding: 0.5rem;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .security-score-circle {
                width: 80px;
                height: 80px;
                font-size: 1.25rem;
            }

            .backup-codes {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add CSRF token to meta tag if not already present
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = '{{ csrf_token() }}';
                document.head.appendChild(meta);
            }

            // Profile form submission
            const profileForm = document.getElementById('profileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    submitBtn.disabled = true;

                    fetch('{{ route('settings.profile.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                                if (data.profile_photo) {
                                    const profileImg = document.querySelector(
                                        'img[alt="Profile Photo"]');
                                    if (profileImg) {
                                        profileImg.src = data.profile_photo;
                                    }
                                }
                            } else {
                                showNotification(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred while saving your profile', 'error');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Password form submission
            const passwordForm = document.getElementById('passwordForm');
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    // Validate passwords match
                    const password = formData.get('password');
                    const passwordConfirmation = formData.get('password_confirmation');

                    if (password !== passwordConfirmation) {
                        showNotification('Passwords do not match', 'error');
                        return;
                    }

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
                    submitBtn.disabled = true;

                    fetch('{{ route('settings.password.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                                this.reset();
                            } else {
                                showNotification(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred while updating your password', 'error');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Notifications form submission
            const notificationsForm = document.getElementById('notificationsForm');
            if (notificationsForm) {
                notificationsForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    submitBtn.disabled = true;

                    fetch('{{ route('settings.notifications.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                            } else {
                                showNotification(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred while saving your preferences',
                                'error');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Privacy form submission
            const privacyForm = document.getElementById('privacyForm');
            if (privacyForm) {
                privacyForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    submitBtn.disabled = true;

                    fetch('{{ route('settings.privacy.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                            } else {
                                showNotification(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred while saving your settings', 'error');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // 2FA verification form
            const verify2FAForm = document.getElementById('verify2FAForm');
            if (verify2FAForm) {
                verify2FAForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
                    submitBtn.disabled = true;

                    let url = '{{ route('settings.2fa.enable') }}';
                    console.log('URL:', url);

                    fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => {
                            console.log('Response:', response);
                            response.text().then(text => {
                                console.log("Text:", text);
                                data = JSON.parse(text);
                                console.log("Data:", data);
                                if (data.success) {
                                    document.getElementById('setup2FAStep2').style.display =
                                        'none';
                                    document.getElementById('setup2FAStep3').style.display =
                                        'block';

                                    // Display backup codes
                                    const backupCodesContainer = document.getElementById(
                                        'backupCodes');
                                    if (data.backup_codes && backupCodesContainer) {
                                        const codesHtml = data.backup_codes.map(code =>
                                            `<div class="backup-code">${code}</div>`
                                        ).join('');
                                        backupCodesContainer.innerHTML =
                                            `<div class="backup-codes">${codesHtml}</div>`;
                                    }

                                    showNotification(data.message, 'success');

                                    // Refresh page after 3 seconds
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 3000);
                                } else {
                                    showNotification(data.message ||
                                        'Invalid verification code', 'error');
                                }
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred while enabling 2FA', 'error');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Photo upload preview
            const photoInput = document.getElementById('photo');
            if (photoInput) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const profileImg = document.querySelector('img[alt="Profile Photo"]');
                            if (profileImg) {
                                profileImg.src = e.target.result;
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });

        // Generate 2FA QR Code
        function generate2FAQRCode() {
            const generateBtn = event.target;
            const originalText = generateBtn.innerHTML;

            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
            generateBtn.disabled = true;

            fetch('{{ route('settings.2fa.generate') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('setup2FAStep1').style.display = 'none';
                        document.getElementById('setup2FAStep2').style.display = 'block';

                        const qrContainer = document.getElementById('qrCodeContainer');
                        const secretKeyElement = document.getElementById('secretKey');
                        const hiddenSecretKey = document.getElementById('hiddenSecretKey');

                        if (qrContainer) qrContainer.innerHTML = data.qr_code;
                        if (secretKeyElement) secretKeyElement.textContent = data.secret_key;
                        if (hiddenSecretKey) hiddenSecretKey.value = data.secret_key;
                    } else {
                        showNotification(data.message || 'Failed to generate QR code', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred while generating QR code', 'error');
                })
                .finally(() => {
                    generateBtn.innerHTML = originalText;
                    generateBtn.disabled = false;
                });
        }

        // Disable 2FA
        function disable2FA() {
            const password = document.getElementById('disable_password').value;

            if (!password) {
                showNotification('Please enter your password', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('password', password);

            fetch('{{ route('settings.2fa.disable') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('disable2FAModal'));
                        if (modal) modal.hide();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Failed to disable 2FA', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred while disabling 2FA', 'error');
                });
        }

        // Delete Account
        function deleteAccount() {
            const password = document.getElementById('delete_password').value;
            const confirmation = document.getElementById('delete_confirmation').value;

            if (!password || confirmation !== 'DELETE') {
                showNotification('Please fill in all required fields correctly', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('password', password);
            formData.append('confirmation', confirmation);
            formData.append('_method', 'DELETE');

            fetch('{{ route('settings.account.delete') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteAccountModal'));
                        if (modal) modal.hide();
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000);
                    } else {
                        if (data.errors) {
                            Object.values(data.errors).forEach(error => {
                                showNotification(error[0], 'error');
                            });
                        } else {
                            showNotification(data.message || 'Failed to delete account', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred while deleting your account', 'error');
                });
        }

        // Notification function
        function showNotification(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' :
                type === 'error' ? 'alert-danger' :
                type === 'warning' ? 'alert-warning' : 'alert-info';

            const notification = document.createElement('div');
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    `;

            notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            <span>${message}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function(e) {
                const password = e.target.value;
                const strength = calculatePasswordStrength(password);

                // Remove existing strength indicator
                const existingIndicator = document.querySelector('.password-strength');
                if (existingIndicator) {
                    existingIndicator.remove();
                }

                if (password.length > 0) {
                    const indicator = document.createElement('div');
                    indicator.className = 'password-strength mt-2';
                    indicator.innerHTML = `
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-${strength.color}" style="width: ${strength.percentage}%"></div>
                </div>
                <small class="text-${strength.color}">${strength.text}</small>
            `;
                    e.target.parentElement.appendChild(indicator);
                }
            });
        }

        function calculatePasswordStrength(password) {
            let score = 0;

            if (password.length >= 8) score += 25;
            if (password.length >= 12) score += 25;
            if (/[a-z]/.test(password)) score += 10;
            if (/[A-Z]/.test(password)) score += 10;
            if (/[0-9]/.test(password)) score += 10;
            if (/[^A-Za-z0-9]/.test(password)) score += 20;

            if (score < 30) {
                return {
                    percentage: score,
                    color: 'danger',
                    text: 'Weak password'
                };
            } else if (score < 60) {
                return {
                    percentage: score,
                    color: 'warning',
                    text: 'Fair password'
                };
            } else if (score < 90) {
                return {
                    percentage: score,
                    color: 'info',
                    text: 'Good password'
                };
            } else {
                return {
                    percentage: score,
                    color: 'success',
                    text: 'Strong password'
                };
            }
        }

        // Email validation
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailRegex.test(email)) {
                    this.classList.add('is-invalid');
                    showNotification('Please enter a valid email address', 'error');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.length <= 3) {
                        value = `(${value}`;
                    } else if (value.length <= 6) {
                        value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
                    } else {
                        value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6, 10)}`;
                    }
                }
                e.target.value = value;
            });
        }

        // Tab persistence
        const activeTab = localStorage.getItem('activeSettingsTab');
        if (activeTab) {
            const tabButton = document.querySelector(`button[data-bs-target="${activeTab}"]`);
            if (tabButton) {
                const tab = new bootstrap.Tab(tabButton);
                tab.show();
            }
        }

        document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(button => {
            button.addEventListener('shown.bs.tab', function(e) {
                localStorage.setItem('activeSettingsTab', e.target.getAttribute('data-bs-target'));
            });
        });
    </script>
@endpush
