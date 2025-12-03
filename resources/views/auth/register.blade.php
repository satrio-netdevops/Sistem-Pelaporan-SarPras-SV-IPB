<x-guest-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Khusus (Sama dengan Login) */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .register-header-text {
            color: #001f5f; /* Warna Biru Gelap IPB */
        }
        
        .text-description {
            color: #555555;
            font-weight: 400;
        }

        .text-input-label {
            color: #344767; 
            font-weight: 700 !important; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }

        .modern-input-group {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .modern-input-group:focus-within {
            border-color: #00aaff;
            box-shadow: 0 0 0 4px rgba(0, 170, 255, 0.1);
            background-color: #fff;
        }

        .modern-input-group i.input-icon {
            color: #6c757d;
            transition: color 0.3s ease;
            width: 20px; /* Lebar tetap agar align rapi */
            text-align: center;
        }

        .modern-input-group:focus-within i.input-icon {
            color: #00aaff;
        }

        .modern-input-group input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            padding-left: 12px;
            font-size: 0.95rem;
            color: #333;
            font-weight: 500;
        }

        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-ipb:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 31, 95, 0.3);
            color: #fff;
        }

        .text-link {
            color: #0056b3;
            font-weight: 600;
        }
        
        .form-check-label {
            color: #555;
            font-weight: 500;
        }

        /* Animasi Roket */
        .rocket-icon {
            font-size: 1.5rem;
            display: inline-block;
            animation: blastOff 2s infinite ease-in-out;
        }

        @keyframes blastOff {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>

    <div class="p-2">
        <div class="mb-4">
            <span class="rocket-icon">🚀</span>
            <h3 class="fw-bold register-header-text mb-1">Buat Akun</h3>
            <p class="text-description small">Selamat datang! Buat akun untuk mulai melaporkan sarana dan prasarana kampus.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama Lengkap --}}
            <label class="mb-2 text-input-label">Full Name <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-user input-icon"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: John Doe" required autofocus autocomplete="name">
            </div>
            @error('name') <div class="text-danger small mb-3 animate__animated animate__fadeInLeft"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> @else <div class="mb-3"></div> @enderror

            {{-- Email --}}
            <label class="mb-2 text-input-label">Email Address <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-envelope input-icon"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email">
            </div>
            @error('email') <div class="text-danger small mb-3 animate__animated animate__fadeInLeft"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> @else <div class="mb-3"></div> @enderror

            {{-- Password --}}
            <label class="mb-2 text-input-label">Password <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-lock input-icon"></i>
                <input id="password" type="password" name="password" placeholder="Buat kata sandi" required autocomplete="new-password">
                <i class="fas fa-eye toggle-password" data-target="password" style="cursor: pointer; padding: 5px; color: #6c757d;"></i>
            </div>
            @error('password') 
                <div class="text-danger small mb-1 mt-1 animate__animated animate__fadeInLeft"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> 
            @enderror
            
            {{-- Helper text disembunyikan default (d-none) dan warna diperjelas --}}
            <div id="password-hint" class="mb-3 d-none animate__animated animate__fadeIn" style="font-size: 0.75rem; color: #555; font-weight: 500;">
                <i class="fas fa-info-circle me-1 text-primary"></i> Minimal 8 karakter
            </div>

            {{-- Confirm Password --}}
            <label class="mb-2 text-input-label">Confirm Password <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-3">
                <i class="fas fa-check-circle input-icon"></i>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password">
                <i class="fas fa-eye toggle-password" data-target="password_confirmation" style="cursor: pointer; padding: 5px; color: #6c757d;"></i>
            </div>

            {{-- Terms & Conditions --}}
            <div class="form-check mb-4">
                <input id="terms" type="checkbox" class="form-check-input" name="terms" required style="cursor: pointer;">
                <label for="terms" class="form-check-label small" style="cursor: pointer;">
                    Saya setuju dengan 
                    <a href="{{ route('terms') }}" class="text-link text-decoration-none">Syarat & Ketentuan</a> 
                    dan 
                    <a href="{{ route('privacy.policy') }}" class="text-link text-decoration-none">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn btn-ipb w-100 py-2 mb-3">
                Daftar Akun
            </button>

            <div class="text-center small text-description">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-link text-decoration-none">Masuk di sini</a>
            </div>
        </form>

        <script>
            // Script untuk handle toggle password secara dinamis (bisa banyak field)
            document.querySelectorAll('.toggle-password').forEach(item => {
                item.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    
                    if (input) {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        
                        // Toggle icon
                        this.classList.toggle('fa-eye');
                        this.classList.toggle('fa-eye-slash');
                        
                        // Toggle warna icon
                        this.style.color = type === 'text' ? '#00aaff' : '#6c757d';
                    }
                });
            });

            // Script Khusus untuk menampilkan Hint Password saat fokus
            const passwordInput = document.getElementById('password');
            const passwordHint = document.getElementById('password-hint');

            if(passwordInput && passwordHint) {
                // Muncul saat diklik (focus)
                passwordInput.addEventListener('focus', function() {
                    passwordHint.classList.remove('d-none');
                });
                
                // Opsional: Sembunyi lagi saat tidak diklik (blur), agar rapi
                passwordInput.addEventListener('blur', function() {
                    passwordHint.classList.add('d-none');
                });
            }
        </script>
    </div>
</x-guest-layout>