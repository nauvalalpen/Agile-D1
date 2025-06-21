/**
 * Settings Page JavaScript
 * Enhanced user experience for settings management
 */

class SettingsManager {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeComponents();
        this.setupFormValidation();
        this.setupAutoSave();
    }

    bindEvents() {
        // Profile photo upload
        document.getElementById('photoInput')?.addEventListener('change', this.handlePhotoUpload.bind(this));
        
        // Password visibility toggles
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', this.togglePasswordVisibility.bind(this));
        });

        // Form submissions
        document.querySelectorAll('form[data-ajax="true"]').forEach(form => {
            form.addEventListener('submit', this.handleAjaxSubmit.bind(this));
        });

        // Account deletion confirmation
        document.getElementById('deleteAccountBtn')?.addEventListener('click', this.confirmAccountDeletion.bind(this));

        // 2FA setup
        document.getElementById('enable2FABtn')?.addEventListener('click', this.setup2FA.bind(this));
        document.getElementById('disable2FABtn')?.addEventListener('click', this.disable2FA.bind(this));

        // Export data
        document.getElementById('exportDataBtn')?.addEventListener('click', this.exportUserData.bind(this));

        // Tab navigation
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', this.handleTabChange.bind(this));
        });
    }

    initializeComponents() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Initialize progress bars
        this.animateProgressBars();

        // Load saved tab state
        this.loadTabState();
    }

    setupFormValidation() {
        // Real-time password strength checking
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', this.checkPasswordStrength.bind(this));
        }

        // Email validation
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('blur', this.validateEmail.bind(this));
        }

        // Form validation on submit
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', this.validateForm.bind(this));
        });
    }

    setupAutoSave() {
        // Auto-save preferences
        document.querySelectorAll('input[type="checkbox"][data-autosave="true"]').forEach(checkbox => {
            checkbox.addEventListener('change', this.autoSavePreference.bind(this));
        });
    }

    handlePhotoUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Validate file
        if (!this.validateImageFile(file)) {
            this.showNotification('Please select a valid image file (JPG, PNG, GIF) under 2MB.', 'error');
            return;
        }

        // Preview image
        this.previewImage(file);

        // Upload image
        this.uploadPhoto(file);
    }

    validateImageFile(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        return allowedTypes.includes(file.type) && file.size <= maxSize;
    }

    previewImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const preview = document.getElementById('photoPreview');
            if (preview) {
                preview.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    }

    async uploadPhoto(file) {
        const formData = new FormData();
        formData.append('photo', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        try {
            this.showLoading('Uploading photo...');
            
            const response = await fetch('/settings/photo', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                this.showNotification('Photo updated successfully!', 'success');
                // Update all photo instances
                document.querySelectorAll('.user-photo').forEach(img => {
                    img.src = result.photo_url;
                });
            } else {
                throw new Error(result.message || 'Upload failed');
            }
        } catch (error) {
            this.showNotification('Failed to upload photo: ' + error.message, 'error');
        } finally {
            this.hideLoading();
        }
    }

    togglePasswordVisibility(event) {
        const button = event.currentTarget;
        const input = button.previousElementSibling;
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
    }

    async handleAjaxSubmit(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');

        try {
            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
            submitBtn.disabled = true;

            const response = await fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (result.success) {
                this.showNotification(result.message || 'Settings updated successfully!', 'success');
                
                // Update UI if needed
                if (result.updates) {
                    this.applyUIUpdates(result.updates);
                }
            } else {
                throw new Error(result.message || 'Update failed');
            }
        } catch (error) {
            this.showNotification('Error: ' + error.message, 'error');
        } finally {
            // Restore button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    confirmAccountDeletion() {
        const modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
        modal.show();
    }

    async setup2FA() {
        try {
            this.showLoading('Generating 2FA setup...');

            const response = await fetch('/settings/2fa/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const result = await response.json();

            if (result.success) {
                this.show2FASetupModal(result.qr_code, result.secret);
            } else {
                throw new Error(result.message || '2FA setup failed');
            }
        } catch (error) {
            this.showNotification('Error setting up 2FA: ' + error.message, 'error');
        } finally {
            this.hideLoading();
        }
    }

    show2FASetupModal(qrCode, secret) {
        const modal = document.getElementById('setup2FAModal');
        modal.querySelector('#qrCode').src = qrCode;
        modal.querySelector('#secretKey').textContent = secret;
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    async disable2FA() {
        if (!confirm('Are you sure you want to disable two-factor authentication? This will make your account less secure.')) {
            return;
        }

        try {
            const response = await fetch('/settings/2fa/disable', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const result = await response.json();

            if (result.success) {
                this.showNotification('Two-factor authentication disabled.', 'warning');
                location.reload(); // Refresh to update UI
            } else {
                throw new Error(result.message || '2FA disable failed');
            }
        } catch (error) {
            this.showNotification('Error disabling 2FA: ' + error.message, 'error');
        }
    }

    async exportUserData() {
        try {
            this.showLoading('Preparing your data export...');

            const response = await fetch('/settings/data/export', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `onevision-data-export-${new Date().toISOString().split('T')[0]}.json`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                this.showNotification('Data export downloaded successfully!', 'success');
            } else {
                throw new Error('Export failed');
            }
        } catch (error) {
            this.showNotification('Error exporting data: ' + error.message, 'error');
        } finally {
            this.hideLoading();
        }
    }

    checkPasswordStrength(event) {
        const password = event.target.value;
        const strengthMeter = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('passwordStrengthText');

        if (!strengthMeter || !strengthText) return;

        const strength = this.calculatePasswordStrength(password);
        
        strengthMeter.className = `progress-bar bg-${strength.color}`;
        strengthMeter.style.width = `${strength.percentage}%`;
        strengthMeter.setAttribute('aria-valuenow', strength.percentage);
        
        strengthText.textContent = strength.text;
        strengthText.className = `small text-${strength.color}`;
    }

    calculatePasswordStrength(password) {
        let score = 0;
        let feedback = [];

        if (password.length >= 8) score += 25;
        else feedback.push('at least 8 characters');

        if (/[a-z]/.test(password)) score += 25;
        else feedback.push('lowercase letters');

        if (/[A-Z]/.test(password)) score += 25;
        else feedback.push('uppercase letters');

        if (/[0-9]/.test(password)) score += 25;
        else feedback.push('numbers');

        if (/[^A-Za-z0-9]/.test(password)) score += 25;
        else feedback.push('special characters');

        if (password.length >= 12) score += 10;
        if (/(.)\1{2,}/.test(password)) score -= 10; // Repeated characters

        let strength = {
            percentage: Math.min(score, 100),
            text: '',
            color: ''
        };

        if (score >= 80) {
            strength.text = 'Strong password';
            strength.color = 'success';
        } else if (score >= 60) {
            strength.text = 'Good password';
            strength.color = 'info';
        } else if (score >= 40) {
            strength.text = 'Fair password';
            strength.color = 'warning';
        } else {
            strength.text = 'Weak password';
            strength.color = 'danger';
        }

        if (feedback.length > 0 && score < 80) {
            strength.text += ` (add ${feedback.slice(0, 2).join(', ')})`;
        }

        return strength;
    }

    validateEmail(event) {
        const email = event.target.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const feedback = event.target.parentNode.querySelector('.invalid-feedback');

        if (email && !emailRegex.test(email)) {
            event.target.classList.add('is-invalid');
            if (feedback) feedback.textContent = 'Please enter a valid email address.';
        } else {
            event.target.classList.remove('is-invalid');
            if (feedback) feedback.textContent = '';
        }
    }

    validateForm(event) {
        const form = event.target;
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        // Password confirmation validation
        const password = form.querySelector('input[name="password"]');
        const passwordConfirm = form.querySelector('input[name="password_confirmation"]');
        
        if (password && passwordConfirm && password.value !== passwordConfirm.value) {
            passwordConfirm.classList.add('is-invalid');
            const feedback = passwordConfirm.parentNode.querySelector('.invalid-feedback');
            if (feedback) feedback.textContent = 'Passwords do not match.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
            this.showNotification('Please correct the errors in the form.', 'error');
        }

        return isValid;
    }

    async autoSavePreference(event) {
        const checkbox = event.target;
        const form = checkbox.closest('form');
        
        if (!form) return;

        try {
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
                // Show subtle success indicator
                this.showAutoSaveIndicator(checkbox, true);
            } else {
                throw new Error(result.message || 'Auto-save failed');
            }
        } catch (error) {
            // Revert checkbox state
            checkbox.checked = !checkbox.checked;
            this.showAutoSaveIndicator(checkbox, false);
            this.showNotification('Failed to save preference: ' + error.message, 'error');
        }
    }

    showAutoSaveIndicator(element, success) {
        const indicator = document.createElement('span');
        indicator.className = `ms-2 small text-${success ? 'success' : 'danger'}`;
        indicator.innerHTML = success ? '<i class="fas fa-check"></i> Saved' : '<i class="fas fa-times"></i> Error';
        
        // Remove existing indicators
        const existing = element.parentNode.querySelector('.autosave-indicator');
        if (existing) existing.remove();
        
        indicator.classList.add('autosave-indicator');
        element.parentNode.appendChild(indicator);
        
        // Remove after 2 seconds
        setTimeout(() => {
            if (indicator.parentNode) {
                indicator.remove();
            }
        }, 2000);
    }

    handleTabChange(event) {
        const tabId = event.target.getAttribute('href').substring(1);
        
        // Save active tab to localStorage
        localStorage.setItem('settings-active-tab', tabId);
        
        // Update URL hash without scrolling
        if (history.replaceState) {
            history.replaceState(null, null, '#' + tabId);
        }
        
        // Trigger any tab-specific initialization
        this.initializeTabContent(tabId);
    }

    loadTabState() {
        // Load from URL hash or localStorage
        let activeTab = window.location.hash.substring(1) || localStorage.getItem('settings-active-tab');
        
        if (activeTab && document.getElementById(activeTab)) {
            const tabTrigger = document.querySelector(`[href="#${activeTab}"]`);
            if (tabTrigger) {
                const tab = new bootstrap.Tab(tabTrigger);
                tab.show();
            }
        }
    }

    initializeTabContent(tabId) {
        switch (tabId) {
            case 'security':
                this.initializeSecurityTab();
                break;
            case 'privacy':
                this.initializePrivacyTab();
                break;
            case 'data':
                this.initializeDataTab();
                break;
        }
    }

    initializeSecurityTab() {
        // Animate security score
        const scoreElement = document.getElementById('securityScore');
        if (scoreElement) {
            const score = parseInt(scoreElement.dataset.score);
            this.animateCounter(scoreElement, 0, score, 1000);
        }
    }

    initializePrivacyTab() {
        // Initialize privacy-related components
        this.updatePrivacyImpactIndicators();
    }

    initializeDataTab() {
        // Show data usage statistics
        this.loadDataUsageStats();
    }

    animateProgressBars() {
        document.querySelectorAll('.progress-bar[data-animate="true"]').forEach(bar => {
            const width = bar.style.width || bar.getAttribute('aria-valuenow') + '%';
            bar.style.width = '0%';
            
            setTimeout(() => {
                bar.style.transition = 'width 1s ease-in-out';
                bar.style.width = width;
            }, 100);
        });
    }

    animateCounter(element, start, end, duration) {
        const range = end - start;
        const increment = range / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= end) {
                current = end;
                clearInterval(timer);
            }
            element.textContent = Math.round(current);
        }, 16);
    }

    updatePrivacyImpactIndicators() {
        document.querySelectorAll('[data-privacy-impact]').forEach(element => {
            const impact = element.dataset.privacyImpact;
            const indicator = element.querySelector('.privacy-impact');
            
            if (indicator) {
                indicator.className = `privacy-impact badge bg-${this.getPrivacyImpactColor(impact)}`;
                indicator.textContent = impact.charAt(0).toUpperCase() + impact.slice(1) + ' Impact';
            }
        });
    }

    getPrivacyImpactColor(impact) {
        switch (impact) {
            case 'high': return 'danger';
            case 'medium': return 'warning';
            case 'low': return 'success';
            default: return 'secondary';
        }
    }

    async loadDataUsageStats() {
        try {
            const response = await fetch('/settings/data/stats', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                const stats = await response.json();
                this.displayDataUsageStats(stats);
            }
        } catch (error) {
            console.error('Failed to load data usage stats:', error);
        }
    }

    displayDataUsageStats(stats) {
        const container = document.getElementById('dataUsageStats');
        if (!container || !stats) return;

        container.innerHTML = `
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                            <h4>${stats.orders_count || 0}</h4>
                            <small>Total Orders</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-images fa-2x mb-2"></i>
                            <h4>${stats.photos_count || 0}</h4>
                            <small>Photos Uploaded</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x mb-2"></i>
                            <h4>${stats.login_count || 0}</h4>
                            <small>Login Sessions</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    applyUIUpdates(updates) {
        Object.keys(updates).forEach(selector => {
            const elements = document.querySelectorAll(selector);
            const update = updates[selector];
            
            elements.forEach(element => {
                if (update.text) element.textContent = update.text;
                if (update.html) element.innerHTML = update.html;
                if (update.class) {
                    element.className = update.class;
                }
                if (update.attributes) {
                    Object.keys(update.attributes).forEach(attr => {
                        element.setAttribute(attr, update.attributes[attr]);
                    });
                }
            });
        });
    }

    showLoading(message = 'Loading...') {
        // Create or show loading overlay
        let overlay = document.getElementById('loadingOverlay');
        
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'loadingOverlay';
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="loading-content">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="loading-message">${message}</div>
                </div>
            `;
            document.body.appendChild(overlay);
        } else {
            overlay.querySelector('.loading-message').textContent = message;
            overlay.style.display = 'flex';
        }
    }

    hideLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
            overlay.style.display = 'none';
        }
    }

    showNotification(message, type = 'info') {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-${this.getNotificationIcon(type)} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        // Add to toast container
        let container = document.getElementById('toastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '1055';
            document.body.appendChild(container);
        }

        container.appendChild(toast);

        // Show toast
        const bsToast = new bootstrap.Toast(toast, {
            autohide: true,
            delay: type === 'error' ? 8000 : 5000
        });
        bsToast.show();

        // Remove from DOM after hiding
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    getNotificationIcon(type) {
        switch (type) {
            case 'success': return 'check-circle';
            case 'error': return 'exclamation-triangle';
            case 'warning': return 'exclamation-circle';
            case 'info': return 'info-circle';
            default: return 'info-circle';
        }
    }

    // Utility method to copy text to clipboard
    async copyToClipboard(text, successMessage = 'Copied to clipboard!') {
        try {
            await navigator.clipboard.writeText(text);
            this.showNotification(successMessage, 'success');
        } catch (error) {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            this.showNotification(successMessage, 'success');
        }
    }

    // Method to handle copy buttons
    setupCopyButtons() {
        document.querySelectorAll('[data-copy]').forEach(button => {
            button.addEventListener('click', (e) => {
                const text = e.target.dataset.copy;
                this.copyToClipboard(text);
            });
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new SettingsManager();
});

// Add CSS for loading overlay and other components
const settingsStyles = `
<style>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-content {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.loading-message {
    font-weight: 500;
    color: #333;
}

.password-toggle {
    cursor: pointer;
    border-left: none !important;
}

.password-toggle:hover {
    background-color: #f8f9fa;
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

.privacy-impact {
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
}

.autosave-indicator {
    opacity: 0;
    animation: fadeInOut 2s ease-in-out;
}

@keyframes fadeInOut {
    0%, 100% { opacity: 0; }
    20%, 80% { opacity: 1; }
}

.settings-card {
    transition: transform 0.2s ease-in-out;
}

.settings-card:hover {
    transform: translateY(-2px);
}

.tab-content {
    min-height: 400px;
}

.form-control:focus,
.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
}

.progress {
    height: 8px;
}

.progress-bar {
    transition: width 0.6s ease;
}

.card-stats {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.card-stats .card-body {
    padding: 1.5rem;
}

.security-recommendations .list-group-item {
    border-left: 4px solid transparent;
}

.security-recommendations .list-group-item.warning {
    border-left-color: #ffc107;
}

.security-recommendations .list-group-item.danger {
    border-left-color: #dc3545;
}

.security-recommendations .list-group-item.info {
    border-left-color: #0dcaf0;
}

.toast-container {
    z-index: 1055;
}

.user-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
}

.photo-upload-container:hover .photo-upload-overlay {
    opacity: 1;
}

.settings-section {
    margin-bottom: 2rem;
}

.settings-section h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.form-switch .form-check-input {
    width: 3rem;
    height: 1.5rem;
}

.form-switch .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

@media (max-width: 768px) {
    .user-avatar-large {
        width: 80px;
        height: 80px;
    }
    
    .loading-content {
        margin: 1rem;
        padding: 1.5rem;
    }
    
    .security-score-circle {
        width: 80px;
        height: 80px;
        font-size: 1.2rem;
    }
}
</style>
`;

// Inject styles
document.head.insertAdjacentHTML('beforeend', settingsStyles);

