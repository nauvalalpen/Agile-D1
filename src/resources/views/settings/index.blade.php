@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="page-title mb-1">Pengaturan Akun</h2>
                        <p class="page-subtitle mb-0">Kelola preferensi akun dan pengaturan keamanan Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Settings Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="glass-card nav-card">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills modern-nav" id="settings-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile"
                                type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Profil
                            </button>
                            <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security"
                                type="button" role="tab">
                                <i class="fas fa-shield-alt me-2"></i>Keamanan
                            </button>
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="pill"
                                data-bs-target="#notifications" type="button" role="tab">
                                <i class="fas fa-bell me-2"></i>Notifikasi
                            </button>
                            <button class="nav-link" id="privacy-tab" data-bs-toggle="pill" data-bs-target="#privacy"
                                type="button" role="tab">
                                <i class="fas fa-user-shield me-2"></i>Privasi
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
                        <div class="glass-card">
                            <div class="card-header modern-header">
                                <h5 class="mb-0">Informasi Profil</h5>
                            </div>
                            <div class="card-body">
                                <form id="profileForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-4">
                                            <div class="profile-photo-container">
                                                <img src="{{ $user->profile_photo }}" alt="Foto Profil"
                                                    class="profile-photo" width="120" height="120">
                                                <div class="photo-overlay">
                                                    <label for="photo" class="photo-btn">
                                                        <i class="fas fa-camera"></i>
                                                    </label>
                                                    <input type="file" id="photo" name="photo" class="d-none"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control modern-input" id="name" name="name"
                                                    value="{{ $user->name }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <input type="email" class="form-control modern-input" id="email" name="email"
                                                    value="{{ $user->email }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="phone" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control modern-input" id="phone" name="phone"
                                                    value="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="bio" class="form-label">Bio</label>
                                                <textarea class="form-control modern-input" id="bio" name="bio" rows="3" 
                                                    placeholder="Ceritakan tentang diri Anda..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn modern-btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel">
                        <div class="glass-card">
                            <div class="card-header modern-header">
                                <h5 class="mb-0">Pengaturan Keamanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-4 text-center">
                                        <div class="security-score-circle security-score-{{ strtolower($securityScore['level']) }}">
                                            {{ $securityScore['percentage'] }}%
                                        </div>
                                        <h6 class="mt-2 text-capitalize">Keamanan {{ ucfirst($securityScore['level']) }}</h6>
                                    </div>
                                    <div class="col-md-8">
                                        <h6>Rekomendasi Keamanan</h6>
                                        @if (count($securityScore['recommendations']) > 0)
                                            @foreach ($securityScore['recommendations'] as $recommendation)
                                                <div class="alert modern-alert alert-{{ $recommendation['type'] }}">
                                                    <strong>{{ $recommendation['title'] }}</strong><br>
                                                    <small>{{ $recommendation['description'] }}</small>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert modern-alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Keamanan akun Anda sangat baik!
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Change Password -->
                                <div class="security-section">
                                    <h6>Ubah Kata Sandi</h6>
                                    <form id="passwordForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                                                    <input type="password" class="form-control modern-input" id="current_password"
                                                        name="current_password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="password" class="form-label">Kata Sandi Baru</label>
                                                    <input type="password" class="form-control modern-input" id="password"
                                                        name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                                    <input type="password" class="form-control modern-input"
                                                        id="password_confirmation" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn modern-btn-warning">
                                            <i class="fas fa-key me-2"></i>Perbarui Kata Sandi
                                        </button>
                                    </form>
                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="security-section">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Autentikasi Dua Faktor</h6>
                                            <p class="text-muted mb-0">Tambahkan lapisan keamanan ekstra untuk akun Anda</p>
                                        </div>
                                        <div>
                                            @if ($user->has2FAEnabled())
                                                <span class="badge modern-badge-success me-2">Aktif</span>
                                                <button type="button" class="btn modern-btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#disable2FAModal">
                                                    Nonaktifkan 2FA
                                                </button>
                                            @else
                                                <span class="badge modern-badge-warning me-2">Nonaktif</span>
                                                <button type="button" class="btn modern-btn-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#setup2FAModal">
                                                    Aktifkan 2FA
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
                        <div class="glass-card">
                            <div class="card-header modern-header">
                                <h5 class="mb-0">Preferensi Notifikasi</h5>
                            </div>
                            <div class="card-body">
                                <form id="notificationsForm">
                                    @csrf
                                    @php
                                        $preferences = $user->getNotificationPreferences();
                                        $labels = [
                                            'email_orders' => 'Pesanan Baru',
                                            'email_promotions' => 'Promosi & Penawaran',
                                            'email_updates' => 'Pembaruan Sistem',
                                            'push_orders' => 'Pesanan Baru',
                                            'push_messages' => 'Pesan Baru',
                                            'push_updates' => 'Pembaruan Aplikasi',
                                            'sms_orders' => 'Konfirmasi Pesanan',
                                            'sms_security' => 'Peringatan Keamanan'
                                        ];
                                    @endphp

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="notification-section-title">Notifikasi Email</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'email_'))
                                                    <div class="form-check modern-check mb-3">
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
                                            <h6 class="notification-section-title">Notifikasi Push</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'push_'))
                                                    <div class="form-check modern-check mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{ $key }}" name="{{ $key }}"
                                                            {{ $preferences[$key] ?? false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $key }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach

                                            <h6 class="notification-section-title mt-4">Notifikasi SMS</h6>
                                            @foreach ($labels as $key => $label)
                                                @if (str_starts_with($key, 'sms_'))
                                                    <div class="form-check modern-check mb-3">
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
                                        <button type="submit" class="btn modern-btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Preferensi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Tab -->
                    <div class="tab-pane fade" id="privacy" role="tabpanel">
                        <div class="glass-card">
                            <div class="card-header modern-header">
                                <h5 class="mb-0">Pengaturan Privasi</h5>
                            </div>
                            <div class="card-body">
                                <form id="privacyForm">
                                    @csrf
                                    @php
                                        $privacySettings = $user->getPrivacySettings();
                                                                                $privacyLabels = [
                                            'profile_visibility' => 'Visibilitas Profil Publik',
                                            'show_activity' => 'Tampilkan Aktivitas',
                                            'allow_messages' => 'Izinkan Pesan dari Pengguna Lain',
                                            'data_analytics' => 'Berbagi Data untuk Analitik',
                                            'marketing_emails' => 'Email Pemasaran',
                                            'location_tracking' => 'Pelacakan Lokasi'
                                        ];
                                        $privacyImpacts = [
                                            'profile_visibility' => 'high',
                                            'show_activity' => 'medium',
                                            'allow_messages' => 'low',
                                            'data_analytics' => 'medium',
                                            'marketing_emails' => 'low',
                                            'location_tracking' => 'high'
                                        ];
                                    @endphp

                                    @foreach ($privacyLabels as $key => $label)
                                        <div class="privacy-setting-item">
                                            <div class="privacy-setting-content">
                                                <div class="d-flex align-items-center">
                                                    <label class="privacy-label" for="{{ $key }}">
                                                        {{ $label }}
                                                    </label>
                                                    <span class="privacy-impact-badge impact-{{ $privacyImpacts[$key] }}">
                                                        {{ $privacyImpacts[$key] === 'high' ? 'Dampak Tinggi' : ($privacyImpacts[$key] === 'medium' ? 'Dampak Sedang' : 'Dampak Rendah') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch modern-switch">
                                                <input class="form-check-input" type="checkbox" id="{{ $key }}"
                                                    name="{{ $key }}"
                                                    {{ $privacySettings[$key] ?? false ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn modern-btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Pengaturan
                                        </button>
                                    </div>
                                </form>

                                <!-- Data Management -->
                                <div class="data-management-section">
                                    <h6>Manajemen Data</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="data-card export-card">
                                                <div class="data-card-icon">
                                                    <i class="fas fa-download"></i>
                                                </div>
                                                <h6>Ekspor Data Anda</h6>
                                                <p class="data-card-desc">Unduh salinan data pribadi Anda</p>
                                                <a href="{{ route('settings.export') }}" class="btn modern-btn-outline-primary btn-sm">
                                                    <i class="fas fa-download me-1"></i>Ekspor Data
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-card delete-card">
                                                <div class="data-card-icon danger">
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                                <h6>Hapus Akun</h6>
                                                <p class="data-card-desc">Hapus akun dan data Anda secara permanen</p>
                                                <button type="button" class="btn modern-btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                                    <i class="fas fa-trash me-1"></i>Hapus Akun
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

    <!-- Modals remain the same but with Indonesian text -->
    <!-- 2FA Setup Modal -->
    <div class="modal fade" id="setup2FAModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modern-modal">
                <div class="modal-header modern-modal-header">
                    <h5 class="modal-title">Atur Autentikasi Dua Faktor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="setup2FAStep1">
                        <p>Autentikasi dua faktor menambahkan lapisan keamanan ekstra untuk akun Anda.</p>
                        <ol>
                            <li>Instal aplikasi autentikator seperti Google Authenticator atau Authy</li>
                            <li>Pindai kode QR di bawah dengan aplikasi autentikator Anda</li>
                            <li>Masukkan kode 6 digit dari aplikasi Anda untuk verifikasi</li>
                        </ol>
                        <div class="text-center">
                            <button type="button" class="btn modern-btn-primary" onclick="generate2FAQRCode()">
                                Buat Kode QR
                            </button>
                        </div>
                    </div>
                    <!-- Other modal steps remain similar with Indonesian translation -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        :root {
            /* Modern Dark Green & White Color Palette */
            --dark-forest: #0a1f0f;
            --deep-green: #1a3d2e;
            --forest-green: #2d5a3d;
            --emerald-green: #228B22;
            --light-green: #90EE90;
            --pure-white: #ffffff;
            --off-white: #f8fffe;
            --glass-white: rgba(255, 255, 255, 0.1);
            --glass-dark: rgba(10, 31, 15, 0.9);

            /* Advanced Gradients */
            --hero-gradient: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
            --glass-gradient: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
            --accent-gradient: linear-gradient(90deg, #228B22, #90EE90, #228B22);

            /* Modern Shadows & Effects */
            --shadow-hero: 0 25px 80px rgba(10, 31, 15, 0.6);
            --shadow-glass: 0 15px 35px rgba(0, 0, 0, 0.1);
            --glow-green: 0 0 40px rgba(34, 139, 34, 0.4);
            --glow-white: 0 0 30px rgba(255, 255, 255, 0.3);

            /* Animations */
            --transition-smooth: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
            --transition-bounce: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        body {
            background: linear-gradient(135deg, var(--off-white) 0%, #f0f9f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Page Headers */
        .page-title {
            background: var(--hero-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--forest-green);
            font-size: 1.1rem;
            opacity: 0.8;
        }

        /* Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: var(--shadow-glass);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-gradient);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .glass-card:hover::before {
            opacity: 1;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: rgba(34, 139, 34, 0.2);
        }

        /* Modern Navigation */
        .nav-card {
            position: sticky;
            top: 2rem;
        }

        .modern-nav .nav-link {
            border-radius: 15px;
            margin-bottom: 0.5rem;
            color: var(--accent-gradient);
            font-weight: 600;
            padding: 1rem 1.5rem;
            transition: var(--transition-smooth);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .modern-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--glass-gradient);
            transition: left 0.5s ease;
            z-index: -1;
        }

        .modern-nav .nav-link:hover::before {
            left: 0;
        }

        .modern-nav .nav-link.active {
            background: var(--glass-gradient);
            color: var(--pure-white);
            box-shadow: var(--glow-green);
            transform: translateX(5px);
        }

        .modern-nav .nav-link:hover:not(.active) {
            background: var(--glass-gradient);
            color: var(--emerald-green);
            border-color: rgba(34, 139, 34, 0.3);
            transform: translateX(3px);
        }

        /* Modern Header */
        .modern-header {
            background: var(--glass-gradient);
            border-bottom: 2px solid rgba(34, 139, 34, 0.1);
            border-radius: 20px 20px 0 0 !important;
            padding: 1.5rem 2rem;
        }

        .modern-header h5 {
            color: var(--deep-green);
            font-weight: 700;
            margin: 0;
        }

        /* Profile Photo Container */
        .profile-photo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .profile-photo {
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--emerald-green);
            box-shadow: var(--glow-green);
            transition: var(--transition-smooth);
        }

        .profile-photo:hover {
            transform: scale(1.05);
            box-shadow: 0 0 50px rgba(34, 139, 34, 0.6);
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .photo-btn {
            width: 40px;
            height: 40px;
            background: var(--hero-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pure-white);
            cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: var(--shadow-glass);
        }

        .photo-btn:hover {
            transform: scale(1.1);
            box-shadow: var(--glow-green);
        }

        /* Modern Form Controls */
        .modern-input {
            border: 2px solid rgba(34, 139, 34, 0.2);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.8);
            transition: var(--transition-smooth);
            font-size: 1rem;
        }

        .modern-input:focus {
            border-color: var(--emerald-green);
            box-shadow: 0 0 0 0.2rem rgba(34, 139, 34, 0.25);
            background: var(--pure-white);
            transform: translateY(-2px);
        }

        .form-label {
            color: var(--deep-green);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        /* Modern Buttons */
        .modern-btn-primary {
            background: var(--hero-gradient);
            border: none;
            color: var(--pure-white);
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-glass);
            position: relative;
            overflow: hidden;
        }

        .modern-btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .modern-btn-primary:hover::before {
            left: 100%;
        }

        .modern-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--glow-green);
            color: var(--pure-white);
        }

               .modern-btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            border: none;
            color: var(--dark-forest);
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .modern-btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.5);
            color: var(--dark-forest);
        }

        .modern-btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            color: var(--pure-white);
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .modern-btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.5);
            color: var(--pure-white);
        }

        .modern-btn-outline-primary {
            background: transparent;
            border: 2px solid var(--emerald-green);
            color: var(--emerald-green);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .modern-btn-outline-primary:hover {
            background: var(--emerald-green);
            color: var(--pure-white);
            transform: translateY(-2px);
            box-shadow: var(--glow-green);
        }

        .modern-btn-outline-danger {
            background: transparent;
            border: 2px solid #dc3545;
            color: #dc3545;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .modern-btn-outline-danger:hover {
            background: #dc3545;
            color: var(--pure-white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* Security Score Circle */
        .security-score-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--pure-white);
            margin: 0 auto 1rem;
            position: relative;
            overflow: hidden;
        }

        .security-score-circle::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .security-score-poor {
            background: linear-gradient(135deg, #dc3545, #c82333);
            box-shadow: 0 0 30px rgba(220, 53, 69, 0.4);
        }

        .security-score-fair {
            background: linear-gradient(135deg, #fd7e14, #e55a00);
            box-shadow: 0 0 30px rgba(253, 126, 20, 0.4);
        }

        .security-score-good {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            box-shadow: 0 0 30px rgba(255, 193, 7, 0.4);
        }

        .security-score-excellent {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            box-shadow: 0 0 30px rgba(40, 167, 69, 0.4);
        }

        /* Modern Alerts */
        .modern-alert {
            border: none;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            border-left: 4px solid;
        }

        .modern-alert.alert-success {
            background: rgba(40, 167, 69, 0.1);
            border-left-color: #28a745;
            color: #155724;
        }

        .modern-alert.alert-warning {
            background: rgba(255, 193, 7, 0.1);
            border-left-color: #ffc107;
            color: #856404;
        }

        .modern-alert.alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border-left-color: #dc3545;
            color: #721c24;
        }

        /* Security Sections */
        .security-section {
            border-top: 2px solid rgba(34, 139, 34, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
        }

        .security-section h6 {
            color: var(--deep-green);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        /* Modern Badges */
        .modern-badge-success {
            background: var(--hero-gradient);
            color: var(--pure-white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .modern-badge-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: var(--dark-forest);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Notification Section */
        .notification-section-title {
            color: var(--deep-green);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            position: relative;
            padding-left: 1rem;
        }

        .notification-section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: var(--accent-gradient);
            border-radius: 2px;
        }

        /* Modern Checkboxes */
        .modern-check {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            transition: var(--transition-smooth);
            border: 2px solid transparent;
        }

        .modern-check:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(34, 139, 34, 0.2);
            transform: translateX(5px);
        }

        .modern-check .form-check-input {
            width: 1.5em;
            height: 1.5em;
            border: 2px solid var(--emerald-green);
            border-radius: 6px;
        }

        .modern-check .form-check-input:checked {
            background-color: var(--emerald-green);
            border-color: var(--emerald-green);
            box-shadow: var(--glow-green);
        }

        .modern-check .form-check-label {
            color: var(--deep-green);
            font-weight: 500;
            margin-left: 0.5rem;
        }

        /* Privacy Settings */
        .privacy-setting-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            margin-bottom: 1rem;
            border: 2px solid transparent;
            transition: var(--transition-smooth);
        }

        .privacy-setting-item:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(34, 139, 34, 0.2);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glass);
        }

        .privacy-setting-content {
            flex-grow: 1;
        }

        .privacy-label {
            color: var(--deep-green);
            font-weight: 600;
            margin: 0;
            margin-right: 1rem;
        }

        .privacy-impact-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 1rem;
        }

        .privacy-impact-badge.impact-high {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .privacy-impact-badge.impact-medium {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .privacy-impact-badge.impact-low {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
            border: 1px solid rgba(23, 162, 184, 0.3);
        }

        /* Modern Switch */
        .modern-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            border: 2px solid var(--emerald-green);
            background-color: rgba(34, 139, 34, 0.1);
        }

        .modern-switch .form-check-input:checked {
            background-color: var(--emerald-green);
            border-color: var(--emerald-green);
            box-shadow: var(--glow-green);
        }

        /* Data Management Section */
        .data-management-section {
            border-top: 2px solid rgba(34, 139, 34, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
        }

        .data-management-section h6 {
            color: var(--deep-green);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .data-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition-smooth);
            border: 2px solid transparent;
            height: 100%;
        }

        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-glass);
        }

        .export-card {
            border-color: rgba(34, 139, 34, 0.2);
        }

        .export-card:hover {
            border-color: var(--emerald-green);
            box-shadow: var(--glow-green);
        }

        .delete-card {
            border-color: rgba(220, 53, 69, 0.2);
        }

        .delete-card:hover {
            border-color: #dc3545;
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.2);
        }

        .data-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            background: var(--hero-gradient);
            color: var(--pure-white);
        }

        .data-card-icon.danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        .data-card h6 {
            color: var(--deep-green);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .data-card-desc {
            color: var(--forest-green);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        /* Modern Modal */
        .modern-modal {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
        }

        .modern-modal-header {
            background: var(--glass-gradient);
            border-bottom: 2px solid rgba(34, 139, 34, 0.1);
            border-radius: 20px 20px 0 0;
            padding: 1.5rem 2rem;
        }

        .modern-modal-header .modal-title {
            color: var(--deep-green);
            font-weight: 700;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .security-score-circle {
                width: 100px;
                height: 100px;
                font-size: 1.5rem;
            }

            .modern-nav .nav-link {
                padding: 0.875rem 1.25rem;
            }

            .privacy-setting-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .privacy-setting-content {
                width: 100%;
            }

            .modern-switch {
                align-self: flex-end;
            }

            .data-card {
                margin-bottom: 1rem;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

                /* Floating Animation for Interactive Elements */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Gradient Text Animation */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-gradient-text {
            background: var(--accent-gradient);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease infinite;
        }

        /* Smooth Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--off-white);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--hero-gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--emerald-green);
        }

        /* Focus States for Accessibility */
        .modern-input:focus,
        .modern-btn-primary:focus,
        .modern-btn-warning:focus,
        .modern-btn-danger:focus,
        .modern-check .form-check-input:focus,
        .modern-switch .form-check-input:focus {
            outline: 3px solid rgba(34, 139, 34, 0.3);
            outline-offset: 2px;
        }

        /* Print Styles */
        @media print {
            .glass-card {
                background: white !important;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
            
            .modern-btn-primary,
            .modern-btn-warning,
            .modern-btn-danger {
                background: #333 !important;
                color: white !important;
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

            // Initialize animations
            initializeAnimations();
            
            // Profile form submission
            const profileForm = document.getElementById('profileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    handleFormSubmission(this, '{{ route('settings.profile.update') }}', 'Profil berhasil diperbarui!');
                });
            }

            // Password form submission
            const passwordForm = document.getElementById('passwordForm');
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const password = this.querySelector('#password').value;
                    const passwordConfirmation = this.querySelector('#password_confirmation').value;
                    
                    if (password !== passwordConfirmation) {
                        showNotification('Kata sandi tidak cocok', 'error');
                        return;
                    }
                    
                    handleFormSubmission(this, '{{ route('settings.password.update') }}', 'Kata sandi berhasil diperbarui!');
                });
            }

            // Notifications form submission
            const notificationsForm = document.getElementById('notificationsForm');
            if (notificationsForm) {
                notificationsForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    handleFormSubmission(this, '{{ route('settings.notifications.update') }}', 'Preferensi notifikasi berhasil disimpan!');
                });
            }

            // Privacy form submission
            const privacyForm = document.getElementById('privacyForm');
            if (privacyForm) {
                privacyForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    handleFormSubmission(this, '{{ route('settings.privacy.update') }}', 'Pengaturan privasi berhasil disimpan!');
                });
            }

            // Photo upload preview with animation
            const photoInput = document.getElementById('photo');
            if (photoInput) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const profileImg = document.querySelector('.profile-photo');
                            if (profileImg) {
                                profileImg.style.opacity = '0.5';
                                setTimeout(() => {
                                    profileImg.src = e.target.result;
                                    profileImg.style.opacity = '1';
                                    profileImg.classList.add('float-animation');
                                }, 300);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Tab persistence with animation
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
                    
                    // Add entrance animation to tab content
                    const targetContent = document.querySelector(e.target.getAttribute('data-bs-target'));
                    if (targetContent) {
                        targetContent.style.opacity = '0';
                        targetContent.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            targetContent.style.transition = 'all 0.5s ease';
                            targetContent.style.opacity = '1';
                            targetContent.style.transform = 'translateY(0)';
                        }, 100);
                    }
                });
            });

            // Password strength indicator
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function(e) {
                    const password = e.target.value;
                    const strength = calculatePasswordStrength(password);
                    updatePasswordStrengthIndicator(e.target, strength);
                });
            }

            // Email validation with Indonesian messages
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.addEventListener('blur', function() {
                    const email = this.value;
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (email && !emailRegex.test(email)) {
                        this.classList.add('is-invalid');
                        showNotification('Silakan masukkan alamat email yang valid', 'error');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            }

            // Phone number formatting for Indonesian numbers
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    
                    // Format for Indonesian phone numbers
                    if (value.startsWith('62')) {
                        // International format
                        if (value.length <= 3) {
                            value = `+${value}`;
                        } else if (value.length <= 6) {
                            value = `+${value.slice(0, 2)} ${value.slice(2)}`;
                        } else if (value.length <= 10) {
                            value = `+${value.slice(0, 2)} ${value.slice(2, 5)}-${value.slice(5)}`;
                        } else {
                            value = `+${value.slice(0, 2)} ${value.slice(2, 5)}-${value.slice(5, 9)}-${value.slice(9, 13)}`;
                        }
                    } else if (value.startsWith('0')) {
                        // Local format
                        if (value.length <= 4) {
                            value = value;
                        } else if (value.length <= 7) {
                            value = `${value.slice(0, 4)}-${value.slice(4)}`;
                        } else {
                            value = `${value.slice(0, 4)}-${value.slice(4, 8)}-${value.slice(8, 12)}`;
                        }
                    }
                    
                    e.target.value = value;
                });
            }
        });

        // Initialize animations
        function initializeAnimations() {
            // Add entrance animations to cards
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Add hover effects to interactive elements
            const interactiveElements = document.querySelectorAll('.modern-input, .modern-btn-primary, .modern-btn-warning, .modern-btn-danger');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        }

        // Generic form submission handler
        function handleFormSubmission(form, url, successMessage) {
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(successMessage, 'success');
                    
                    // Handle specific responses
                    if (data.profile_photo) {
                        const profileImg = document.querySelector('.profile-photo');
                        if (profileImg) {
                            profileImg.src = data.profile_photo;
                            profileImg.classList.add('float-animation');
                        }
                    }
                } else {
                    if (data.errors) {
                        Object.values(data.errors).forEach(error => {
                            showNotification(error[0], 'error');
                        });
                    } else {
                        showNotification(data.message || 'Terjadi kesalahan', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menyimpan data', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
            });
        }

        // Enhanced notification function with Indonesian messages
        function showNotification(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' :
                type === 'error' ? 'alert-danger' :
                type === 'warning' ? 'alert-warning' : 'alert-info';

            const iconClass = type === 'success' ? 'check-circle' :
                type === 'error' ? 'exclamation-circle' :
                type === 'warning' ? 'exclamation-triangle' : 'info-circle';

            const notification = document.createElement('div');
            notification.className = `alert modern-alert ${alertClass} alert-dismissible fade show position-fixed`;
            notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 350px;
                max-width: 500px;
                box-shadow: var(--shadow-glass);
                border-radius: 15px;
                backdrop-filter: blur(20px);
                animation: slideInRight 0.5s ease;
            `;

            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${iconClass} me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.animation = 'slideOutRight 0.5s ease';
                    setTimeout(() => notification.remove(), 500);
                }
            }, 5000);
        }

        // Password strength calculator with Indonesian labels
        function calculatePasswordStrength(password) {
            let score = 0;

            if (password.length >= 8) score += 25;
            if (password.length >= 12) score += 25;
            if (/[a-z]/.test(password)) score += 10;
            if (/[A-Z]/.test(password)) score += 10;
            if (/[0-9]/.test(password)) score += 10;
            if (/[^A-Za-z0-9]/.test(password)) score += 20;

            if (score < 30) {
                return { percentage: score, color: 'danger', text: 'Kata sandi lemah' };
            } else if (score < 60) {
                return { percentage: score, color: 'warning', text: 'Kata sandi cukup' };
            } else if (score < 90) {
                return { percentage: score, color: 'info', text: 'Kata sandi baik' };
            } else {
                return { percentage: score, color: 'success', text: 'Kata sandi kuat' };
            }
        }

               // Update password strength indicator
        function updatePasswordStrengthIndicator(input, strength) {
            const existingIndicator = input.parentElement.querySelector('.password-strength');
            if (existingIndicator) {
                existingIndicator.remove();
            }

            if (input.value.length > 0) {
                const indicator = document.createElement('div');
                indicator.className = 'password-strength mt-2';
                indicator.innerHTML = `
                    <div class="progress" style="height: 6px; border-radius: 10px; background: rgba(34, 139, 34, 0.1);">
                        <div class="progress-bar bg-${strength.color}" 
                             style="width: ${strength.percentage}%; border-radius: 10px; transition: all 0.3s ease;"></div>
                    </div>
                    <small class="text-${strength.color} mt-1 d-block">${strength.text}</small>
                `;
                input.parentElement.appendChild(indicator);
            }
        }

        // Generate 2FA QR Code with Indonesian messages
        function generate2FAQRCode() {
            const generateBtn = event.target;
            const originalText = generateBtn.innerHTML;

            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membuat...';
            generateBtn.disabled = true;
            generateBtn.classList.add('loading');

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

                    if (qrContainer) {
                        qrContainer.innerHTML = data.qr_code;
                        qrContainer.classList.add('float-animation');
                    }
                    if (secretKeyElement) secretKeyElement.textContent = data.secret_key;
                    if (hiddenSecretKey) hiddenSecretKey.value = data.secret_key;
                } else {
                    showNotification(data.message || 'Gagal membuat kode QR', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat membuat kode QR', 'error');
            })
            .finally(() => {
                generateBtn.innerHTML = originalText;
                generateBtn.disabled = false;
                generateBtn.classList.remove('loading');
            });
        }

        // Disable 2FA with Indonesian messages
        function disable2FA() {
            const password = document.getElementById('disable_password').value;

            if (!password) {
                showNotification('Silakan masukkan kata sandi Anda', 'error');
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
                    showNotification('2FA berhasil dinonaktifkan', 'success');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('disable2FAModal'));
                    if (modal) modal.hide();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || 'Gagal menonaktifkan 2FA', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menonaktifkan 2FA', 'error');
            });
        }

        // Delete Account with Indonesian messages
        function deleteAccount() {
            const password = document.getElementById('delete_password').value;
            const confirmation = document.getElementById('delete_confirmation').value;

            if (!password || confirmation !== 'HAPUS') {
                showNotification('Silakan isi semua field yang diperlukan dengan benar', 'error');
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
                    showNotification('Akun berhasil dihapus', 'success');
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
                        showNotification(data.message || 'Gagal menghapus akun', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menghapus akun', 'error');
            });
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }

            .shake {
                animation: shake 0.5s ease-in-out;
            }
        `;
        document.head.appendChild(style);

        // Add form validation animations
        function addValidationAnimation(element, isValid) {
            if (isValid) {
                element.style.borderColor = 'var(--emerald-green)';
                element.style.boxShadow = '0 0 0 0.2rem rgba(34, 139, 34, 0.25)';
            } else {
                element.style.borderColor = '#dc3545';
                element.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
                element.classList.add('shake');
                setTimeout(() => element.classList.remove('shake'), 500);
            }
        }

        // Enhanced form validation
        document.querySelectorAll('.modern-input').forEach(input => {
            input.addEventListener('blur', function() {
                const isValid = this.checkValidity();
                addValidationAnimation(this, isValid);
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    this.style.borderColor = 'rgba(34, 139, 34, 0.2)';
                    this.style.boxShadow = 'none';
                }
            });
        });

        // Add smooth transitions to all interactive elements
        document.querySelectorAll('.modern-btn-primary, .modern-btn-warning, .modern-btn-danger, .modern-btn-outline-primary, .modern-btn-outline-danger').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);
    </script>
@endpush

