<x-app-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Global Styling Sesuai Tema */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; /* Background halaman sedikit abu agar card menonjol */
        }

        .text-navy {
            color: #001f5f; /* Warna Utama IPB */
        }

        /* Card Modern dengan Soft Shadow */
        .card-modern {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 31, 95, 0.06); /* Bayangan biru halus */
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
        }

        .table-custom thead th {
            background-color: #001f5f; /* Header Tabel Navy */
            color: white;
            border: none;
            font-weight: 500;
            padding: 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Membuat sudut header tabel melengkung */
        .table-custom thead th:first-child { border-top-left-radius: 12px; }
        .table-custom thead th:last-child { border-top-right-radius: 12px; }

        .table-custom tbody tr:hover {
            background-color: #f0f8ff; /* Warna biru sangat muda saat di-hover */
        }

        .table-custom td {
            border-bottom: 1px solid #f0f0f0;
            padding: 15px;
            vertical-align: middle;
        }

        /* Icon Box di dalam Tabel */
        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eef2f7;
            color: #0056b3;
            transition: all 0.3s;
        }

        .table-custom tr:hover .icon-box {
            background-color: #0056b3;
            color: white;
        }

        /* Modal Styling */
        .modal-content-modern {
            border-radius: 16px;
            border: none;
        }
        
        .modal-header-modern {
            background-color: #001f5f;
            color: white;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        
        .modal-header-modern .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* List Group Item Styling */
        .list-group-item-modern {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem;
            transition: background 0.2s;
        }
        .list-group-item-modern:last-child { border-bottom: none; }
        .list-group-item-modern:hover { background-color: #f8f9fa; }

    </style>

    <div class="container py-5">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold text-navy m-0">Dasbor Inventaris</h3>
                <p class="text-muted small mb-0 mt-1">Kelola stok dan laporkan masalah sarana prasarana dengan mudah.</p>
            </div>
            <div>
                <button type="button" class="btn btn-ipb" data-bs-toggle="modal" data-bs-target="#reportModal" title="Tambah Laporan Baru">
                    <i class="fas fa-plus-circle me-2"></i> Buat Laporan
                </button>
            </div>
        </div>

        {{-- Tabel Produk --}}
        <div class="card card-modern mb-5">
            <div class="card-body p-0">
                <div class="table-responsive" style="border-radius: 12px;">
                    <table class="table table-custom align-middle w-100 m-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th style="width: 30%;">Nama Aset</th>
                                <th style="width: 25%;">Deskripsi</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-box me-3">
                                                <i class="fas fa-box-open fa-lg"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $product->name }}</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">ID: {{ $product->item_code ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate text-muted small" style="max-width: 200px;" title="{{ $product->description }}">
                                            {{ Str::limit($product->description, 60) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-secondary border fw-normal px-3 py-2 rounded-pill">
                                            {{ $product->category->name ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($product->quantity <= 10)
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-pill">
                                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $product->quantity }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill">
                                                {{ $product->quantity }} Unit
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('staff.products.label', $product->id) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary rounded-circle"
                                           style="width: 35px; height: 35px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                           title="Cetak Label QR">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3 text-light-gray"></i>
                                        <p>Belum ada data barang inventaris.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section Laporan Saya --}}
        <h4 class="fw-bold text-navy mb-3"><i class="fas fa-history me-2"></i>Riwayat Laporan Saya</h4>
        <div class="card card-modern">
            <div class="card-body p-0">
                @if(isset($myReports) && $myReports->count())
                    <ul class="list-group list-group-flush">
                        @foreach($myReports as $r)
                            <li class="list-group-item list-group-item-modern d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    {{-- Icon status --}}
                                    <div class="me-3 text-center" style="width: 40px;">
                                        @if($r->status === 'pending')
                                            <i class="fas fa-clock fa-lg text-warning" title="Menunggu"></i>
                                        @elseif($r->status === 'approved')
                                            <i class="fas fa-check-circle fa-lg text-success" title="Disetujui"></i>
                                        @else
                                            <i class="fas fa-times-circle fa-lg text-danger" title="Ditolak"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">
                                            <span class="text-primary">{{ ucfirst($r->type) }}</span> 
                                            @if($r->product) 
                                                &mdash; {{ $r->product->name }} 
                                            @endif
                                        </div>
                                        <div class="small text-muted mt-1">{{ Str::limit($r->notes, 100) }}</div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <small class="text-muted d-block mb-1">{{ $r->created_at->diffForHumans() }}</small>
                                    
                                    @if($r->status === 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3">Menunggu</span>
                                        <form action="{{ route('reports.destroy', $r->id) }}" method="POST" class="d-inline ms-2">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger p-0 ms-2" onclick="return confirm('Hapus laporan ini?')" title="Batalkan Laporan">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @elseif($r->status === 'approved')
                                        <span class="badge bg-success rounded-pill px-3">Selesai</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3">Ditolak</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 80px; opacity: 0.5;" class="mb-3">
                        <p class="text-muted">Anda belum membuat laporan apapun.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Report Modal (Styled) -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern shadow-lg">
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <div class="modal-header modal-header-modern p-4">
                        <h5 class="modal-title fw-bold"><i class="fas fa-clipboard-list me-2"></i> Buat Laporan Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        {{-- Select Produk --}}
                        <div class="mb-3">
                            <label class="fw-bold small text-navy mb-1">Pilih Barang/Aset <span class="text-danger">*</span></label>
                            <select name="product_id" class="form-select border-2" style="border-radius: 8px;" required>
                                <option value="">-- Cari nama barang --</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" {{ (string)old('product_id') === (string)$p->id ? 'selected' : '' }}>
                                        {{ $p->name }} (Stok: {{ $p->quantity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tipe Laporan --}}
                        <div class="mb-3">
                            <label class="fw-bold small text-navy mb-1">Jenis Laporan</label>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="type" id="type1" value="rusak" {{ old('type') == 'rusak' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-danger w-100 rounded-3" for="type1"><i class="fas fa-tools me-1"></i> Rusak</label>

                                <input type="radio" class="btn-check" name="type" id="type2" value="peminjaman" {{ old('type') == 'peminjaman' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary w-100 rounded-3" for="type2"><i class="fas fa-hand-holding me-1"></i> Pinjam</label>

                                <input type="radio" class="btn-check" name="type" id="type3" value="pengembalian" {{ old('type') == 'pengembalian' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success w-100 rounded-3" for="type3"><i class="fas fa-undo me-1"></i> Kembali</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold small text-navy mb-1">Jumlah (Opsional)</label>
                                <input type="number" name="quantity" class="form-control border-2 rounded-3" placeholder="0" value="{{ old('quantity') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold small text-navy mb-1">Keterangan Detail</label>
                            <textarea name="notes" class="form-control border-2 rounded-3" rows="3" placeholder="Deskripsikan kondisi barang atau keperluan peminjaman..." style="resize: none;">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light text-muted fw-bold rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-ipb px-4">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var reportModal = document.getElementById('reportModal');
        var reportForm = document.querySelector('#reportModal form');

        // Reset form when modal is dismissed
        reportModal && reportModal.addEventListener('hidden.bs.modal', function () {
            if (reportForm) reportForm.reset();
        });
    });
</script>
@endpush