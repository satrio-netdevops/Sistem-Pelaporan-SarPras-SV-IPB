<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Laporan Saya</h3>
            <a href="{{ route('reports.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Buat Laporan
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Objek & Lokasi</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="fw-bold">{{ $report->object_name }}</div>
                                    <small class="text-muted">{{ $report->location }}</small>
                                </td>
                                <td>{{ $report->report_type }}</td>
                                <td>
                                    @if($report->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($report->status == 'approved')
                                        <span class="badge bg-success">Diproses</span>
                                    @elseif($report->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($report->status == 'pending')
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Batalkan laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Anda belum membuat laporan apapun.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    </div>
</x-app-layout>