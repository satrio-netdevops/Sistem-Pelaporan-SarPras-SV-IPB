<x-app-layout>
    <style>
        /* 1. IMPORT FONT POPPINS */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --ipb-blue: #004a8f;
            --ipb-dark: #003366;
            --ipb-magenta: #9d174d;
            --color-blue: #2563eb;
            --color-green: #10b981;
            --color-red: #ef4444;
            --color-orange: #f59e0b;
        }

        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif !important;
        }

        .bg-magenta { background-color: var(--ipb-magenta) !important; }
        .text-magenta { color: var(--ipb-magenta) !important; }
        .border-magenta { border-color: var(--ipb-magenta) !important; }
        .btn-action-magenta { background-color: #fce7f3; color: var(--ipb-magenta); }
        .btn-action-magenta:hover { background-color: var(--ipb-magenta); color: white; }

        .btn-magenta {
            background-color: var(--ipb-magenta);
            color: white;
            border: none;
            transition: all 0.3s;
        }
        .btn-magenta:hover {
            background-color: #831843; /* Magenta lebih gelap saat hover */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(157, 23, 77, 0.3);
        }
        /* 2. HERO HEADER */
        .page-hero {
            background: linear-gradient(135deg, #001f3f 0%, #004a8f 100%);
            color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            filter: blur(50px);
        }

        /* 3. TOOLBAR (SEARCH & FILTER) */
        .toolbar-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .search-box {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .search-input:focus {
            border-color: var(--color-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .filter-select {
            padding: 0.6rem 2rem 0.6rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #475569;
            background-color: white;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }

        .filter-select:focus {
            border-color: var(--color-blue);
            outline: none;
        }

        /* 4. TABLE STYLING */
        .table-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .custom-table thead th {
            background-color: #03305dff;
            color: #ffffffff;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .custom-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* 5. BADGES & BUTTONS */
        .badge-soft {
            padding: 0.5em 0.85em;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .badge-soft-warning { background-color: #fffbeb; color: #d97706; border: 1px solid #fcd34d; }
        .badge-soft-primary { background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        .badge-soft-success { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .badge-soft-danger  { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        .btn-action {
            width: 32px; height: 32px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 0.5rem; transition: all 0.2s; border: none;
        }
        .btn-action:hover { transform: translateY(-2px); }
        
        .btn-action-primary { background-color: #eff6ff; color: #2563eb; }
        .btn-action-primary:hover { background-color: #2563eb; color: white; }
        
        .btn-action-success { background-color: #ecfdf5; color: #059669; }
        .btn-action-success:hover { background-color: #059669; color: white; }

        .btn-action-danger { background-color: #fef2f2; color: #dc2626; }
        .btn-action-danger:hover { background-color: #dc2626; color: white; }

        /* SweetAlert Customization Override */
        .swal2-popup {
            font-family: 'Poppins', sans-serif !important;
            border-radius: 1rem !important;
        }

        /* 6. FIX LAYOUT SHIFT (GESER) SAAT POPUP MUNCUL */
        /* Memaksa scrollbar tetap muncul agar layout tidak 'melompat' ke kanan */
        body.swal2-shown {
            overflow-y: scroll !important; 
            padding-right: 0 !important;
        }
    </style>

    <!-- LOAD SWEETALERT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container py-5">
        
        <div class="page-hero">
            <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center gap-3 w-100">
                
                <div class="d-flex flex-column flex-md-row align-items-center position-relative z-1 text-center text-md-start">
                    
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 backdrop-blur mb-2 mb-md-0 me-md-4">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                    
                    <div>
                        <h3 class="fw-bold m-0">Daftar Laporan Masuk</h3>
                        <p class="m-0 opacity-75 small">Kelola dan verifikasi semua laporan civitas akademika.</p>
                    </div>
                </div>
                
                <div class="d-flex gap-2 position-relative z-1">
                    <a href="{{ route('admin.reports.export.pdf') }}" target="_blank" class="btn btn-light btn-sm fw-bold text-danger d-flex align-items-center shadow-sm">
                        <i class="fas fa-file-pdf me-2"></i> PDF
                    </a>
                    <a href="{{ route('admin.reports.export.excel') }}" target="_blank" class="btn btn-light btn-sm fw-bold text-success d-flex align-items-center shadow-sm">
                        <i class="fas fa-file-excel me-2"></i> Excel
                    </a>
                </div>
            </div>
        </div>

        <div class="toolbar-card">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Cari nama pelapor, aset, atau lokasi...">
            </div>

            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-filter text-muted"></i>
                <select id="statusFilter" class="filter-select">
                    <option value="all">Semua Status</option>
                    <option value="pending">Perlu Cek</option>
                    <option value="approved">Diproses</option>
                    <option value="completed">Selesai</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0" id="reportsTable">
                    <thead>
                        <tr>
                            <th>Waktu & Pelapor</th>
                            <th>Detail Aset</th>
                            <th>Bukti</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($reports as $report)
                            <tr class="report-row" 
                                data-status="{{ $report->status }}" 
                                data-search="{{ strtolower($report->user->name . ' ' . $report->object_name . ' ' . $report->location) }}">
                                
                                <td>
                                    <div class="fw-bold text-dark">{{ $report->user->name }}</div>
                                    <div class="text-muted small">
                                        <i class="far fa-clock me-1"></i> {{ $report->created_at->format('d M Y, H:i') }}
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="fw-bold" style="color: #0d3aa3ff;">{{ $report->object_name }}</div>
                                    <div class="small text-muted">{{ $report->location }}</div>
                                    <span class="badge bg-light text-secondary border mt-1 fw-normal">{{ $report->asset_type }}</span>
                                </td>
                                
                                <td>
                                    @if($report->photo_path)
                                        <button class="btn btn-sm btn-outline-info rounded-pill px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal" 
                                                data-image="{{ asset('storage/' . $report->photo_path) }}">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="text-muted small text-wrap" style="max-width: 200px;">
                                        {{ Str::limit($report->description, 50) }}
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    @if($report->status == 'pending')
                                        <span class="badge badge-soft badge-soft-warning"><i class="fas fa-clock"></i> Perlu Cek</span>
                                    @elseif($report->status == 'approved')
                                        <span class="badge badge-soft badge-soft-primary"><i class="fas fa-spinner fa-spin"></i> Diproses</span>
                                    @elseif($report->status == 'completed')
                                        <span class="badge badge-soft badge-soft-success"><i class="fas fa-check-circle"></i> Selesai</span>
                                    @elseif($report->status == 'rejected')
                                        <span class="badge badge-soft badge-soft-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        @if($report->status == 'pending')
                                            <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn-action btn-action-primary" title="Proses"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn-action btn-action-danger" title="Tolak"><i class="fas fa-times"></i></button>
                                            </form>
                                        @elseif($report->status == 'approved')
                                            <button type="button" 
                                                    class="btn-action btn-action-magenta btn-complete-trigger" 
                                                    title="Selesai & Verifikasi"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#completionModal"
                                                    data-url="{{ route('admin.reports.complete', $report->id) }}"
                                                    data-object="{{ $report->object_name }}">
                                                <i class="fas fa-check-double"></i>
                                            </button>
                                        @endif
                                        
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="form-delete">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action text-secondary bg-light" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="noDataRow">
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x text-muted opacity-50 mb-3"></i>
                                        <h6 class="text-muted">Belum ada data laporan.</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        <tr id="noResultRow" style="display: none;">
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-search fa-3x text-muted opacity-50 mb-3"></i>
                                    <h6 class="text-muted fw-bold">Data tidak ditemukan</h6>
                                    <p class="text-muted small">Coba kata kunci lain atau ubah filter status.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            @if($reports->hasPages())
                <div class="p-3 border-top bg-light d-flex justify-content-end">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-body text-center p-4 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    <img src="" id="modalImageInfo" class="img-fluid rounded-3 shadow-sm" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="completionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header text-white bg-magenta rounded-top-4">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-clipboard-check me-2"></i>Verifikasi Penyelesaian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <form id="completionForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="modal-body p-4">
                        <div class="alert alert-light border-start border-magenta border-4 mb-3">
                            <small class="text-muted">Anda akan menyelesaikan laporan untuk:</small><br>
                            <strong class="text-magenta fs-5" id="modalObjectName">-</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Foto Bukti Perbaikan <span class="text-danger">*</span></label>
                            <input type="file" name="resolution_image" class="form-control" accept="image/*" required>
                            <div class="form-text small">Upload foto kondisi aset setelah diperbaiki.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Catatan Pengerjaan <span class="text-danger">*</span></label>
                            <textarea name="resolution_note" class="form-control" rows="3" placeholder="Contoh: AC sudah dicuci dan freon diisi ulang..." required></textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light text-muted fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-magenta fw-bold px-4">
                            <i class="fas fa-save me-2"></i>Simpan & Selesai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            
            // 1. Logic Modal Gambar
            var imageModal = document.getElementById('imageModal');
            if(imageModal){
                imageModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var imageUrl = button.getAttribute('data-image');
                    document.getElementById('modalImageInfo').src = imageUrl;
                });
            }

            // 2. Logic Filtering & Searching
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.report-row');
            const noResultRow = document.getElementById('noResultRow');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    const searchText = row.getAttribute('data-search');
                    const matchesStatus = (filterValue === 'all') || (status === filterValue);
                    const matchesSearch = searchText.includes(searchTerm);

                    if (matchesStatus && matchesSearch) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    if(noResultRow) noResultRow.style.display = '';
                } else {
                    if(noResultRow) noResultRow.style.display = 'none';
                }
            }

            if(searchInput) searchInput.addEventListener('input', filterTable);
            if(statusFilter) statusFilter.addEventListener('change', filterTable);

            // 3. LOGIC SWEETALERT 2 UNTUK DELETE
            const deleteForms = document.querySelectorAll('.form-delete');
            
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    // Mencegah submit default
                    event.preventDefault();

                    const currentForm = this;

                    Swal.fire({
                        title: 'Hapus Laporan?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        
                        // FIX PERGESERAN LAYOUT
                        // Kita matikan padding otomatis SweetAlert
                        // TAPI kita paksa scrollbar tetap ada lewat CSS (lihat style di atas)
                        scrollbarPadding: false,
                        heightAuto: false,

                        customClass: {
                            popup: 'rounded-4 shadow-lg',
                            confirmButton: 'btn btn-danger px-4 rounded-3',
                            cancelButton: 'btn btn-secondary px-4 rounded-3 ms-2'
                        },
                        buttonsStyling: false 
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Memproses...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            // Submit form manual
                            currentForm.submit();
                        }
                    });
                });
            });
        });

        // 4. Logic Modal Penyelesaian (Completion Modal)
        var completionModal = document.getElementById('completionModal');
        if (completionModal) {
            completionModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var actionUrl = button.getAttribute('data-url');
                var objectName = button.getAttribute('data-object');
                
                var form = document.getElementById('completionForm');
                var objectNameText = document.getElementById('modalObjectName');
                
                if(form) form.action = actionUrl;
                if(objectNameText) objectNameText.textContent = objectName;
            });
        }
    </script>
</x-app-layout>