<x-app-layout>
    <style>
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
            font-family: 'Poppins', sans-serif;
        }

        /* 1. HERO HEADER STYLE */
        .page-hero {
            background: linear-gradient(135deg, #001f3f 0%, #004a8f 100%);
            color: white;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
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

        .hero-icon-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* 2. CARD & TABLE STYLE */
        .log-card {
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
            border-bottom: 1px solid #e2e8f0;
        }

        .custom-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* KHUSUS KOLOM DETAIL: Align Top agar rapi jika teks panjang */
        .col-detail {
            vertical-align: top !important; 
            line-height: 1.6;
            min-width: 300px;
        }

        .custom-table tbody tr {
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f5f9;
            transform: scale(1.001);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            z-index: 10;
            position: relative;
        }

        /* 3. SOFT BADGES */
        .badge-soft {
            padding: 0.5em 0.85em;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-create   { background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        .badge-verify   { background-color: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
        .badge-update   { background-color: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
        .badge-approve  { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .badge-delete   { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .badge-default  { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        /* 4. BUTTON STYLE */
        .btn-glass-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.4);
            transition: all 0.2s;
            font-weight: 600;
        }
        
        .btn-glass-danger:hover {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        /* Avatar Helper */
        .avatar-circle {
            width: 40px; 
            height: 40px; 
            object-fit: cover; 
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .avatar-initial {
            width: 40px; 
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* 5. CUSTOM ALERT MODAL */
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
            max-width: 450px;
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

        .alert-warning-box {
            background: #fef2f2;
            border: 2px solid #fecaca;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-warning-box strong {
            color: #dc2626;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .alert-warning-box p {
            color: #991b1b;
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.5;
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
                <div class="hero-icon-box me-4">
                    <i class="fas fa-history fa-2x text-white"></i>
                </div>
                <div>
                    <h3 class="fw-bold m-0">Log Aktivitas Sistem</h3>
                    <p class="m-0 opacity-75 mt-1 text-light">Rekam jejak digital aktivitas pengguna & administrator.</p>
                </div>
            </div>

            @if($logs->count() > 0)
                <div class="position-relative z-1">
                    <form action="{{ route('admin.activity-logs.reset') }}" method="POST" id="resetLogForm">
                        @csrf 
                        <button type="button" class="btn btn-glass-danger px-4 py-2 rounded-3 d-flex align-items-center" onclick="confirmResetLog()">
                            <i class="fas fa-trash-alt me-2"></i> Bersihkan Log
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="log-card">
            <div class="table-responsive">
                <table class="table custom-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 15%;">Waktu Kejadian</th>
                            <th style="width: 20%;">Pelaku (User)</th>
                            <th style="width: 15%;">Jenis Aksi</th>
                            <th>Detail Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td class="text-center fw-bold text-secondary">
                                    {{ $loop->iteration + $logs->firstItem() - 1 }}
                                </td>
                                
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $log->created_at->format('d M Y') }}</span>
                                        <span class="text-muted small">
                                            <i class="far fa-clock me-1"></i> {{ $log->created_at->format('H:i:s') }}
                                        </span>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($log->user && $log->user->avatar)
                                            <img src="{{ asset('storage/' . $log->user->avatar) }}" alt="Avatar" class="avatar-circle">
                                        @else
                                            <div class="avatar-initial">
                                                {{ substr($log->user->name ?? '?', 0, 1) }}
                                            </div>
                                        @endif

                                        <div>
                                            <div class="fw-bold text-dark">{{ $log->user->name ?? 'User Terhapus' }}</div>
                                            <div class="text-muted small" style="font-size: 0.8rem;">
                                                {{ $log->user->role ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if(Str::contains($log->action, ['Buat', 'New', 'Tambah']))
                                        <span class="badge badge-soft badge-create">
                                            <i class="fas fa-plus-circle"></i> {{ $log->action }}
                                        </span>
                                    
                                    @elseif(Str::contains($log->action, ['Verifikasi', 'Approve', 'Setuju']))
                                        <span class="badge badge-soft badge-verify">
                                            <i class="fas fa-clipboard-check"></i> {{ $log->action }}
                                        </span>

                                    @elseif(Str::contains($log->action, ['Selesaikan', 'Complete', 'Tuntas']))
                                        <span class="badge badge-soft badge-approve">
                                            <i class="fas fa-check-circle"></i> {{ $log->action }}
                                        </span>
                                    
                                    @elseif(Str::contains($log->action, ['Edit', 'Update', 'Ubah']))
                                        <span class="badge badge-soft badge-update">
                                            <i class="fas fa-edit"></i> {{ $log->action }}
                                        </span>

                                    @elseif(Str::contains($log->action, ['Hapus', 'Delete', 'Tolak', 'Reject', 'Reset']))
                                        <span class="badge badge-soft badge-delete">
                                            <i class="fas fa-trash"></i> {{ $log->action }}
                                        </span>

                                    @else
                                        <span class="badge badge-soft badge-default">
                                            <i class="fas fa-info-circle"></i> {{ $log->action }}
                                        </span>
                                    @endif
                                </td>

                                <td class="col-detail">
                                    <span class="text-secondary fw-medium text-wrap" style="word-break: break-word;">
                                        {{ $log->details }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                        <div class="bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-clipboard-list fa-3x text-secondary"></i>
                                        </div>
                                        <h6 class="text-muted fw-bold">Tidak ada aktivitas</h6>
                                        <p class="small text-muted mb-0">Belum ada rekam jejak aktivitas yang tercatat dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="p-4 border-top bg-white d-flex justify-content-end">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Custom Alert untuk Konfirmasi Reset Log
        function confirmResetLog() {
            // Buat overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-alert-overlay';
            
            // Buat alert box
            overlay.innerHTML = `
                <div class="custom-alert-box">
                    <div class="alert-icon-wrapper">
                        <i class="fas fa-exclamation-triangle alert-icon"></i>
                    </div>
                    <h3 class="alert-title">⚠️ PERINGATAN KERAS</h3>
                    <p class="alert-message">
                        Apakah Anda yakin ingin menghapus <strong>SELURUH</strong> riwayat aktivitas sistem?
                    </p>
                    
                    <div class="alert-warning-box">
                        <strong>⚡ Konsekuensi:</strong>
                        <p>• Semua log aktivitas akan dihapus permanen<br>
                        • Data yang dihapus tidak dapat dikembalikan<br>
                        • Audit trail sistem akan direset</p>
                    </div>
                    
                    <div class="alert-buttons">
                        <button class="alert-btn alert-btn-cancel" onclick="closeAlert()">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button class="alert-btn alert-btn-confirm" onclick="proceedResetLog()">
                            <i class="fas fa-trash-alt"></i> Ya, Hapus Semua
                        </button>
                    </div>
                </div>
            `;
            
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

        function proceedResetLog() {
            const form = document.getElementById('resetLogForm');
            
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