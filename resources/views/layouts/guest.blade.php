<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ko'SaPrI - Sekolah Vokasi IPB</title>

        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" type="image/png">
        <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" type="image/png">
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e8/Logo_IPB.svg" type="image/svg+xml">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <!-- Bootstrap 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

        <style>
            :root {
                /* --- PALET WARNA TEMA DEEP BLUE IPB --- */
                --primary-blue: #005CAA;
                --dark-gradient: linear-gradient(135deg, #002B49 0%, #001219 100%);
                --light-blue-accent: #38bdf8;
                --glass-bg: rgba(255, 255, 255, 0.05);
                --glass-border: rgba(255, 255, 255, 0.1);
                
                --text-main: #ffffff;
                --text-muted: #e2e8f0;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background: var(--dark-gradient);
                color: var(--text-main);
                overflow-x: hidden;
                min-height: 100vh;
            }

            /* --- BACKGROUND DECORATION --- */
            .blob-container {
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                z-index: -1;
                pointer-events: none;
                overflow: hidden;
            }
            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.5;
            }
            .blob-1 {
                top: -10%; left: -10%; width: 500px; height: 500px;
                background: radial-gradient(circle, #005CAA, transparent);
            }
            .blob-2 {
                bottom: -10%; right: -10%; width: 500px; height: 500px;
                background: radial-gradient(circle, #38bdf8, transparent);
                opacity: 0.3;
            }

            /* --- LAYOUT --- */
            .split-screen {
                min-height: 100vh;
                display: flex;
            }
            .row-full {
                width: 100%;
                min-height: 100vh;
            }

            /* --- PANEL KIRI --- */
            .left-panel {
                background: var(--glass-bg);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-right: 1px solid var(--glass-border);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 3rem;
                position: relative;
                color: white;
            }

            .left-panel .text-content {
                z-index: 2;
                max-width: 90%;
                margin: 0 auto;
                text-align: center;
            }

            /* Logo Animation */
            .logo-ipb-animate {
                filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.3));
                transition: transform 0.3s ease;
            }
            .logo-ipb-animate:hover {
                transform: scale(1.05);
                filter: drop-shadow(0 0 30px rgba(56, 189, 248, 0.5));
            }

            /* --- TYPOGRAPHY FIXES --- */
            .welcome-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 0;
            }

            .welcome-sub {
                font-weight: 300;
                font-size: 2.5rem;
                color: #ffffff;
                margin-bottom: 0.5rem;
                display: block;
            }

            /* Container Flex */
            .welcome-main-container {
                display: inline-flex;
                align-items: center;
                position: relative;
            }

            /* Teks Utama Tanpa Animasi Ketik */
            .welcome-main-text {
                font-size: 4rem;
                line-height: 1.1;
                letter-spacing: -1px;
                font-weight: 700;
                color: var(--light-blue-accent);
            }
            
            .text-muted { color: var(--text-muted) !important; }

            .feature-badge {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Bouncy Effect */
                cursor: default;
                position: relative;
                overflow: hidden;
            }

            .feature-badge:hover {
                transform: translateY(-5px) scale(1.05); /* Naik dan membesar sedikit */
                background: rgba(255, 255, 255, 0.2) !important; /* Background lebih terang */
                border-color: var(--light-blue-accent) !important; /* Border menyala biru muda */
                box-shadow: 0 10px 20px -5px rgba(56, 189, 248, 0.3); /* Bayangan biru */
            }

            .feature-badge i {
                transition: transform 0.4s ease;
            }

            .feature-badge:hover i {
                transform: scale(1.2) rotate(10deg); /* Ikon membesar dan miring sedikit */
            }

            /* Avatar Group Styling */
            .avatar-group {
                display: flex;
                align-items: center;
                margin-top: 2.5rem;
                background: rgba(255, 255, 255, 0.05);
                padding: 12px 25px;
                border-radius: 50px;
                border: 1px solid var(--glass-border);
                width: fit-content;
                margin-left: auto;
                margin-right: auto;
                backdrop-filter: blur(5px);
            }
            .avatar-group img {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                border: 2px solid white;
                margin-left: -15px;
                transition: transform 0.3s;
            }
            .avatar-group img:first-child { margin-left: 0; }
            .avatar-group img:hover { transform: translateY(-3px); z-index: 5; }
            .avatar-group span {
                margin-left: 15px;
                font-size: 0.95rem;
                color: var(--text-main);
                font-weight: 500;
            }

            /* --- PANEL KANAN --- */
            .right-panel {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                position: relative;
            }
            .auth-container {
                width: 100%;
                max-width: 450px;
            }

            /* --- TOAST --- */
            .toast {
                background-color: rgba(15, 23, 42, 0.95) !important;
                color: white;
                border: 1px solid var(--glass-border);
                backdrop-filter: blur(10px);
            }
            
            @media (max-width: 991.98px) {
                .left-panel { display: none !important; }
            }
        </style>
    </head>
    <body>
        <div class="blob-container">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
        </div>

        <div class="container-fluid p-0 split-screen">
            <div class="row g-0 row-full">
                
                <!-- LEFT PANEL (BRANDING) -->
                <div class="col-lg-6 d-none d-lg-flex left-panel">
                    
                    <div class="text-content my-auto"> 
                        <div class="mt-3 mb-5">
                            <!-- HANYA LOGO IPB (Diperbesar) -->
                            <img src="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" 
                                 alt="Logo IPB" 
                                 width="240" 
                                 class="logo-ipb-animate">
                        </div>
                        
                        <!-- STRUKTUR TEKS STATIS -->
                        <div class="welcome-wrapper">
                            <span class="welcome-sub" style="font-size: 1.5rem; opacity: 0.8;">Sistem Pelaporan Terintegrasi</span>
                            
                            <div class="welcome-main-container mb-3">
                                <span class="welcome-main-text">Ko'SaPrI SV IPB</span>
                            </div>

                            <p class="text-muted fs-6 mb-4" style="max-width: 80%; margin: 0 auto; line-height: 1.6;">
                                Mari wujudkan lingkungan kampus Sekolah Vokasi IPB yang nyaman, aman, dan kondusif dengan melaporkan kerusakan fasilitas secara transparan.
                            </p>

                            <div class="d-flex gap-2 justify-content-center flex-wrap mb-4">
                                <div class="feature-badge px-3 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-10 small fw-bold">
                                    <i class="fas fa-bolt text-warning me-2"></i>Respon Cepat
                                </div>
                                <div class="feature-badge px-3 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-10 small fw-bold">
                                    <i class="fas fa-search-location text-info me-2"></i>Tracking Realtime
                                </div>
                                <div class="feature-badge px-3 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-10 small fw-bold">
                                    <i class="fas fa-shield-alt text-success me-2"></i>Privasi Terjaga
                                </div>
                            </div>
                        </div>

                        <div class="feature-badge avatar-group mt-2 mb-5">
                            <img src="https://i.pravatar.cc/150?img=11" alt="User 1">
                            <img src="https://i.pravatar.cc/150?img=33" alt="User 2">
                            <img src="https://i.pravatar.cc/150?img=12" alt="User 3">
                            <img src="https://i.pravatar.cc/150?img=59" alt="User 4">
                            <span class="small text-white">Digunakan oleh Dosen, Staff & Mahasiswa</span>
                        </div>

                        <!-- USER JOINED SECTION -->
                        
                    </div>

                    <div class="mt-auto pb-3 small text-center" style="color: rgba(255,255,255,0.4);">
                        &copy; {{ date('Y') }} Ko'SaPrI SV IPB.
                    </div>
                </div>

                <!-- RIGHT PANEL (FORM SLOT) -->
                <div class="col-lg-6 right-panel">
                    <div class="auth-container">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            @if (session('status') || session('success'))
                <div class="toast align-items-center text-bg-success border-0 shadow-lg show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-check-circle me-2"></i> {{ session('status') ?? session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="toast align-items-center text-bg-danger border-0 shadow-lg show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-exclamation-circle me-2"></i> Please check the form for errors.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>