<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand">👋</span>
        <h3 class="fw-bold text-dark mb-1">Masuk ke SarPras SV IPB</h3>
        <p class="text-muted small">Selamat datang! Silakan masuk menggunakan nama akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label class="small fw-bold mb-1 text-muted">Username (Nama Depan Email) <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-user-circle"></i>
            <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: satrio (tanpa @...)" required autofocus autocomplete="username">
        </div>
        @error('username') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <label class="small fw-bold mb-1 text-muted mt-2">Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="Masukan kata sandi" required style="flex-grow: 1;">
            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>
        @error('password') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror
        
        <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Ingat saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

        {{-- <div class="text-center mt-4 small text-muted">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Daftar di sini</a>
        </div> --}}
    </form>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</x-guest-layout>