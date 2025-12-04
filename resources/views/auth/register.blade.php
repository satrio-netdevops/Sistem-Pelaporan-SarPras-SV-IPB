<x-guest-layout>
    {{-- Memastikan Font Poppins dan Ikon Font Awesome Terload --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* =================================================== */
        /* === 1. TATA LETAK & TEMA IPB NAVY (Lokal) === */
        /* =================================================== */
        body { font-family: 'Poppins', sans-serif; }
        .register-header-text { color: #001f5f; } /* Warna Biru Gelap IPB */
        
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

        /* --- Styling Input Group Modern --- */
        .modern-input-group {
            display: flex; 
            align-items: center; 
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 12px;
            padding: 0.5rem 1rem; /* Padding disamakan dengan login */
            position: relative; 
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .modern-input-group:focus-within {
            border-color: #00aaff;
            box-shadow: 0 0 0 4px rgba(0, 170, 255, 0.1);
            background-color: #fff;
        }

        /* --- PERBAIKAN: WARNA ICON KIRI (User, Email, Lock) --- */
        /* Selector ini melawan SCSS global yang memberi warna hijau */
        .modern-input-group .input-icon-left {
            color: #6c757d !important; /* Warna Pasif */
            width: 24px;
            margin-right: 10px; /* Jarak dipisahkan */
            flex-shrink: 0;
            text-align: center;
            transition: color 0.3s ease;
        }
        
        .modern-input-group:focus-within .input-icon-left { 
            color: #00aaff !important; /* Warna Aktif (Disinkronkan dengan login) */
        }
        
        /* Input Field */
        .modern-input-group input {
            border: none;
            background: transparent;
            outline: none;
            flex: 1; 
            width: 100%; 
            min-width: 0; 
            font-size: 0.95rem;
            color: #333;
            font-weight: 500;
            padding: 0;
        }

        /* --- TOMBOL MATA (KANAN) --- */
        .ipb-toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
            margin-left: 5px;
            flex-shrink: 0;
            outline: none;
        }

        /* Target ikon mata yang pasif */
        .ipb-toggle-btn i {
            /* Warna Pasif: Abu-abu Gelap (lebih kontras dari #6c757d) */
            color: #343a40 !important; 
            transition: color 0.2s;
        }

        .ipb-toggle-btn:hover i { 
            color: #001f5f !important; /* Warna Hover */
        }

        /* --- Styling Tombol dan Link --- */
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
            text-decoration: none; 
            transition: color 0.2s ease;
        }
        .text-link:hover {
            color: #003d80; 
            text-decoration: underline !important;
        }
        .rocket-icon { font-size: 1.5rem; display: inline-block; animation: blastOff 2s infinite ease-in-out; }
        @keyframes blastOff { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
    </style>

    ---

    {{-- =================================================== --}}
    {{-- === 2. FORMULIR HTML (Konten tidak diubah) === --}}
    {{-- =================================================== --}}
    <div class="p-2">
        <div class="mb-4">
            <span class="rocket-icon">🚀</span>
            <h3 class="fw-bold register-header-text mb-1">Buat Akun</h3>
            <p class="text-description small" style="color:#555">Selamat datang! Buat akun untuk mulai melaporkan sarana dan prasarana kampus.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama Lengkap --}}
            <label class="mb-2 text-input-label">Full Name <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-user input-icon-left"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: John Doe" required autofocus autocomplete="name">
            </div>
            @error('name') <div class="text-danger small mb-3"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> @else <div class="mb-3"></div> @enderror

            {{-- Email --}}
            <label class="mb-2 text-input-label">Email Address <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-envelope input-icon-left"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email">
            </div>
            @error('email') <div class="text-danger small mb-3"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> @else <div class="mb-3"></div> @enderror

            {{-- Password --}}
            <label class="mb-2 text-input-label">Password <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-lock input-icon-left"></i>
                
                <input id="password" type="password" name="password" placeholder="Buat kata sandi" required autocomplete="new-password">
                
                <button type="button" class="ipb-toggle-btn" onclick="togglePasswordVisibility('password', this)">
                    <i class="fas fa-eye"></i> 
                </button>
            </div>
            @error('password') <div class="text-danger small mb-1 mt-1"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div> @enderror
            
            <div id="password-hint" class="mb-3 d-none" style="font-size: 0.75rem; color: #555; font-weight: 500;">
                <i class="fas fa-info-circle me-1 text-primary"></i> Minimal 8 karakter
            </div>

            {{-- Confirm Password --}}
            <label class="mb-2 text-input-label">Confirm Password <span class="text-danger">*</span></label>
            <div class="modern-input-group mb-3">
                <i class="fas fa-check-circle input-icon-left"></i>
                
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password">
                
                <button type="button" class="ipb-toggle-btn" onclick="togglePasswordVisibility('password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            {{-- Terms --}}
            <div class="form-check mb-4">
                <input id="terms" type="checkbox" class="form-check-input" name="terms" required style="cursor: pointer;">
                <label for="terms" class="form-check-label small" style="cursor: pointer; color: #555;">
                    Saya setuju dengan 
                    <a href="{{ route('terms') }}" class="text-link">Syarat & Ketentuan</a> 
                    dan 
                    <a href="{{ route('privacy.policy') }}" class="text-link">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn btn-ipb w-100 py-2 mb-3">Daftar Akun</button>

            <div class="text-center small" style="color:#555;">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-link">Masuk di sini</a>
            </div>
        </form>

    ---

        {{-- =================================================== --}}
        {{-- === 3. JAVASCRIPT LOKAL (Warna Disinkronkan) === --}}
        {{-- =================================================== --}}
        <script>
            // Variabel warna disinkronkan dengan CSS lokal dan Login
            const PASSIVE_COLOR = '#343a40'; // Abu-abu Gelap (Sama dengan .ipb-toggle-btn i)
            const ACTIVE_COLOR = '#00aaff'; // Biru terang (Sama dengan fokus login)

            function togglePasswordVisibility(inputId, btnElement) {
                const input = document.getElementById(inputId);
                const icon = btnElement.querySelector('i');
                
                if (!input || !icon) return; 

                // Atur warna default ikon saat pertama kali di klik (jika belum diatur)
                if (btnElement.style.color === "") {
                    btnElement.style.color = PASSIVE_COLOR;
                }

                if (input.type === "password") {
                    input.type = "text";
                    // Ganti icon
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    // Set warna aktif (Biru)
                    btnElement.style.color = ACTIVE_COLOR; 
                } else {
                    input.type = "password";
                    // Ganti icon
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    // Set warna pasif (Abu-abu gelap)
                    btnElement.style.color = PASSIVE_COLOR; 
                }
            }

            // Logic Hint Password
            document.addEventListener('DOMContentLoaded', function () {
                const passwordInput = document.getElementById('password');
                const passwordHint = document.getElementById('password-hint');

                if(passwordInput && passwordHint) {
                    passwordInput.addEventListener('focus', () => passwordHint.classList.remove('d-none'));
                    passwordInput.addEventListener('blur', () => {
                        // Delay agar klik pada hint tidak langsung hilang
                        setTimeout(() => passwordHint.classList.add('d-none'), 200);
                    });
                }
            });
        </script>
    </div>
</x-guest-layout>