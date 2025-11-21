<x-guest-layout>
    <div class="mb-4 text-center">
        <span class="waving-hand" style="font-size: 3rem;">📧</span>
        <h3 class="fw-bold text-dark mb-2">Verify Your Email</h3>
        <p class="text-muted small">
            Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>

    <div class="d-grid gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none text-muted small fw-bold">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>