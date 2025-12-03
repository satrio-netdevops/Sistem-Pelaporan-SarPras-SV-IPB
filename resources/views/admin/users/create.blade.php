<x-app-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Palette Warna (Konsisten) */
            --ipb-blue: #004a8f;
            --ipb-dark: #002a52;
            --color-red: #ef4444;
            --color-indigo: #6366f1;
            
            --bg-body: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Poppins', sans-serif !important;
            color: var(--text-dark);
        }

        /* 2. CARD STYLE */
        .modern-card {
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem; /* Lebih besar dan membulat */
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); /* Soft Shadow */
            overflow: hidden;
            background: white;
        }

        .card-header-custom {
            background: linear-gradient(90deg, #f8fafc 0%, #fff 100%);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        .header-icon {
            color: var(--ipb-blue);
            font-size: 1.8rem;
            margin-right: 1rem;
        }

        /* 3. FORM INPUT STYLE */
        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted) !important;
            margin-bottom: 0.4rem;
            display: block;
            text-transform: uppercase;
        }
        
        .input-group-text {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-right: none !important;
            color: var(--text-muted) !important;
            border-radius: 0.5rem 0 0 0.5rem !important;
            padding: 0.75rem 1rem;
        }

        .form-control {
            border: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
            border-left: none !important;
            font-size: 0.9rem;
            border-radius: 0 0.5rem 0.5rem 0 !important;
            transition: all 0.2s;
        }
        
        .form-control:focus {
            border-color: var(--ipb-blue) !important;
            box-shadow: 0 0 0 3px rgba(0, 74, 143, 0.15) !important; /* Efek fokus biru soft */
            background-color: #fff;
        }
        
        /* 4. PASSWORD TOGGLE STYLE */
        .toggle-password {
            color: var(--text-muted) !important;
            transition: color 0.2s;
        }
        
        .toggle-password:hover {
            color: var(--ipb-blue) !important;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--ipb-blue) !important;
            box-shadow: 0 0 0 3px rgba(0, 74, 143, 0.15) !important;
            background-color: #e6f0f8 !important; /* Ganti warna background icon saat focus */
            z-index: 10;
        }
        
        /* Hapus bayangan default di focus pada input-group-text agar fokus rapi */
        .input-group:focus-within .input-group-text {
            box-shadow: none !important;
        }
        
        /* 5. BUTTONS STYLE */
        .btn-custom-primary {
            background: linear-gradient(135deg, var(--ipb-blue) 0%, var(--ipb-dark) 100%);
            border: none;
            color: white !important;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px -3px rgba(0, 74, 143, 0.3);
        }
        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(0, 74, 143, 0.4);
            filter: brightness(1.1);
        }
        
        .btn-custom-light {
            background-color: #f1f5f9;
            color: var(--text-muted) !important;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s;
        }
        .btn-custom-light:hover {
            background-color: #e2e8f0;
            color: var(--text-dark) !important;
        }

    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="modern-card">
                    
                    <div class="card-header-custom">
                        <i class="fas fa-user-plus header-icon"></i>
                        <h4 class="fw-bold m-0 text-dark">Add New User</h4>
                    </div>
                    
                    <div class="card-body p-5">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           placeholder="Misal Binggie Rashel" required autofocus value="{{ old('name') }}">
                                </div>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           placeholder="user@example.com" required value="{{ old('email') }}">
                                </div>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <h6 class="text-muted small fw-bold text-uppercase mb-4 mt-2">Security Credentials</h6>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Create password" required>
                                        
                                        <span class="input-group-text bg-white toggle-password-btn" data-target="#password" style="cursor: pointer; border-left: none !important; border-radius: 0 0.5rem 0.5rem 0 !important;">
                                            <i class="fas fa-eye toggle-icon"></i>
                                        </span>
                                    </div>
                                    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                               placeholder="Repeat password" required>
                                        
                                        <span class="input-group-text bg-white toggle-password-btn" data-target="#password_confirmation" style="cursor: pointer; border-left: none !important; border-radius: 0 0.5rem 0.5rem 0 !important;">
                                            <i class="fas fa-eye toggle-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-3 pt-4">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-custom-light d-inline-flex align-items-center">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-custom-primary d-inline-flex align-items-center">
                                    <i class="fas fa-save me-2"></i> Create User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="mt-4 p-4 text-center bg-white rounded-3 small text-muted border" style="border-radius: 1.25rem !important;">
                    <i class="fas fa-info-circle text-primary me-2"></i> User akan menerima akses sistem segera setelah akun dibuat.
                </div>
                
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kita target SPAN (yang merupakan area klik yang lebih besar)
            const toggleButtons = document.querySelectorAll('.toggle-password-btn'); 
            
            toggleButtons.forEach(toggleBtn => {
                toggleBtn.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target'); // Ambil ID input target
                    const passwordInput = document.querySelector(targetId);
                    
                    // Cari icon di dalam button yang diklik
                    const icon = this.querySelector('.toggle-icon'); 
                    
                    // Toggle type attribute
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon (fa-eye <-> fa-eye-slash)
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            });
        });
    </script>
</x-app-layout>