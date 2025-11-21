<section>
    <header class="mb-4">
        <h6 class="fw-bold text-dark">Update Password</h6>
        <p class="small text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Current Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="current_password" 
                       class="form-control border-start-0 @error('current_password') is-invalid @enderror" 
                       placeholder="Enter current password" autocomplete="current-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password text-muted" style="cursor: pointer;"></i>
                </span>
            </div>
            @error('current_password')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">New Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                <input type="password" name="password" 
                       class="form-control border-start-0 @error('password') is-invalid @enderror" 
                       placeholder="Enter new password" autocomplete="new-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password text-muted" style="cursor: pointer;"></i>
                </span>
            </div>
            @error('password')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-check-circle text-muted"></i></span>
                <input type="password" name="password_confirmation" 
                       class="form-control border-start-0" 
                       placeholder="Repeat new password" autocomplete="new-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password text-muted" style="cursor: pointer;"></i>
                </span>
            </div>
            </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 text-white">
                {{ __('Update Password') }}
            </button>
        </div>
    </form>
</section>