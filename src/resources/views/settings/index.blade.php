@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">Account Settings</h2>
                        <p class="text-muted mb-0">Manage your account information and preferences</p>
                    </div>
                    <div>
                        <span class="badge bg-{{ $user->hasVerifiedEmail() ? 'success' : 'warning' }} fs-6">
                            <i
                                class="fas fa-{{ $user->hasVerifiedEmail() ? 'check-circle' : 'exclamation-triangle' }} me-1"></i>
                            {{ $user->hasVerifiedEmail() ? 'Verified Account' : 'Unverified Account' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Settings Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold">Settings Menu</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#profile" class="list-group-item list-group-item-action active" data-bs-toggle="pill">
                            <i class="fas fa-user me-2"></i>Profile Information
                        </a>
                        <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="fas fa-shield-alt me-2"></i>Security
                        </a>
                        <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                        <a href="#verification" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="fas fa-envelope-check me-2"></i>Email Verification
                        </a>
                        <a href="#danger" class="list-group-item list-group-item-action text-danger" data-bs-toggle="pill">
                            <i class="fas fa-exclamation-triangle me-2"></i>Danger Zone
                        </a>
                    </div>
                </div>

                <!-- Account Stats -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold">Account Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Member Since</span>
                                <span class="fw-medium">{{ $stats['member_since'] }}</span>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Activity</span>
                                <span class="fw-medium">{{ $stats['last_login'] }}</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Account Status</span>
                                <span class="badge bg-{{ $user->hasVerifiedEmail() ? 'success' : 'warning' }}">
                                    {{ $user->hasVerifiedEmail() ? 'Active' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Profile Information Tab -->
                    <div class="tab-pane fade show active" id="profile">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Profile Information</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Profile Photo Section -->
                                <div class="row mb-4">
                                    <div class="col-md-3 text-center">
                                        <div class="profile-photo-wrapper position-relative d-inline-block">
                                            @if ($user->photo)
                                                <img src="{{ $user->photo_url }}" alt="Profile Photo"
                                                    class="profile-photo rounded-circle" id="photoPreview">
                                            @else
                                                <div class="profile-photo-placeholder rounded-circle d-flex align-items-center justify-content-center"
                                                    id="photoPreview">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <button type="button"
                                                class="btn btn-primary btn-sm photo-upload-btn rounded-circle"
                                                onclick="document.getElementById('photoInput').click()">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                        </div>
                                        <input type="file" id="photoInput" accept="image/*" style="display: none;">
                                        <p class="text-muted small mt-2">Click camera to change photo</p>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-muted mb-2">{{ $user->email }}</p>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-{{ $user->isAdmin() ? 'danger' : 'primary' }}">
                                                {{ $user->isAdmin() ? 'Administrator' : 'User' }}
                                            </span>
                                            @if ($user->hasVerifiedEmail())
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Verified
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Form -->
                                <form method="POST" action="{{ route('settings.profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-modern btn-modern-primary">
                                            <i class="fas fa-save me-1"></i>Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Security Settings</h5>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="{{ route('settings.password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <h6 class="mb-3">Change Password</h6>

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="current_password" name="current_password" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('current_password')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('current_password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm New
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password_confirmation')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add this section to the Security tab, after the password change form -->
                                    <hr class="my-4">

                                    <h6 class="mb-3">Connected Accounts</h6>

                                    <div class="connected-accounts">
                                        <div
                                            class="account-item d-flex justify-content-between align-items-center p-3 border rounded mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="account-icon me-3">
                                                    <i class="fab fa-google fa-2x text-danger"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Google Account</h6>
                                                    @if ($user->isGoogleUser())
                                                        <small class="text-success">
                                                            <i class="fas fa-check-circle me-1"></i>Connected
                                                        </small>
                                                    @else
                                                        <small class="text-muted">Not connected</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                @if ($user->isGoogleUser())
                                                    <form method="POST" action="{{ route('auth.google.unlink') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to unlink your Google account? Make sure you have a password set.')">
                                                            <i class="fas fa-unlink me-1"></i>Unlink
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('auth.google') }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-link me-1"></i>Connect
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Facebook (Coming Soon) -->
                                        <div
                                            class="account-item d-flex justify-content-between align-items-center p-3 border rounded mb-3 opacity-50">
                                            <div class="d-flex align-items-center">
                                                <div class="account-icon me-3">
                                                    <i class="fab fa-facebook fa-2x text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Facebook Account</h6>
                                                    <small class="text-muted">Coming soon</small>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                                    <i class="fas fa-clock me-1"></i>Soon
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Apple (Coming Soon) -->
                                        <div
                                            class="account-item d-flex justify-content-between align-items-center p-3 border rounded mb-3 opacity-50">
                                            <div class="d-flex align-items-center">
                                                <div class="account-icon me-3">
                                                    <i class="fab fa-apple fa-2x text-dark"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Apple Account</h6>
                                                    <small class="text-muted">Coming soon</small>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                                    <i class="fas fa-clock me-1"></i>Soon
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="password-requirements mb-3">
                                        <small class="text-muted">Password must contain:</small>
                                        <ul class="small text-muted mb-0">
                                            <li id="length-req">At least 8 characters</li>
                                            <li id="uppercase-req">At least one uppercase letter</li>
                                            <li id="lowercase-req">At least one lowercase letter</li>
                                            <li id="number-req">At least one number</li>
                                        </ul>
                                    </div>

                                    <button type="submit" class="btn btn-modern btn-modern-primary">
                                        <i class="fas fa-key me-1"></i>Update Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Notification Preferences</h5>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="{{ route('settings.notifications.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="notification-group mb-4">
                                        <h6 class="mb-3">Email Notifications</h6>

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_notifications"
                                                name="email_notifications" value="1"
                                                {{ session('email_notifications', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="email_notifications">
                                                <strong>Order Updates</strong>
                                                <br><small class="text-muted">Receive emails about your order status
                                                    changes</small>
                                            </label>
                                        </div>

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="marketing_emails"
                                                name="marketing_emails" value="1"
                                                {{ session('marketing_emails', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="marketing_emails">
                                                <strong>Marketing Emails</strong>
                                                <br><small class="text-muted">Receive promotional offers and news</small>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="notification-group mb-4">
                                        <h6 class="mb-3">SMS Notifications</h6>

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="sms_notifications"
                                                name="sms_notifications" value="1"
                                                {{ session('sms_notifications', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sms_notifications">
                                                <strong>SMS Alerts</strong>
                                                <br><small class="text-muted">Receive SMS for important updates</small>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-modern btn-modern-primary">
                                        <i class="fas fa-bell me-1"></i>Update Notifications
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Email Verification Tab -->
                    <div class="tab-pane fade" id="verification">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Email Verification</h5>
                            </div>
                            <div class="card-body p-4">
                                @if ($user->hasVerifiedEmail())
                                    <div class="alert alert-success">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle fa-2x me-3"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Email Verified!</h6>
                                                <p class="mb-0">Your email address has been successfully verified.</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Email Not Verified</h6>
                                                <p class="mb-0">Please verify your email address to secure your account.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Resend Verification -->
                                    <div class="mb-4">
                                        <h6>Resend Verification Code</h6>
                                        <p class="text-muted">We'll send a 6-digit verification code to your email address.
                                        </p>
                                        <form method="POST" action="{{ route('settings.resend.verification') }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fas fa-paper-plane me-1"></i>Send Verification Code
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Verify Email -->
                                    <div>
                                        <h6>Enter Verification Code</h6>
                                        <form method="POST" action="{{ route('settings.verify.email') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <input type="text"
                                                        class="form-control @error('verification_code') is-invalid @enderror"
                                                        name="verification_code" placeholder="Enter 6-digit code"
                                                        maxlength="6" required>
                                                    @error('verification_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-modern btn-modern-primary">
                                                        <i class="fas fa-check me-1"></i>Verify Email
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone Tab -->
                    <div class="tab-pane fade" id="danger">
                        <div class="card border-0 shadow-sm border-danger">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Danger Zone</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-danger">
                                    <h6 class="alert-heading">Delete Account</h6>
                                    <p class="mb-0">Once you delete your account, there is no going back. Please be
                                        certain.</p>
                                </div>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteAccountModal">
                                    <i class="fas fa-trash-alt me-1"></i>Delete My Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> This action cannot be undone. This will permanently delete your account
                        and remove all your data from our servers.
                    </div>

                    <form method="POST" action="{{ route('settings.account.delete') }}" id="deleteAccountForm">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Enter your password to confirm</label>
                            <input type="password" class="form-control" id="delete_password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirmation" class="form-label">Type "DELETE" to confirm</label>
                            <input type="text" class="form-control" id="confirmation" name="confirmation"
                                placeholder="Type DELETE here" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="deleteAccountForm" class="btn btn-danger" id="deleteAccountBtn"
                        disabled>
                        <i class="fas fa-trash-alt me-1"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add CSS for connected accounts -->
    <style>
        .connected-accounts .account-item {
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .connected-accounts .account-item:hover:not(.opacity-50) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .account-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        w

        /* Profile Photo Styles */
        .profile-photo-wrapper {
            width: 120px;
            height: 120px;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .profile-photo-placeholder {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            font-weight: 700;
            font-size: 2rem;
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .photo-upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid #fff;
        }

        .photo-upload-btn:hover {
            transform: scale(1.1);
        }

        /* Settings Navigation */
        .list-group-item-action {
            transition: all 0.3s ease;
            border: none;
            padding: 0.75rem 1rem;
        }

        .list-group-item-action:hover {
            background-color: rgba(37, 99, 235, 0.08);
            color: var(--primary-color);
        }

        .list-group-item-action.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .list-group-item-action.active:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        /* Stats */
        .stat-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .stat-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        /* Notification Groups */
        .notification-group {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-switch .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Password Requirements */
        .password-requirements {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.375rem;
            border-left: 4px solid var(--accent-color);
        }

        .password-requirements li {
            transition: color 0.3s ease;
        }

        .password-requirements li.valid {
            color: #28a745;
        }

        .password-requirements li.invalid {
            color: #6c757d;
        }

        /* Input Groups */
        .input-group .btn-outline-secondary {
            border-color: #ced4da;
        }

        .input-group .btn-outline-secondary:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #155724;
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #721c24;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .profile-photo-wrapper {
                width: 100px;
                height: 100px;
            }

            .profile-photo,
            .profile-photo-placeholder {
                width: 100px;
                height: 100px;
                font-size: 1.5rem;
            }

            .photo-upload-btn {
                width: 30px;
                height: 30px;
                bottom: 0;
                right: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Photo upload functionality
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const uploadBtn = document.querySelector('.photo-upload-btn');

            if (photoInput && photoPreview) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Show loading state
                        const originalContent = uploadBtn.innerHTML;
                        uploadBtn.innerHTML = '<div class="loading-spinner"></div>';
                        uploadBtn.disabled = true;

                        const formData = new FormData();
                        formData.append('photo', file);

                        fetch('{{ route('settings.photo.update') }}', {
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
                                    // Update preview
                                    if (photoPreview.tagName === 'IMG') {
                                        photoPreview.src = data.photo_url;
                                    } else {
                                        // Replace placeholder with image
                                        const img = document.createElement('img');
                                        img.src = data.photo_url;
                                        img.alt = 'Profile Photo';
                                        img.className = 'profile-photo rounded-circle';
                                        img.id = 'photoPreview';
                                        photoPreview.parentNode.replaceChild(img, photoPreview);
                                    }
                                    showNotification(data.message, 'success');
                                } else {
                                    showNotification(data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('Failed to upload photo. Please try again.', 'error');
                            })
                            .finally(() => {
                                uploadBtn.innerHTML = originalContent;
                                uploadBtn.disabled = false;
                            });
                    }
                });
            }

            // Password visibility toggle
            window.togglePassword = function(inputId) {
                const input = document.getElementById(inputId);
                const button = input.nextElementSibling;
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            };

            // Password strength validation
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;

                    // Check requirements
                    const requirements = {
                        'length-req': password.length >= 8,
                        'uppercase-req': /[A-Z]/.test(password),
                        'lowercase-req': /[a-z]/.test(password),
                        'number-req': /\d/.test(password)
                    };

                    // Update requirement indicators
                    Object.keys(requirements).forEach(reqId => {
                        const element = document.getElementById(reqId);
                        if (element) {
                            if (requirements[reqId]) {
                                element.classList.add('valid');
                                element.classList.remove('invalid');
                                element.innerHTML = '<i class="fas fa-check me-1"></i>' + element
                                    .textContent.replace(/^[✓✗]\s*/, '');
                            } else {
                                element.classList.add('invalid');
                                element.classList.remove('valid');
                                element.innerHTML = '<i class="fas fa-times me-1"></i>' + element
                                    .textContent.replace(/^[✓✗]\s*/, '');
                            }
                        }
                    });
                });
            }

            // Delete account confirmation
            const deleteForm = document.getElementById('deleteAccountForm');
            const confirmationInput = document.getElementById('confirmation');
            const deletePasswordInput = document.getElementById('delete_password');
            const deleteButton = document.getElementById('deleteAccountBtn');

            if (confirmationInput && deleteButton) {
                function checkDeleteForm() {
                    const isConfirmed = confirmationInput.value === 'DELETE';
                    const hasPassword = deletePasswordInput.value.length > 0;
                    deleteButton.disabled = !(isConfirmed && hasPassword);
                }

                confirmationInput.addEventListener('input', checkDeleteForm);
                deletePasswordInput.addEventListener('input', checkDeleteForm);

                deleteForm.addEventListener('submit', function(e) {
                    if (confirmationInput.value !== 'DELETE') {
                        e.preventDefault();
                        showNotification('Please type "DELETE" to confirm account deletion.', 'error');
                    }
                });
            }

            // Tab persistence
            const hash = window.location.hash;
            if (hash) {
                const tabTrigger = document.querySelector(`[href="${hash}"]`);
                if (tabTrigger) {
                    const tab = new bootstrap.Tab(tabTrigger);
                    tab.show();
                }
            }

            // Update URL hash when tab changes
            document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    window.location.hash = e.target.getAttribute('href');
                });
            });

            // Notification toggle visual feedback
            const notificationToggles = document.querySelectorAll('.form-check-input[type="checkbox"]');
            notificationToggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const label = this.nextElementSibling;
                    const strong = label.querySelector('strong');

                    if (this.checked) {
                        strong.style.color = '#28a745';
                        label.style.opacity = '1';
                    } else {
                        strong.style.color = '#6c757d';
                        label.style.opacity = '0.7';
                    }
                });

                // Initialize state
                toggle.dispatchEvent(new Event('change'));
            });

            // Auto-save indication for forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn && !submitBtn.classList.contains('btn-warning')) {
                            const originalText = submitBtn.innerHTML;
                            submitBtn.innerHTML = originalText.replace('Update', 'Update*');
                            submitBtn.classList.add('btn-warning');
                            submitBtn.classList.remove('btn-modern-primary');
                        }
                    });
                });
            });

            // Verification code input formatting
            const verificationInput = document.querySelector('input[name="verification_code"]');
            if (verificationInput) {
                verificationInput.addEventListener('input', function() {
                    // Only allow numbers
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Limit to 6 digits
                    if (this.value.length > 6) {
                        this.value = this.value.slice(0, 6);
                    }
                });
            }

            // Loading states for buttons
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalContent = submitBtn.innerHTML;
                        submitBtn.innerHTML =
                            '<span class="loading-spinner me-1"></span>Processing...';
                        submitBtn.disabled = true;

                        // Re-enable after 5 seconds as fallback
                        setTimeout(() => {
                            submitBtn.innerHTML = originalContent;
                            submitBtn.disabled = false;
                        }, 5000);
                    }
                });
            });

            // Smooth scrolling for tab navigation
            document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Global notification function (if not already defined)
        if (typeof showNotification === 'undefined') {
            function showNotification(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className =
                    `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} position-fixed`;
                toast.style.cssText = `
            top: 80px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        `;
                toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

                document.body.appendChild(toast);

                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.style.animation = 'slideOutRight 0.3s ease-out';
                        setTimeout(() => toast.remove(), 300);
                    }
                }, 4000);
            }
        }
    </script>
@endsection
