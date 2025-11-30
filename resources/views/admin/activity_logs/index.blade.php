<x-app-layout>
    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Log Aktivitas Sistem</h3>
                <small class="text-muted">Memantau rekam jejak aktivitas user & admin</small>
            </div>

            @if($logs->count() > 0)
                <form action="{{ route('admin.activity-logs.reset') }}" method="POST" onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus SEMUA riwayat aktivitas? Data yang dihapus tidak dapat dikembalikan.');">
                    @csrf 
                    <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                        <i class="fas fa-trash-alt me-2"></i> Bersihkan Log
                    </button>
                </form>
            @endif
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
              
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 5%;">#</th>
                                <th class="py-3 px-3 small fw-bold text-muted">Waktu</th>
                                <th class="py-3 px-3 small fw-bold text-muted">User (Pelaku)</th>
                                <th class="py-3 px-3 small fw-bold text-muted">Aksi</th>
                                <th class="py-3 px-3 small fw-bold text-muted">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                    
                                    <td class="px-3 text-muted small fw-bold">
                                        {{ $log->created_at->format('d M Y') }} <br>
                                        {{ $log->created_at->format('H:i') }}
                                    </td>
                                    
                                    <td class="px-3 fw-bold small text-dark">
                                        <div class="d-flex align-items-center gap-2">
                                            @if($log->user && $log->user->avatar)
                                                <img src="{{ asset('storage/' . $log->user->avatar) }}" 
                                                    alt="{{ $log->user->name }}" 
                                                    class="rounded-circle border" 
                                                    style="width: 35px; height: 35px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold" 
                                                    style="width: 35px; height: 35px; font-size: 0.9rem;">
                                                    {{ substr($log->user->name ?? '?', 0, 1) }}
                                                </div>
                                            @endif

                                            <div>
                                                <div class="text-dark">{{ $log->user->name ?? 'User Terhapus' }}</div>
                                                <div class="text-muted" style="font-size: 0.75rem;">{{ $log->user->role ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-3">
                                        @if(Str::contains($log->action, ['Buat', 'New']))
                                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary">{{ $log->action }}</span>
                                        
                                        @elseif(Str::contains($log->action, ['Verifikasi', 'Approve']))
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info">{{ $log->action }}</span>
                                        
                                        @elseif(Str::contains($log->action, ['Selesaikan', 'Complete']))
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">{{ $log->action }}</span>
                                        
                                        @elseif(Str::contains($log->action, ['Tolak', 'Reject', 'Hapus', 'Delete']))
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">{{ $log->action }}</span>
                                        
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $log->action }}</span>
                                        @endif
                                    </td>

                                    <td class="px-3 text-muted small">{{ $log->details }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-history fa-3x mb-3 text-light"></i><br>
                                        Belum ada aktivitas tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>