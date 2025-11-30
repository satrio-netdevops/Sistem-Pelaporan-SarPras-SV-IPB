<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="fw-bold m-0 text-dark"><i class="fas fa-edit me-2"></i>Buat Laporan Baru</h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Jenis Aset</label>
                                    <select name="asset_type" class="form-select">
                                        <option value="Sarana">Sarana (Alat/Benda)</option>
                                        <option value="Prasarana">Prasarana (Gedung/Fasilitas)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Jenis Laporan</label>
                                    <select name="report_type" class="form-select">
                                        <option value="Kerusakan">Kerusakan</option>
                                        <option value="Komplain">Komplain</option>
                                        <option value="Saran Pembaharuan">Saran Pembaharuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Nama Objek / Fasilitas</label>
                                <input type="text" name="object_name" class="form-control" placeholder="Contoh: AC Daikin, Kursi Dosen, Pintu Toilet" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Lokasi Detail</label>
                                <input type="text" name="location" class="form-control" placeholder="Contoh: Gedung CB Lantai 2, Ruang CB B01" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Foto Bukti</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                                <div class="form-text text-muted">Format: JPG, PNG. Maksimal 10MB.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Kronologi / Detail Masalah</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan secara rinci..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-light border">Batal</a>
                                <button type="submit" class="btn btn-primary text-white">Kirim Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>