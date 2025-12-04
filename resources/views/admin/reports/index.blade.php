<x-app-layout>
    <style>
        /* 1. IMPORT FONT POPPINS */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --ipb-blue: #004a8f;
            --ipb-dark: #003366;
            --color-blue: #2563eb;
            --color-green: #10b981;
            --color-red: #ef4444;
            --color-orange: #f59e0b;
        }

        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif !important;
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

        .btn-action-delete { background-color: #f1f5f9; color: #64748b; }
        .btn-action-delete:hover { background-color: #ef4444; color: white; }

        /* 6. SWEET ALERT CUSTOM MODAL */
        .custom-alert-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes slideDown {
            from { 
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .custom-alert-box {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideDown 0.3s ease;
            text-align: center;
        }

        .alert-icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .alert-icon {
            font-size: 2.5rem;
            color: #dc2626;
        }

        .alert-icon-wrapper::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #fee2e2;
            opacity: 0.3;
            animation: ripple 2s infinite;
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        .alert-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-family: 'Poppins', sans-serif;
        }

        .alert-message {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .alert-buttons {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
        }

        .alert-btn {
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .alert-btn:active {
            transform: translateY(0);
        }

        .alert-btn-cancel {
            background-color: #f1f5f9;
            color: #475569;
        }

        .alert-btn-cancel:hover {
            background-color: #e2e8f0;
        }

        .alert-btn-confirm {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .alert-btn-confirm:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
        }

    </style>

    <div class="container py-5">
        
        <div class="page-hero">
            <div class="d-flex align-items-center position-relative z-1">
                <div class="bg-white bg-opacity-10 p-3 rounded-4 me-3 backdrop-blur">
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
                                            <form action="{{ route('admin.reports.complete', $report->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn-action btn-action-success" title="Selesai"><i class="fas fa-check-double"></i></button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-action btn-action-delete" title="Hapus" onclick="confirmDelete(this)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
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

    <!-- Modal Image -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            
            // 1. Logic Modal Gambar
            var imageModal = document.getElementById('imageModal');
            imageModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var imageUrl = button.getAttribute('data-image');
                document.getElementById('modalImageInfo').src = imageUrl;
            });

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
                    // Ambil data dari attribute
                    const status = row.getAttribute('data-status');
                    const searchText = row.getAttribute('data-search');

                    // Cek apakah Status sesuai (atau 'all')
                    const matchesStatus = (filterValue === 'all') || (status === filterValue);
                    
                    // Cek apakah Text sesuai pencarian
                    const matchesSearch = searchText.includes(searchTerm);

                    if (matchesStatus && matchesSearch) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                if (visibleCount === 0) {
                    if(noResultRow) noResultRow.style.display = '';
                } else {
                    if(noResultRow) noResultRow.style.display = 'none';
                }
            }

            // Event Listeners
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });

        // 3. Custom Alert untuk Konfirmasi Hapus
        function confirmDelete(button) {
            // Buat overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-alert-overlay';
            
            // Buat alert box
            overlay.innerHTML = `
                <div class="custom-alert-box">
                    <div class="alert-icon-wrapper">
                        <i class="fas fa-exclamation-triangle alert-icon"></i>
                    </div>
                    <h3 class="alert-title">Konfirmasi Hapus</h3>
                    <p class="alert-message">
                        Apakah Anda yakin ingin menghapus laporan ini secara permanen? 
                        <br><strong>Tindakan ini tidak dapat dibatalkan.</strong>
                    </p>
                    <div class="alert-buttons">
                        <button class="alert-btn alert-btn-cancel" onclick="closeAlert()">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button class="alert-btn alert-btn-confirm" onclick="proceedDelete(this)">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            
            // Simpan referensi form
            overlay.dataset.formButton = button.closest('form').id || 'temp-form-' + Date.now();
            button.closest('form').id = overlay.dataset.formButton;
            
            // Tambahkan ke body
            document.body.appendChild(overlay);
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function closeAlert() {
            const overlay = document.querySelector('.custom-alert-overlay');
            if (overlay) {
                overlay.style.animation = 'fadeOut 0.2s ease';
                setTimeout(() => {
                    overlay.remove();
                    document.body.style.overflow = '';
                }, 200);
            }
        }

        function proceedDelete(button) {
            const overlay = button.closest('.custom-alert-overlay');
            const formId = overlay.dataset.formButton;
            const form = document.getElementById(formId);
            
            if (form) {
                form.submit();
            }
            
            closeAlert();
        }

        // Close on overlay click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('custom-alert-overlay')) {
                closeAlert();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAlert();
            }
        });
    </script>
</x-app-layout>