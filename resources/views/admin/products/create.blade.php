<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-danger me-2 fs-4"></i>
                            <h5 class="fw-bold m-0 text-dark">Buat Laporan Baru</h5>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Jenis Aset <span class="text-danger">*</span></label>
                                    <select name="asset_type" class="form-select" required>
                                        <option value="Sarana">Sarana (Alat Bergerak)</option>
                                        <option value="Prasarana">Prasarana (Gedung/Fasilitas)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Jenis Laporan <span class="text-danger">*</span></label>
                                    <select name="report_type" class="form-select" required>
                                        <option value="Kerusakan">Kerusakan</option>
                                        <option value="Komplain">Komplain Kebersihan</option>
                                        <option value="Saran Pembaharuan">Saran Pembaharuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Nama Objek / Fasilitas <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-box"></i></span>
                                    <input type="text" name="object_name" class="form-control" placeholder="Contoh: AC Daikin, Kursi Dosen, Pintu Toilet" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Lokasi Detail <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" name="location" class="form-control" placeholder="Contoh: Gedung B Lantai 2, Ruang 101" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Foto Bukti <span class="text-danger">*</span></label>
                                <input type="file" name="photo" class="form-control" accept="image/*" required>
                                <div class="form-text text-muted">Format: JPG, PNG. Maksimal 5MB.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Kronologi / Detail Masalah <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan kerusakan atau keluhan secara rinci..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-light text-muted border">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-4 text-white">
                                    <i class="fas fa-paper-plane me-1"></i> Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>