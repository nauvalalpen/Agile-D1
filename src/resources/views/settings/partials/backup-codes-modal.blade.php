<!-- Backup Codes Modal -->
<div class="modal fade" id="backupCodesModal" tabindex="-1" aria-labelledby="backupCodesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="backupCodesModalLabel">
                    <i class="fas fa-key me-2"></i>
                    Your Backup Codes
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Important:</strong> Save these backup codes in a secure location. Each code can only be used
                    once.
                </div>

                <p class="mb-3">
                    Use these codes to access your account if you lose your authenticator device:
                </p>

                <ul class="list-group mb-3" id="backupCodesList">
                    <!-- Backup codes will be populated here -->
                </ul>

                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary" id="downloadBackupCodes">
                        <i class="fas fa-download me-2"></i>
                        Download as Text File
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="printBackupCodes">
                        <i class="fas fa-print me-2"></i>
                        Print Backup Codes
                    </button>
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Keep these codes safe and accessible. You won't be able to see them again after closing this
                        window.
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="confirmBackupSaved">
                    <i class="fas fa-check me-2"></i>
                    I've Saved My Backup Codes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('backupCodesModal');
        const downloadBtn = document.getElementById('downloadBackupCodes');
        const printBtn = document.getElementById('printBackupCodes');
        const confirmBtn = document.getElementById('confirmBackupSaved');

        // Download backup codes as text file
        if (downloadBtn) {
            downloadBtn.addEventListener('click', function() {
                const codes = Array.from(document.querySelectorAll('#backupCodesList .font-monospace'))
                    .map(el => el.textContent.trim())
                    .filter(code => code.length > 0);

                if (codes.length === 0) return;

                const content = `OneVision Account - Two-Factor Authentication Backup Codes
Generated: ${new Date().toLocaleString()}

IMPORTANT: Keep these codes safe and secure!
Each code can only be used once to access your account if you lose your authenticator device.

Backup Codes:
${codes.map((code, index) => `${index + 1}. ${code}`).join('\n')}

Instructions:
1. Store these codes in a secure location (password manager, safe, etc.)
2. Do not share these codes with anyone
3. Each code can only be used once
4. Generate new codes if you suspect these have been compromised

For support, contact: support@onevision.com
`;

                const blob = new Blob([content], {
                    type: 'text/plain'
                });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `onevision-backup-codes-${new Date().toISOString().split('T')[0]}.txt`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                if (window.settingsManager) {
                    window.settingsManager.showNotification('Backup codes downloaded successfully!',
                        'success');
                }
            });
        }

        // Print backup codes
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                const codes = Array.from(document.querySelectorAll('#backupCodesList .font-monospace'))
                    .map(el => el.textContent.trim())
                    .filter(code => code.length > 0);

                if (codes.length === 0) return;

                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>OneVision - 2FA Backup Codes</title>
                    <style>
                        body { 
                            font-family: Arial, sans-serif; 
                            max-width: 600px; 
                            margin: 0 auto; 
                            padding: 20px; 
                        }
                        .header { 
                            text-align: center; 
                            border-bottom: 2px solid #333; 
                            padding-bottom: 20px; 
                            margin-bottom: 30px; 
                        }
                        .warning { 
                            background: #fff3cd; 
                            border: 1px solid #ffeaa7; 
                            padding: 15px; 
                            border-radius: 5px; 
                            margin-bottom: 20px; 
                        }
                        .codes { 
                            background: #f8f9fa; 
                            padding: 20px; 
                            border-radius: 5px; 
                            margin: 20px 0; 
                        }
                        .code { 
                            font-family: 'Courier New', monospace; 
                            font-size: 16px; 
                            padding: 8px; 
                            margin: 5px 0; 
                            background: white; 
                            border: 1px solid #ddd; 
                            border-radius: 3px; 
                        }
                        .instructions { 
                            margin-top: 30px; 
                            font-size: 14px; 
                            line-height: 1.6; 
                        }
                        @media print {
                            body { margin: 0; }
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>OneVision Account</h1>
                        <h2>Two-Factor Authentication Backup Codes</h2>
                        <p>Generated: ${new Date().toLocaleString()}</p>
                    </div>

                    <div class="warning">
                        <strong>⚠️ IMPORTANT:</strong> Keep these codes safe and secure!<br>
                        Each code can only be used once to access your account if you lose your authenticator device.
                    </div>

                    <div class="codes">
                        <h3>Your Backup Codes:</h3>
                        ${codes.map((code, index) => `<div class="code">${index + 1}. ${code}</div>`).join('')}
                    </div>

                    <div class="instructions">
                        <h3>Instructions:</h3>
                        <ol>
                            <li>Store these codes in a secure location (password manager, safe, etc.)</li>
                            <li>Do not share these codes with anyone</li>
                            <li>Each code can only be used once</li>
                            <li>Generate new codes if you suspect these have been compromised</li>
                        </ol>
                        
                        <p><strong>For support:</strong> support@onevision.com</p>
                    </div>
                </body>
                </html>
            `);
                printWindow.document.close();
                printWindow.print();
            });
        }

        // Handle confirmation and close
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (window.settingsManager) {
                    window.settingsManager.showNotification('Two-factor authentication is now active!',
                        'success');
                }

                // Reload page to show updated 2FA status
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        }

        // Prevent accidental closing
        modal.addEventListener('hide.bs.modal', function(e) {
            if (!e.target.classList.contains('modal') && !confirmBtn.contains(e.relatedTarget)) {
                if (!confirm(
                        'Are you sure you want to close without saving your backup codes? You won\'t be able to see them again.'
                        )) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
