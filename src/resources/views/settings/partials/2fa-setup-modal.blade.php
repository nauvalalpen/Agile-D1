<!-- 2FA Setup Modal -->
<div class="modal fade" id="setup2FAModal" tabindex="-1" aria-labelledby="setup2FAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="setup2FAModalLabel">
                    <i class="fas fa-shield-alt me-2"></i>
                    Setup Two-Factor Authentication
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">
                            <i class="fas fa-mobile-alt me-2"></i>
                            Step 1: Install Authenticator App
                        </h6>
                        <p class="small text-muted mb-3">
                            Download and install one of these authenticator apps on your mobile device:
                        </p>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="badge bg-light text-dark">
                                <i class="fab fa-google me-1"></i>Google Authenticator
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-key me-1"></i>Authy
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fab fa-microsoft me-1"></i>Microsoft Authenticator
                            </span>
                        </div>

                        <h6 class="mb-3">
                            <i class="fas fa-qrcode me-2"></i>
                            Step 2: Scan QR Code
                        </h6>
                        <div class="text-center mb-3">
                            <img id="qrCode" src="" alt="2FA QR Code" class="img-fluid border rounded"
                                style="max-width: 200px;">
                        </div>
                        <p class="small text-muted text-center">
                            Scan this QR code with your authenticator app
                        </p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="mb-3">
                            <i class="fas fa-key me-2"></i>
                            Alternative: Manual Entry
                        </h6>
                        <p class="small text-muted mb-2">
                            If you can't scan the QR code, manually enter this secret key:
                        </p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control font-monospace small" id="secretKey" readonly>
                            <button class="btn btn-outline-secondary" type="button" data-copy="" id="copySecretBtn">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>

                        <h6 class="mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Step 3: Verify Setup
                        </h6>
                        <form id="verify2FAForm" action="{{ route('settings.2fa.enable') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="verification_code" class="form-label">
                                    Enter the 6-digit code from your app:
                                </label>
                                <input type="text" class="form-control text-center font-monospace"
                                    id="verification_code" name="verification_code" maxlength="6" pattern="[0-9]{6}"
                                    required placeholder="000000" style="font-size: 1.2rem; letter-spacing: 0.2em;">
                                <div class="invalid-feedback">
                                    Please enter a valid 6-digit code.
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>
                                    <strong>Important:</strong> Save your backup codes in a secure location.
                                    You'll need them if you lose access to your authenticator app.
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>
                    Cancel
                </button>
                <button type="submit" form="verify2FAForm" class="btn btn-primary">
                    <i class="fas fa-shield-alt me-2"></i>
                    Enable 2FA
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('setup2FAModal');
        const form = document.getElementById('verify2FAForm');
        const codeInput = document.getElementById('verification_code');
        const copyBtn = document.getElementById('copySecretBtn');
        const secretKey = document.getElementById('secretKey');

        // Auto-format verification code input
        if (codeInput) {
            codeInput.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');

                // Remove invalid class when user starts typing
                this.classList.remove('is-invalid');
            });

            // Auto-submit when 6 digits are entered
            codeInput.addEventListener('input', function(e) {
                if (this.value.length === 6) {
                    // Small delay to show the complete code
                    setTimeout(() => {
                        if (this.value.length === 6) {
                            form.dispatchEvent(new Event('submit'));
                        }
                    }, 500);
                }
            });
        }

        // Copy secret key functionality
        if (copyBtn && secretKey) {
            copyBtn.addEventListener('click', async function() {
                try {
                    await navigator.clipboard.writeText(secretKey.value);

                    // Update button to show success
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check text-success"></i>';
                    this.classList.add('btn-success');
                    this.classList.remove('btn-outline-secondary');

                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-secondary');
                    }, 2000);

                    // Show toast notification
                    if (window.settingsManager) {
                        window.settingsManager.showNotification('Secret key copied to clipboard!',
                            'success');
                    }
                } catch (error) {
                    console.error('Failed to copy:', error);
                }
            });

            // Update copy button data attribute when secret changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                        copyBtn.setAttribute('data-copy', secretKey.value);
                    }
                });
            });
            observer.observe(secretKey, {
                attributes: true
            });
        }

        // Form submission handling
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const code = codeInput.value;
                if (code.length !== 6) {
                    codeInput.classList.add('is-invalid');
                    return;
                }

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                try {
                    // Show loading state
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2"></span>Verifying...';
                    submitBtn.disabled = true;

                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Show success message
                        if (window.settingsManager) {
                            window.settingsManager.showNotification(
                                'Two-factor authentication enabled successfully!', 'success');
                        }

                        // Show backup codes if provided
                        if (result.backup_codes) {
                            this.showBackupCodes(result.backup_codes);
                        } else {
                            // Close modal and reload page
                            bootstrap.Modal.getInstance(modal).hide();
                            setTimeout(() => location.reload(), 1000);
                        }
                    } else {
                        throw new Error(result.message || 'Verification failed');
                    }
                } catch (error) {
                    codeInput.classList.add('is-invalid');
                    const feedback = codeInput.parentNode.querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.textContent = error.message;
                    }

                    if (window.settingsManager) {
                        window.settingsManager.showNotification('Verification failed: ' + error
                            .message, 'error');
                    }
                } finally {
                    // Restore button state
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }

        // Show backup codes modal
        function showBackupCodes(codes) {
            const backupModal = document.getElementById('backupCodesModal');
            if (backupModal) {
                const codesList = backupModal.querySelector('#backupCodesList');
                if (codesList && codes) {
                    codesList.innerHTML = codes.map(code =>
                        `<li class="list-group-item d-flex justify-content-between align-items-center font-monospace">
                        ${code}
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('${code}')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </li>`
                    ).join('');
                }

                // Hide setup modal and show backup codes modal
                bootstrap.Modal.getInstance(modal).hide();
                new bootstrap.Modal(backupModal).show();
            } else {
                // Fallback: just reload the page
                setTimeout(() => location.reload(), 1000);
            }
        }

        // Reset form when modal is hidden
        modal.addEventListener('hidden.bs.modal', function() {
            if (form) {
                form.reset();
                codeInput.classList.remove('is-invalid');
            }
        });
    });

    // Global function for copying backup codes
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            if (window.settingsManager) {
                window.settingsManager.showNotification('Backup code copied!', 'success');
            }
        });
    }
</script>
