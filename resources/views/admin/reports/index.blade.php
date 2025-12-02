<x-app-layout>
    <div class="container py-5">
        <h3 class="fw-bold mb-4">Daftar Laporan Masuk</h3>

        <div class="d-flex justify-content-end mb-3 gap-2">
            <a href="{{ route('admin.reports.export.pdf') }}" target="_blank" class="btn btn-outline-secondary">
                <i class="fas fa-file-pdf me-1"></i> Export PDF
            </a>
            <a href="{{ route('admin.reports.export.excel') }}" target="_blank" class="btn btn-outline-success">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Pelapor</th>
                                <th>Objek & Lokasi</th>
                                <th>Bukti</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                                <tr>
                                    <td class="small text-muted">
                                        {{ $report->created_at->format('d/m/Y') }} <br>
                                        {{ $report->created_at->format('H:i') }}
                                    </td>
                                    <td class="fw-bold">{{ $report->user->name }}</td>
                                    <td>
                                        <div class="text-dark fw-bold">{{ $report->object_name }}</div>
                                        <div class="small text-muted">{{ $report->location }}</div>
                                        <span class="badge bg-light text-dark border mt-1">{{ $report->asset_type }}</span>
                                    </td>
                                    <td>
                                        @if($report->photo_path)
                                            <button type="button" class="btn btn-sm btn-info text-white" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#imageModal"
                                                    data-image="{{ asset('storage/' . $report->photo_path) }}"
                                                    title="Lihat Bukti">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="small text-wrap" style="max-width: 200px;">
                                        {{ Str::limit($report->description, 50) }}
                                    </td>
                                    <td>
                                        @if($report->status == 'pending')
                                            <span class="badge bg-warning text-dark">Perlu Cek</span>
                                        @elseif($report->status == 'approved')
                                            <span class="badge bg-primary">Sedang Diproses</span> @elseif($report->status == 'completed')
                                            <span class="badge bg-success">Selesai</span> @elseif($report->status == 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            
                                            @if($report->status == 'pending')
                                                <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="btn btn-sm btn-primary" title="Verifikasi & Proses">
                                                        <i class="fas fa-tools me-1"></i> Proses
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="btn btn-sm btn-danger" title="Tolak"><i class="fas fa-times"></i></button>
                                                </form>

                                            @elseif($report->status == 'approved')
                                                <form action="{{ route('admin.reports.complete', $report->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button class="btn btn-sm btn-success" title="Tandai Selesai">
                                                        <i class="fas fa-check-double me-1"></i> Selesai
                                                    </button>
                                                </form>

                                            @elseif($report->status == 'completed')
                                                <span class="badge bg-success"><i class="fas fa-check"></i> Tuntas</span>

                                            @elseif($report->status == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif

                                            <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-secondary ms-1"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada laporan masuk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImageInfo" class="img-fluid rounded shadow-sm" alt="Bukti Laporan">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            // Tombol yang diklik
            var button = event.relatedTarget;
            // Ambil url gambar dari data-image
            var imageUrl = button.getAttribute('data-image');
            // Update src gambar di dalam modal
            var modalImg = document.getElementById('modalImageInfo');
            modalImg.src = imageUrl;
        });
    });
</script>
</x-app-layout>