<x-app-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Global Styling Sesuai Tema */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .text-navy {
            color: #001f5f; /* Warna Utama IPB */
        }

        /* Card Modern */
        .card-modern {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 31, 95, 0.06);
            transition: transform 0.2s ease;
        }

        /* Tombol Gradient Khas IPB */
        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0, 31, 95, 0.2);
            transition: all 0.3s ease;
        }

        .btn-ipb:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 31, 95, 0.3);
            color: #fff;
        }

        /* Styling Tabel Custom */
        .table-custom {
            border-collapse: separate; 
            border-spacing: 0;
            width: 100%;
        }

        .table-custom thead th {
            background-color: #001f5f;
            color: white;
            border: none;
            font-weight: 500;
            padding: 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom thead th:first-child { border-top-left-radius: 12px; }
        .table-custom thead th:last-child { border-top-right-radius: 12px; }

        .table-custom tbody tr:hover {
            background-color: #f0f8ff;
        }

        .table-custom td {
            border-bottom: 1px solid #f0f0f0;
            padding: 15px;
            vertical-align: middle;
        }

        /* Custom Badge Style */
        .badge-custom {
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        .badge-warning-custom { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .badge-success-custom { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .badge-danger-custom { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .badge-secondary-custom { background-color: #e2e3e5; color: #383d41; border: 1px solid #d6d8db; }

    </style>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container py-5">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold text-navy m-0">Laporan Saya</h3>
                <p class="text-muted small mb-0 mt-1">Pantau status laporan kerusakan dan peminjaman Anda di sini.</p>
            </div>
            <div>
                <a href="{{ route('reports.create') }}" class="btn btn-ipb">
                    <i class="fas fa-plus-circle me-2"></i> Buat Laporan Baru
                </a>
            </div>
        </div>

        {{-- Tabel Laporan --}}
        <div class="card card-modern mb-5">
            <div class="card-body p-0">
                <div class="table-responsive" style="border-radius: 12px;">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Tanggal</th>
                                <th style="width: 30%;">Objek & Lokasi</th>
                                <th style="width: 15%;">Tipe</th>
                                <th class="text-center" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center text-muted fw-bold">
                                            <i class="far fa-calendar-alt me-2 text-primary"></i>
                                            {{ $report->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $report->object_name }}</div>
                                        <div class="small text-muted"><i class="fas fa-map-marker-alt me-1 text-danger small"></i> {{ $report->location }}</div>
                                    </td>
                                    <td>
                                        <span class="text-navy fw-bold" style="text-transform: capitalize;">
                                            {{ $report->report_type }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($report->status == 'pending')
                                            <span class="badge badge-custom badge-warning-custom">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                        @elseif($report->status == 'approved')
                                            <span class="badge badge-custom badge-success-custom">
                                                <i class="fas fa-check-circle me-1"></i> Diproses
                                            </span>
                                        @elseif($report->status == 'rejected')
                                            <span class="badge badge-custom badge-danger-custom">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge badge-custom badge-secondary-custom">
                                                <i class="fas fa-archive me-1"></i> Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($report->status == 'pending')
                                            
                                            {{-- Tombol Delete (Trigger SweetAlert) --}}
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                                    data-id="{{ $report->id }}">
                                                <i class="fas fa-trash-alt me-1"></i> Batalkan
                                            </button>

                                            {{-- Form Delete (Hidden) --}}
                                            <form id="delete-form-{{ $report->id }}" 
                                                  action="{{ route('reports.destroy', $report->id) }}" 
                                                  method="POST" class="d-none">
                                                @csrf @method('DELETE')
                                            </form>

                                        @else
                                            <span class="text-muted small fst-italic">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 80px; opacity: 0.5;" class="mb-3">
                                            <p class="text-muted fw-bold mb-1">Belum ada laporan</p>
                                            <p class="text-muted small">Anda belum membuat laporan apapun sejauh ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $reports->links() }}
        </div>
    </div>

    {{-- Script SweetAlert2 Konfirmasi --}}
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                title: 'Hapus Laporan?',
                text: "Aksi ini tidak bisa dibatalkan.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d93025',  // merah Google
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Hapus',
                cancelButtonText: 'Kembali',
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    title: 'fw-bold text-danger',
                },

                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>

</x-app-layout>
