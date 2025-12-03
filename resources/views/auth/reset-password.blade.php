<x-guest-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Khusus Tema IPB (Konsisten) */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .header-text {
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

        .modern-input-group.readonly {
            background-color: #e9ecef; /* Background lebih gelap untuk readonly */
            border-color: #dee2e6;
        }

        .modern-input-group i.input-icon {
            color: #6c757d;
            transition: color 0.3s ease;
            width: 20px;
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
            transition: color 0.2s;
        }
        .text-link:hover {
            color: #001f5f;
        }

        /* Animasi Kunci Berputar Halus */
        .key-icon {
            font-size: 2.5rem;
            display: inline-block;
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }
    </style>

    <div class="p-2">
        <div class="mb-4 text-center">
            <span class="key-icon">
                <i class="fas fa-key"></i>
            </span>
            <h3 class="fw-bold header-text mb-2">Atur Ulang Kata Sandi</h3>
            <p class="text-description small">
                Silakan buat kata sandi baru yang kuat dan aman untuk akun Anda.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email Address (Readonly) --}}
            <label class="mb-2 text-input-label">Alamat Email</label>
            <div class="modern-input-group readonly mb-3">
                <i class="fas fa-envelope input-icon"></i>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly style="opacity: 0.7; cursor: not-allowed; color: #495057;">
            </div>
            @error('email') 
                <div class="text-danger small mb-2 mt-n2 animate__animated animate__fadeInLeft">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div> 
            @enderror

            {{-- New Password --}}
            <label class="mb-2 text-input-label">Kata Sandi Baru <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-lock input-icon"></i>
                <input id="password" type="password" name="password" placeholder="Masukkan kata sandi baru" required autocomplete="new-password" autofocus>
                <i class="fas fa-eye toggle-password" data-target="password" style="cursor: pointer; padding: 5px; color: #6c757d;"></i>
            </div>
            @error('password') 
                <div class="text-danger small mb-1 mt-1 animate__animated animate__fadeInLeft">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div> 
            @enderror
            <div id="password-hint" class="text-muted mb-3 d-none animate__animated animate__fadeIn" style="font-size: 0.75rem;">
                <i class="fas fa-info-circle me-1 text-primary"></i> Minimal 8 karakter
            </div>

            {{-- Confirm Password --}}
            <label class="mb-2 text-input-label mt-2">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-4">
                <i class="fas fa-check-circle input-icon"></i>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" required autocomplete="new-password">
                <i class="fas fa-eye toggle-password" data-target="password_confirmation" style="cursor: pointer; padding: 5px; color: #6c757d;"></i>
            </div>

            <button type="submit" class="btn btn-ipb w-100 py-2">
                Simpan Kata Sandi Baru
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="small text-link text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Login
                </a>
            </div>
        </form>

        <script>
            // Script untuk handle toggle password (mendukung banyak field)
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

            // Show hint when typing password
            const passwordInput = document.getElementById('password');
            const passwordHint = document.getElementById('password-hint');
            if(passwordInput && passwordHint) {
                passwordInput.addEventListener('focus', function() {
                    passwordHint.classList.remove('d-none');
                });
            }
        </script>
    </div>
</x-guest-layout>