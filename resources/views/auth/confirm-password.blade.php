<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand" style="font-size: 2.5rem;">🛡️</span>
        <h3 class="fw-bold text-dark mb-1">Secure Area</h3>
        <p class="text-muted small">This is a secure area of the application. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <label class="small fw-bold mb-1 text-muted">Password</label>
        <div class="modern-input-group">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
        </div>
        @error('password') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror
        <div class="text-muted " style="font-size: 0.75rem;">Your password must be 8 characters at least</div>

        <button type="submit" class="btn btn-primary mt-3">
            Confirm
        </button>
    </form>
</x-guest-layout>