<x-app-layout>
    {{-- Tambahkan Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Global Styling Sesuai Tema */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .text-navy {
            color: #001f5f; /* Warna Utama IPB */
        }

        /* Card Modern */
        .card-modern {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 31, 95, 0.08); /* Bayangan sedikit lebih dalam */
            overflow: hidden; /* Agar header radius mengikuti card */
        }

        /* Header Card Khusus */
        .card-header-modern {
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem 2rem;
        }

        /* Input Form Custom */
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #001f5f; /* Navy border saat aktif */
            box-shadow: 0 0 0 4px rgba(0, 31, 95, 0.1); /* Glow biru navy halus */
        }

        .form-label {
            color: #344767;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        /* Tombol Gradient Khas IPB */
        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%);
            border: none;
            color: white;
            padding: 12px 30px;
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

        .btn-light-custom {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-light-custom:hover {
            background-color: #e9ecef;
            color: #343a40;
        }

        /* Upload Area Styling */
        .upload-area {
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s;
        }
        .upload-area:hover {
            border-color: #001f5f;
            background-color: #fff;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                {{-- Breadcrumb Sederhana --}}
                <div class="mb-4">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-bold">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>

                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h4 class="fw-bold m-0 text-navy">
                            <i class="fas fa-clipboard-list me-2"></i>Buat Laporan Baru
                        </h4>
                        <p class="text-muted small m-0 mt-1">Silakan isi formulir di bawah ini dengan detail yang lengkap.</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label">Jenis Aset <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fas fa-cubes"></i></span>
                                        <select name="asset_type" class="form-select border-start-0 ps-0 bg-light">
                                            <option value="Sarana">Sarana (Alat/Benda)</option>
                                            <option value="Prasarana">Prasarana (Gedung/Fasilitas)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Laporan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fas fa-exclamation-circle"></i></span>
                                        <select name="report_type" class="form-select border-start-0 ps-0 bg-light">
                                            <option value="Kerusakan">Kerusakan</option>
                                            <option value="Komplain">Komplain</option>
                                            <option value="Saran Pembaharuan">Saran Pembaharuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nama Objek / Fasilitas <span class="text-danger">*</span></label>
                                <input type="text" name="object_name" class="form-control" placeholder="Contoh: AC Daikin, Kursi Dosen, Pintu Toilet" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Lokasi Detail <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" name="location" class="form-control border-start-0 ps-0" placeholder="Contoh: Gedung CB Lantai 2, Ruang CB B01" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Foto Bukti</label>
                                <div class="upload-area">
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*" style="display: none;" onchange="previewFile()">
                                    <label for="photo" class="d-block cursor-pointer" style="cursor: pointer;">
                                        <div class="mb-2">
                                            <i class="fas fa-cloud-upload-alt fa-2x text-navy"></i>
                                        </div>
                                        <span class="fw-bold text-dark">Klik untuk upload foto</span>
                                        <div class="small text-muted mt-1">Format: JPG, PNG (Max 10MB)</div>
                                    </label>
                                    <div id="file-preview" class="mt-2 text-success small fw-bold d-none">
                                        <i class="fas fa-check-circle me-1"></i> File terpilih: <span id="filename"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kronologi / Detail Masalah <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan masalah secara rinci agar teknisi dapat memahaminya..." required style="resize: none;"></textarea>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('dashboard') }}" class="btn btn-light-custom">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-ipb text-white">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const input = document.getElementById('photo');
            const preview = document.getElementById('file-preview');
            const filename = document.getElementById('filename');
            
            if (input.files && input.files[0]) {
                filename.textContent = input.files[0].name;
                preview.classList.remove('d-none');
            }
        }
    </script>
</x-app-layout>