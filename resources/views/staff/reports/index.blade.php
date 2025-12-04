<x-app-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ipb-blue: #004a8f;
            --ipb-magenta: #9d174d; /* WARNA KHAS SV IPB (Magenta Tua) */
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .bg-magenta { background-color: var(--ipb-magenta) !important; }
        .text-magenta { color: var(--ipb-magenta) !important; }
        .border-magenta { border-color: var(--ipb-magenta) !important; }
        
        .badge-magenta-custom { 
            background-color: #fce7f3; 
            color: var(--ipb-magenta); 
            border: 1px solid #fbcfe8; 
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

        /* Tombol Lihat Hasil (Baru) */
        .btn-evidence {
            background-color: white;
            border: 1px solid var(--ipb-magenta);
            color: var(--ipb-magenta);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-evidence:hover {
            background-color: var(--ipb-magenta);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(157, 23, 77, 0.3);
        }

    </style>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container py-5">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold text-navy m-0">Laporan Saya</h3>
                <p class="text-muted small mb-0 mt-1">Pantau status laporan kerusakan dan saran Anda di sini.</p>
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
                                <th style="width: 25%;">Objek & Lokasi</th>
                                <th style="width: 15%;">Tipe</th>
                                <th class="text-center" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 15%;">Hasil Pengerjaan</th> <th class="text-center" style="width: 15%;">Aksi</th>
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
                                    
                                    {{-- Kolom Hasil Pengerjaan (BARU) --}}
                                    <td class="text-center">
                                        @if($report->status == 'completed')
                                            <button type="button" 
                                                    class="btn-evidence"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#evidenceModal"
                                                    data-object="{{ $report->object_name }}"
                                                    data-note="{{ $report->resolution_note ?? 'Tidak ada catatan.' }}"
                                                    data-date="{{ $report->resolved_at ? \Carbon\Carbon::parse($report->resolved_at)->format('d M Y, H:i') : '-' }}"
                                                    data-image="{{ $report->resolution_image ? asset('storage/' . $report->resolution_image) : '' }}">
                                                <i class="fas fa-eye me-1"></i> Lihat Hasil
                                            </button>
                                        @elseif($report->status == 'rejected')
                                            <span class="text-muted small fst-italic">-</span>
                                        @else
                                            <span class="text-muted small fst-italic">Belum tersedia</span>
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
                                            <span class="text-muted small fst-italic">Terkunci</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
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

   <div class="modal fade" id="evidenceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header text-white bg-magenta" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-clipboard-check me-2"></i>Laporan Selesai
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h6 class="text-muted text-uppercase small fw-bold" style="letter-spacing: 1px;">Objek Laporan</h6>
                        <h4 class="text-navy fw-bold" id="evidenceObjectName">-</h4>
                        
                        <span class="badge badge-magenta-custom px-3 py-2 mt-2">
                            <i class="far fa-calendar-check me-1"></i> Diselesaikan: <span id="evidenceDate">-</span>
                        </span>
                    </div>

                    <hr style="border-color: #f0f0f0;">

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Foto Bukti Perbaikan</label>
                        <div class="bg-light rounded-3 p-3 text-center border border-dashed">
                            <img src="" id="evidenceImage" class="img-fluid rounded-3 shadow-sm" style="max-height: 300px; display: none;">
                            <p id="noEvidenceImage" class="text-muted small my-3" style="display: none;">
                                <i class="fas fa-image-slash fa-2x mb-2 text-secondary"></i><br>Tidak ada foto bukti dilampirkan.
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="form-label fw-bold small text-muted text-uppercase">Catatan Petugas</label>
                        <div class="alert alert-light border-start border-magenta border-4 text-dark mb-0 shadow-sm">
                            <div class="d-flex">
                                <i class="fas fa-quote-left text-magenta opacity-50 me-3 fs-4"></i>
                                <span id="evidenceNote" class="fst-italic">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 px-4 pb-4 justify-content-center">
                    <button type="button" class="btn btn-light text-muted fw-bold px-4 rounded-pill border" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. Logic Modal Evidence (Lihat Hasil)
            var evidenceModal = document.getElementById('evidenceModal');
            if (evidenceModal) {
                evidenceModal.addEventListener('show.bs.modal', function (event) {
                    // Tombol yang diklik
                    var button = event.relatedTarget;
                    
                    // Ambil data dari atribut data-*
                    var objectName = button.getAttribute('data-object');
                    var note = button.getAttribute('data-note');
                    var date = button.getAttribute('data-date');
                    var imageUrl = button.getAttribute('data-image');
                    
                    // Update UI Modal
                    document.getElementById('evidenceObjectName').textContent = objectName;
                    document.getElementById('evidenceNote').textContent = note;
                    document.getElementById('evidenceDate').textContent = date;
                    
                    var imgElement = document.getElementById('evidenceImage');
                    var noImgElement = document.getElementById('noEvidenceImage');
                    
                    if (imageUrl) {
                        imgElement.src = imageUrl;
                        imgElement.style.display = 'block';
                        noImgElement.style.display = 'none';
                    } else {
                        imgElement.style.display = 'none';
                        noImgElement.style.display = 'block';
                    }
                });
            }

            // 2. Logic SweetAlert2 Delete
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
        });
    </script>

</x-app-layout>