<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand" style="font-size: 2.5rem;">🔑</span>
        <h3 class="fw-bold text-dark mb-1">Forgot Password?</h3>
        <p class="text-muted small">No worries! Enter your email and we'll send you reset instructions.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label class="small fw-bold mb-1 text-muted">Email Address <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-envelope"></i>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your registered email" required autofocus>
        </div>
        @error('email') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <div class="recaptcha-wrapper">
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        </div>
        @error('g-recaptcha-response') <div class="text-danger small text-center mb-3 mt-n2"> {{ $message }} </div> @enderror

        <button type="submit" class="btn btn-primary">
            Email Password Reset Link
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="small fw-bold text-primary text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>