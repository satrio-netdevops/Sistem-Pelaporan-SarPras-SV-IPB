<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand" style="font-size: 2.5rem;">🔒</span>
        <h3 class="fw-bold text-dark mb-1">Reset Password</h3>
        <p class="text-muted small">Create a new strong password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <label class="small fw-bold mb-1 text-muted">Email Address</label>
        <div class="modern-input-group">
            <i class="fas fa-envelope"></i>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly style="opacity: 0.7; cursor: not-allowed;">
        </div>
        @error('email') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <label class="small fw-bold mb-1 text-muted mt-2">Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="New password" required style="flex-grow: 1;">
            <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>
        @error('password') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror
        <div class="text-muted " style="font-size: 0.75rem;">Your password must be 8 characters at least</div>

        <label class="small fw-bold mb-1 text-muted mt-2">Confirm Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-check-circle"></i>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repeat new password" required style="flex-grow: 1;">
            <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Reset Password
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="small fw-bold text-primary text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>