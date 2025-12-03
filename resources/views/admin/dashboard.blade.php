<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        :root {
            /* Warna Utama */
            --ipb-blue: #004a8f;
            --ipb-dark: #003366;
            
        }

        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif; /* Menggunakan font modern jika tersedia */
        }

        /* 1. HEADER STYLE (Hero Section) */
        .dashboard-hero {
            /* Gradient Biru Tua sesuai gambar header */
            background: linear-gradient(135deg, #001f3f 0%, #004a8f 100%);
            color: white;
            border-radius: 1rem;
            position: relative;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .hero-icon-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }

        /* 2. STATS CARD STYLE */
        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Efek Hover: Kartu naik sedikit + Bayangan menebal */
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--color-blue); /* Border berubah warna saat hover */
        }

        /* Kotak Icon Berwarna */
        .stat-icon-square {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b; /* Abu-abu cool gray */
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1;
            color: #1e293b; /* Slate dark */
            margin-bottom: 0.25rem;
        }

        .stat-helper {
            font-size: 0.8rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Footer Link */
        .stat-footer {
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .stat-link {
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: gap 0.2s;
        }

        .stat-link:hover {
            gap: 8px; /* Animasi panah bergeser */
        }

        /* Tema Warna Per Kartu */
        /* Biru */
        .theme-blue .stat-icon-square { background: linear-gradient(135deg, #1ea5dbff 0%, #085274ff 100%); color: white; }
        .theme-blue .stat-link { color: var(--color-blue); }
        
        /* Hijau */
        .theme-green .stat-icon-square { background: linear-gradient(135deg, #1edb80ff 0%, #087440ff 100%); color: white; }
        .theme-green .stat-link { color: var(--color-green); }

        /* Orange/Kuning */
        .theme-orange .stat-icon-square { background: linear-gradient(135deg, #f59e0b 0%, #d55b10ff 100%); color: white; }
        .theme-orange .stat-link { color: var(--color-orange); }

        /* Ungu */
        .theme-purple .stat-icon-square { background: linear-gradient(135deg, #8325c1ff 0%, #520874ff 100%); color: white; }
        .theme-purple .stat-link { color: var(--color-purple); }

    </style>

    <div class="container py-5">
        
        <div class="row mb-5">
            <div class="col-12">
                <div class="dashboard-hero p-5 d-flex align-items-center">
                    <div class="hero-icon-box me-4">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold m-0">Dashboard Admin</h1>
                        <p class="m-0 opacity-75 fs-5">Pantau aktivitas pelaporan sarana dan prasarana secara real-time</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-dark mb-4">
                            Grafik Statistik Mingguan
                        </h5>
                        <div style="height: 350px; width: 100%;">
                            <canvas id="reportsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-md-3">
                <div class="stat-card theme-blue p-4 shadow-sm">
                    <div class="d-flex align-items-start">
                        <div class="stat-icon-square shadow-sm">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total Laporan</div>
                            <div class="stat-value">{{ $totalReports }}</div>
                            <div class="stat-helper">
                                <i class="fas fa-arrow-up small"></i> Semua laporan masuk
                            </div>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.reports.index') }}" class="stat-link">
                            Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card theme-green p-4 shadow-sm">
                    <div class="d-flex align-items-start">
                        <div class="stat-icon-square shadow-sm">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Diproses / Selesai</div>
                            <div class="stat-value">{{ $processedReports }}</div>
                            <div class="stat-helper">
                                <i class="fas fa-check small"></i> Laporan terverifikasi
                            </div>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.reports.index') }}" class="stat-link">
                            Cek Detail <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card theme-orange p-4 shadow-sm">
                    <div class="d-flex align-items-start">
                        <div class="stat-icon-square shadow-sm">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Perlu Tindakan</div>
                            <div class="stat-value">{{ $pendingReports }}</div>
                            <div class="stat-helper">
                                <i class="fas fa-clock small"></i> Menunggu verifikasi
                            </div>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.reports.index') }}" class="stat-link">
                            Verifikasi Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card theme-purple p-4 shadow-sm">
                    <div class="d-flex align-items-start">
                        <div class="stat-icon-square shadow-sm">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total User</div>
                            <div class="stat-value">{{ $totalUsers }}</div>
                            <div class="stat-helper">
                                <i class="fas fa-user-plus small"></i> Pengguna terdaftar
                            </div>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.users.index') }}" class="stat-link">
                            Kelola User <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('reportsChart').getContext('2d');

            // Gradient Fill untuk Chart agar terlihat modern
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.25)'); // Warna awal (atas)
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)');  // Transparan (bawah)

            fetch("{{ route('admin.dashboard.chart') }}")
                .then(res => res.json())
                .then(json => {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: json.labels,
                            datasets: [{
                                label: 'Laporan Masuk',
                                data: json.data,
                                borderColor: '#2563eb',     // Warna Garis Biru
                                backgroundColor: gradient,  // Warna Isi Gradient
                                borderWidth: 3,             // Tebal garis
                                tension: 0.4,               // Kelengkungan garis (smooth)
                                fill: true,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#2563eb',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 7
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    padding: 12,
                                    cornerRadius: 8,
                                    displayColors: false,
                                }
                            },
                            scales: {
                                x: { 
                                    grid: { display: false }, 
                                    ticks: { color: '#64748b' } 
                                },
                                y: { 
                                    beginAtZero: true, 
                                    border: { display: false }, // Hilangkan garis border sumbu Y
                                    grid: { 
                                        color: '#f1f5f9',       // Grid horizontal tipis
                                        borderDash: [5, 5]      // Grid putus-putus
                                    },
                                    ticks: { color: '#64748b', precision: 0 } 
                                }
                            }
                        }
                    });
                })
                .catch(err => console.error('Error loading chart data', err));
        });
    </script>
</x-app-layout>