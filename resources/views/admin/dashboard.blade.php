<x-app-layout>
    <div class="container py-5">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ECFAE5; border: 1px solid #B0DB9C;">
                    <div>
                        <h2 class="fw-bold text-dark m-0">Dashboard Admin</h2>
                        <p class="text-muted m-0">Pantau aktivitas pelaporan sarana dan prasarana di sini.</p>
                    </div>
                    <i class="fas fa-chart-line fa-3x" style="color: #8AB973;"></i>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Grafik Laporan Masuk (7 hari terakhir)</h6>
                        <canvas id="reportsChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('reportsChart').getContext('2d');

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
                                    borderColor: '#4CAF50',
                                    backgroundColor: 'rgba(76,175,80,0.1)',
                                    tension: 0.3,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false }
                                },
                                scales: {
                                    y: { beginAtZero: true, precision: 0 }
                                }
                            }
                        });
                    })
                    .catch(err => console.error('Error loading chart data', err));
            });
        </script>

        <div class="row g-4 mb-5">
            
            <div class="col-md-3">
                <div class="card card-modern h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Total Laporan</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalReports }}</h2>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-file-alt text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.reports.index') }}" class="small text-decoration-none fw-bold text-primary">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Diproses / Selesai</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $processedReports }}</h2>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.reports.index') }}" class="small text-decoration-none fw-bold text-success">
                            Cek Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Perlu Tindakan</h6>
                            <h2 class="fw-bold text-danger m-0">{{ $pendingReports }}</h2>
                        </div>
                        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-exclamation-circle text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.reports.index') }}" class="small text-decoration-none fw-bold text-danger">
                            Verifikasi Sekarang <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Total User</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-users text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.users.index') }}" class="small text-decoration-none fw-bold text-info">
                            Kelola User <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>