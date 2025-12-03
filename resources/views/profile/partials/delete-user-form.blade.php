<section class="space-y-6">
    <header class="mb-3">
        <h6 class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Delete Account</h6>
        <p class="small text-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Delete Account') }}
    </button>
</section>