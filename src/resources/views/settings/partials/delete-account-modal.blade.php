<!-- Delete Account Confirmation Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Delete Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>

                <p class="mb-3">
                    Deleting your account will permanently remove:
                </p>

                <ul class="list-unstyled mb-4">
                    <li class="mb-2">
                        <i class="fas fa-times text-danger me-2"></i>
                        Your profile information and settings
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-times text-danger me-2"></i>
                        All your order history
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-times text-danger me-2"></i>
                        Uploaded photos and files
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-times text-danger me-2"></i>
                        Account preferences and notifications
                    </li>
                </ul>

                <div class="bg-light p-3 rounded mb-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Before you delete:</strong> Consider exporting your data first if you want to keep a
                        copy of your information.
                    </small>
                </div>

                <form id="deleteAccountForm" action="{{ route('settings.account.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label for="deleteConfirmPassword" class="form-label">
                            <strong>Enter your password to confirm:</strong>
                        </label>
                        <input type="password" class="form-control" id="deleteConfirmPassword" name="password" required
                            placeholder="Your current password">
                        <div class="invalid-feedback">
                            Please enter your password to confirm account deletion.
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="deleteConfirmCheck" required>
                        <label class="form-check-label" for="deleteConfirmCheck">
                            I understand that this action cannot be undone and I want to permanently delete my account.
                        </label>
                        <div class="invalid-feedback">
                            You must confirm that you understand this action cannot be undone.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-arrow-left me-2"></i>
                    Cancel
                </button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>
                    Delete My Account
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('deleteAccountForm');
        const modal = document.getElementById('deleteAccountModal');

        if (deleteForm && modal) {
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const password = document.getElementById('deleteConfirmPassword').value;
                const checkbox = document.getElementById('deleteConfirmCheck').checked;

                if (!password) {
                    document.getElementById('deleteConfirmPassword').classList.add('is-invalid');
                    return;
                }

                if (!checkbox) {
                    document.getElementById('deleteConfirmCheck').classList.add('is-invalid');
                    return;
                }

                // Final confirmation
                if (confirm(
                        'Are you absolutely sure? This will permanently delete your account and all associated data.'
                        )) {
                    // Show loading state
                    const submitBtn = deleteForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2"></span>Deleting...';
                    submitBtn.disabled = true;

                    // Submit form
                    deleteForm.submit();
                }
            });

            // Clear validation on input
            document.getElementById('deleteConfirmPassword').addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });

            document.getElementById('deleteConfirmCheck').addEventListener('change', function() {
                this.classList.remove('is-invalid');
            });
        }
    });
</script>
