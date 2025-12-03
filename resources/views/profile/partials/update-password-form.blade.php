<section>
    <style>
        /* Definisi Ulang Style Tema IPB (Konsisten dengan form sebelah) */
        .text-navy-custom {
            color: #001f5f !important;
        }

        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%) !important;
            border: none !important;
            color: white !important;
        }
        .btn-ipb:hover {
            opacity: 0.9;
            box-shadow: 0 4px 12px rgba(0, 31, 95, 0.3);
        }

        /* Kustomisasi Input Bootstrap agar Fokusnya Biru Navy */
        .ipb-form-control:focus {
            border-color: #001f5f !important;
            box-shadow: 0 0 0 4px rgba(0, 31, 95, 0.1) !important; /* Glow Biru */
        }
        
        /* Ikon di dalam input group */
        .input-group-text i {
            color: #001f5f !important; /* Paksa warna ikon jadi Navy */
            opacity: 0.7;
        }
    </style>

    <header class="mb-4">
        {{-- Ubah text-dark jadi text-navy-custom --}}
        <h6 class="fw-bold text-navy-custom">{{ __('Perbarui Kata Sandi') }}</h6>
        <p class="small text-muted">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            {{-- Label Navy --}}
            <label class="form-label fw-bold small text-navy-custom">{{ __('Kata Sandi Saat Ini') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock"></i></span>
                {{-- Tambahkan class ipb-form-control --}}
                <input type="password" name="current_password" 
                       class="form-control ipb-form-control border-start-0 @error('current_password') is-invalid @enderror" 
                       placeholder="Masukkan kata sandi saat ini" autocomplete="current-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password" style="cursor: pointer;"></i>
                </span>
            </div>
            @error('current_password')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-navy-custom">{{ __('Kata Sandi Baru') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-key"></i></span>
                <input type="password" name="password" 
                       class="form-control ipb-form-control border-start-0 @error('password') is-invalid @enderror" 
                       placeholder="Masukkan kata sandi baru" autocomplete="new-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password" style="cursor: pointer;"></i>
                </span>
            </div>
            @error('password')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-navy-custom">{{ __('Konfirmasi Kata Sandi') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-check-circle"></i></span>
                <input type="password" name="password_confirmation" 
                       class="form-control ipb-form-control border-start-0" 
                       placeholder="Ulangi kata sandi baru" autocomplete="new-password">
                <span class="input-group-text bg-white border-start-0">
                    <i class="fas fa-eye toggle-password" style="cursor: pointer;"></i>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            {{-- Tombol Tema IPB --}}
            <button type="submit" class="btn btn-ipb px-4 text-white">
                {{ __('Perbarui Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="small text-success fw-bold mb-0">
                    <i class="fas fa-check me-1"></i> {{ __('Berhasil disimpan.') }}
                </p>
            @endif
        </div>
    </form>
    
    {{-- Script Sederhana untuk Toggle Password (Mata) --}}
    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function() {
                // Cari input terdekat dalam satu group
                const input = this.closest('.input-group').querySelector('input');
                if (input) {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                    
                    // Ubah warna ikon saat aktif
                    if(type === 'text') {
                        this.style.color = '#001f5f'; // Navy
                        this.style.opacity = '1';
                    } else {
                        this.style.color = ''; // Reset ke style CSS default
                        this.style.opacity = '0.7';
                    }
                }
            });
        });
    </script>
</section>