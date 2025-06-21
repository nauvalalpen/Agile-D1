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
                    <div>
                        <button type="button" class="btn btn-outline-primary" id="exportDataBtn">
                            <i class="fas fa-download me-2"></i>
                            Export Data
                        </button>
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
                                type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <i class="fas fa-user me-2"></i>Profile
                            </button>
                            <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security"
                                type="button" role="tab" aria-controls="security" aria-selected="false">
                                <i class="fas fa-shield-alt me-2"></i>Security
                            </button>
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="pill"
                                data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications"
                                aria-selected="false">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </button>
                            <button class="nav-link" id="privacy-tab" data-bs-toggle="pill" data-bs-target="#privacy"
                                type="button" role="tab" aria-controls="privacy" aria-selected="false">
                                <i class="fas fa-user-shield me-2"></i>Privacy
                            </button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="pill" data-bs-target="#data"
                                type="button" role="tab" aria-controls="data" aria-selected="false">
                                <i class="fas fa-database me-2"></i>Data & Storage
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-lg-9">
                <div class="tab-content" id="settings-tabContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('settings.partials.profile')
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        @include('settings.partials.security')
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                        @include('settings.partials.notifications')
                    </div>

                    <!-- Privacy Tab -->
                    <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                        @include('settings.partials.privacy')
                    </div>

                    <!-- Data & Storage Tab -->
                    <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
                        @include('settings.partials.data')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modals -->
    @include('settings.partials.delete-account-modal')
    @include('settings.partials.2fa-setup-modal')
    @include('settings.partials.backup-codes-modal')
@endsection

@push('scripts')
    <script src="{{ asset('js/settings.js') }}"></script>
@endpush

@push('styles')
    <style>
        .nav-pills .nav-link {
            border-radius: 0;
            border-bottom: 1px solid #e9ecef;
            color: #6c757d;
            padding: 1rem 1.5rem;
            text-align: left;
        }

        .nav-pills .nav-link:first-child {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .nav-pills .nav-link:last-child {
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            border-bottom: none;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }

        .settings-card {
            transition: all 0.2s ease-in-out;
        }

        .settings-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .user-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .photo-upload-container {
            position: relative;
            display: inline-block;
        }

        .photo-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
            color: white;
        }

        .photo-upload-container:hover .photo-upload-overlay {
            opacity: 1;
        }

        .security-score-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto;
        }

        .security-score-excellent {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .security-score-good {
            background: linear-gradient(135deg, #17a2b8, #6f42c1);
            color: white;
        }

        .security-score-fair {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            color: white;
        }

        .security-score-poor {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
            color: white;
        }

        .progress {
            height: 8px;
        }

        .progress-bar {
            transition: width 0.6s ease;
        }

        @media (max-width: 768px) {
            .user-avatar-large {
                width: 80px;
                height: 80px;
            }

            .security-score-circle {
                width: 80px;
                height: 80px;
                font-size: 1.2rem;
            }

            .nav-pills .nav-link {
                padding: 0.75rem 1rem;
            }
        }
    </style>
@endpush
