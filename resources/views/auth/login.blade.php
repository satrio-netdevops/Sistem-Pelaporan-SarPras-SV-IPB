<x-guest-layout>
    {{-- Tambahkan Font Poppins agar terlihat modern --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Khusus untuk menyamakan tema dengan sebelah kiri */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .login-header-text {
            color: #001f5f; /* Warna Biru Gelap IPB */
        }
        
        /* FIX: Warna teks deskripsi dibuat lebih gelap agar terbaca */
        .text-description {
            color: #555555; /* Abu-abu gelap, bukan abu-abu pudar */
            font-weight: 400;
        }

        /* FIX: Warna label input dibuat lebih tegas (Navy kehitaman) */
        .text-input-label {
            color: #344767; 
            font-weight: 700 !important; /* Dipertebal */
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }

        /* Styling Input Group Modern */
        .modern-input-group {
            display: flex;
            align-items: center;
            background-color: #f8f9fa; /* Background abu sangat muda */
            border: 1px solid #ced4da; /* Border sedikit lebih gelap agar terlihat */
            border-radius: 12px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .modern-input-group:focus-within {
            border-color: #00aaff; /* Warna Cyan/Biru terang saat aktif */
            box-shadow: 0 0 0 4px rgba(0, 170, 255, 0.1);
            background-color: #fff;
        }

        .modern-input-group i {
            color: #6c757d;
            transition: color 0.3s ease;
        }

        .modern-input-group:focus-within i {
            color: #00aaff; /* Ikon berubah jadi biru saat aktif */
        }

        .modern-input-group input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            padding-left: 10px;
            font-size: 0.95rem;
            color: #333;
            font-weight: 500; /* Input teks sedikit lebih tebal */
        }

        /* Styling Tombol agar cocok dengan gradasi biru di kiri */
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
            transition: color 0.2s ease;
        }
        
        .text-link:hover {
            color: #003d80; /* Efek hover lebih gelap */
            text-decoration: underline !important;
        }
        
        /* FIX: Warna label checkbox "Ingat saya" */
        .form-check-label {
            color: #555;
            font-weight: 500;
        }
        
        .waving-hand {
            font-size: 1.5rem;
            display: inline-block;
            animation: wave 2.5s infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0% { transform: rotate(0.0deg) }
            10% { transform: rotate(14.0deg) }
            20% { transform: rotate(-8.0deg) }
            30% { transform: rotate(14.0deg) }
            40% { transform: rotate(-4.0deg) }
            50% { transform: rotate(10.0deg) }
            60% { transform: rotate(0.0deg) }
            100% { transform: rotate(0.0deg) }
        }
    </style>

    <div class="p-2">
        <div class="mb-4">
            <span class="waving-hand">👋</span>
            <h3 class="fw-bold login-header-text mb-1">Masuk ke Ko'SaPrI SV IPB</h3>
            {{-- Mengganti text-muted dengan text-description custom --}}
            <p class="text-description small">Selamat datang! Silakan masuk untuk melanjutkan.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Input Username --}}
            {{-- Mengganti class inline style dengan class CSS khusus --}}
            <label class="mb-2 text-input-label">Username</label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-user-circle fa-lg"></i>
                <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: satrio" required autofocus autocomplete="username">
            </div>
            @error('username') 
                <div class="text-danger small mb-3 animate__animated animate__fadeInLeft">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div> 
            @else
                <div class="mb-3"></div>
            @enderror

            {{-- Input Password --}}
            <label class="mb-2 mt-2 text-input-label">Password</label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-lock fa-lg"></i>
                <input id="password" type="password" name="password" placeholder="Masukan kata sandi" required>
                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer; padding: 5px;"></i>
            </div>
            @error('password') 
                <div class="text-danger small mb-3 animate__animated animate__fadeInLeft">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div> 
            @enderror
            
            <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember" style="cursor: pointer;">
                    {{-- Hapus text-muted di sini agar lebih terlihat --}}
                    <label for="remember_me" class="form-check-label small" style="cursor: pointer;">Ingat saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="small text-link text-decoration-none" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-ipb w-100 py-2">
                Login Masuk
            </button>
            
            {{-- MODIFIKASI: Link Register untuk User Baru --}}
            {{-- Menggunakan Route::has() untuk memastikan fitur register aktif --}}
            @if (Route::has('register'))
                <div class="text-center mt-4">
                    <p class="small text-description mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-link text-decoration-none ms-1 fw-bold">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            @endif
            {{-- AKHIR MODIFIKASI --}}

        </form>

        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon class
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
                
                // Ganti warna icon agar user tau sedang aktif
                if(type === 'text') {
                    this.style.color = '#00aaff';
                } else {
                    this.style.color = '#6c757d';
                }
            });
        </script>
    </div>
</x-guest-layout>