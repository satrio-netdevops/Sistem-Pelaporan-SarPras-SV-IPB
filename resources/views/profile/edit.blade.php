<x-app-layout>
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Khusus Halaman Profil */
        body { font-family: 'Poppins', sans-serif; }
        
        .text-navy { color: #001f5f; }

        /* Card Style Sesuai Tema */
        .card-modern {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 31, 95, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }
        
        .card-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 31, 95, 0.1);
        }

        .card-header-profile {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* Table Styling (Konsisten dengan Dashboard) */
        .table-custom thead th {
            background-color: #001f5f;
            color: white;
            border: none;
            font-weight: 500;
            padding: 12px 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table-custom thead th:first-child { border-top-left-radius: 10px; }
        .table-custom thead th:last-child { border-top-right-radius: 10px; }
        
        .table-custom tbody tr:hover { background-color: #f8f9fa; }

        /* Button & Form Overrides */
        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            border: none;
            color: white;
        }
        .btn-ipb:hover { color: white; opacity: 0.9; }
    </style>

    <div class="container py-5">
        {{-- Header Section --}}
        <div class="mb-5">
            <h3 class="fw-bold text-navy m-0">Profil Saya</h3>
            <p class="text-muted small mb-0 mt-1">Kelola informasi akun, keamanan, dan riwayat aktivitas Anda.</p>
        </div>

        <div class="row g-4">
            
            {{-- Kolom Kiri: Info Profil --}}
            <div class="col-lg-6">
                <div class="card card-modern h-100">
                    <div class="card-header-profile d-flex align-items-center">
                        <div class="icon-circle bg-success bg-opacity-10 me-3">
                            <i class="fas fa-user-edit text-success"></i>
                        </div>
                        <h6 class="fw-bold m-0 text-dark">Informasi Profil</h6>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Password --}}
            <div class="col-lg-6">
                <div class="card card-modern h-100">
                    <div class="card-header-profile d-flex align-items-center">
                        <div class="icon-circle bg-warning bg-opacity-10 me-3">
                            <i class="fas fa-key text-warning"></i>
                        </div>
                        <h6 class="fw-bold m-0 text-dark">Keamanan & Kata Sandi</h6>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Kolom Penuh: Log Aktivitas --}}
            <div class="col-12">
                <div class="card card-modern">
                    <div class="card-header-profile d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-primary bg-opacity-10 me-3">
                                <i class="fas fa-history text-primary"></i>
                            </div>
                            <h6 class="fw-bold m-0 text-dark">Riwayat Aktivitas Terakhir</h6>
                        </div>
                        <span class="badge bg-light text-secondary border">Terbaru</span>
                    </div>
                    <div class="card-body p-0"> 
                        <div class="table-responsive" style="border-radius: 0 0 16px 16px;">
                            <table class="table table-custom align-middle mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 7%;">#</th>
                                        <th class="text-uppercase" style="width: 20%;">Aksi</th>
                                        <th class="text-uppercase" style="width: 48%;">Detail</th>
                                        <th class="text-uppercase" style="width: 25%;">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                            <td class="fw-bold text-navy">{{ $log->action }}</td>
                                            <td class="text-muted small">{{ Str::limit($log->details, 80) }}</td>
                                            <td class="text-muted small fw-bold">
                                                <i class="far fa-clock me-1 text-primary"></i>
                                                {{ $log->created_at->format('d M Y, H:i') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="fas fa-info-circle me-2"></i> Belum ada aktivitas yang tercatat.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Penuh: Hapus Akun (Danger Zone) --}}
            <div class="col-12">
                <div class="card card-modern border-start border-danger border-4">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h6 class="fw-bold text-danger mb-1">
                                <i class="fas fa-exclamation-triangle me-2"></i>Zona Bahaya
                            </h6>
                            <p class="text-muted small m-0">
                                Menghapus akun bersifat permanen. Semua data Anda akan hilang dan tidak dapat dikembalikan.
                            </p>
                        </div>
                        
                        {{-- Tombol Pemicu Modal --}}
                        <button type="button" class="btn btn-outline-danger fw-bold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                            <i class="fas fa-trash-alt me-2"></i>Hapus Akun Saya
                        </button>
                    </div>
                    {{-- Kita sembunyikan partial asli dan gunakan tombol kustom di atas untuk memicu modal --}}
                    <div class="d-none">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Konfirmasi Hapus Akun (Styled) --}}
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white border-0" style="border-radius: 16px 16px 0 0;">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-user-times me-2"></i> Konfirmasi Penghapusan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <p class="text-muted mb-3">
                            Apakah Anda yakin ingin menghapus akun ini? Tindakan ini <strong>tidak dapat dibatalkan</strong>. Silakan unduh data penting sebelum melanjutkan.
                        </p>

                        <div class="alert alert-warning small d-flex align-items-center border-0 bg-warning bg-opacity-10 text-warning-emphasis">
                            <i class="fas fa-lock me-2"></i>
                            <span>Demi keamanan, silakan masukkan kata sandi Anda.</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan kata sandi Anda" required>
                            </div>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light p-3" style="border-radius: 0 0 16px 16px;">
                        <button type="button" class="btn btn-light fw-bold text-muted" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            Ya, Hapus Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>