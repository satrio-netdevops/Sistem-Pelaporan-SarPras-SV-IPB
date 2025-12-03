<x-guest-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Khusus Tema IPB */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .header-text {
            color: #001f5f; /* Warna Biru Gelap IPB */
        }
        
        .text-description {
            color: #555555;
            font-weight: 400;
            line-height: 1.5;
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

        /* Animasi Perisai */
        .shield-icon {
            font-size: 2.5rem;
            display: inline-block;
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse-shield 3s infinite;
        }

        @keyframes pulse-shield {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <div class="p-2">
        <div class="mb-4 text-center">
            <span class="shield-icon mb-2">
                <i class="fas fa-shield-alt"></i>
            </span>
            <h3 class="fw-bold header-text mb-2">Area Aman</h3>
            <p class="text-description small">
                Halaman ini dilindungi. Mohon konfirmasi kata sandi Anda sebelum melanjutkan.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <label class="mb-2 text-input-label">Password</label>
            <div class="modern-input-group mb-1">
                <i class="fas fa-lock input-icon"></i>
                <input id="password" type="password" name="password" placeholder="Masukkan kata sandi Anda" required autocomplete="current-password" autofocus>
                <i class="fas fa-eye toggle-password" style="cursor: pointer; padding: 5px; color: #6c757d;"></i>
            </div>
            
            @error('password') 
                <div class="text-danger small mb-2 mt-1 animate__animated animate__fadeInLeft">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div> 
            @enderror

            {{-- Hint teks hanya muncul jika user mengetik --}}
            <div id="password-hint" class="text-muted mb-4 mt-1 d-none animate__animated animate__fadeIn" style="font-size: 0.75rem;">
                <i class="fas fa-info-circle me-1 text-primary"></i> Pastikan password yang dimasukkan benar.
            </div>

            <button type="submit" class="btn btn-ipb w-100 mt-2">
                Konfirmasi
            </button>
            
            <div class="text-center mt-3">
                 <a href="{{ route('dashboard') }}" class="small text-decoration-none text-muted fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>

        <script>
            // Toggle Password Visibility
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');
            const passwordHint = document.querySelector('#password-hint');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function (e) {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                    
                    if(type === 'text') {
                        this.style.color = '#00aaff';
                    } else {
                        this.style.color = '#6c757d';
                    }
                });

                // Show hint on focus
                password.addEventListener('focus', function() {
                    if(passwordHint) passwordHint.classList.remove('d-none');
                });
            }
        </script>
    </div>
</x-guest-layout>