<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ko'SaPrI - Sekolah Vokasi IPB</title>

        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" type="image/png">
        <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" type="image/png">        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            :root {
                /* IPB OFFICIAL COLORS REIMAGINED FOR DARK THEME */
                --primary-blue: #005CAA;       /* IPB Blue standard */
                --deep-blue-bg: #001f3f;       /* Background Base */
                --dark-gradient: linear-gradient(135deg, #002B49 0%, #001219 100%);
                --light-blue-accent: #38bdf8; /* Cyan/Light Blue untuk text highlight */
                --glass-border: rgba(255, 255, 255, 0.1);
                --glass-bg: rgba(15, 23, 42, 0.6);
                --text-main: #f8fafc;
                /* Diperterang agar lebih terlihat di background gelap */
                --text-muted: #cbd5e1; 
            }

            body {
                font-family: 'Outfit', sans-serif;
                background: var(--dark-gradient); /* Dominan Biru Gelap */
                color: var(--text-main);
                overflow-x: hidden;
                min-height: 100vh;
            }

            /* --- OVERRIDES UNTUK VISIBILITAS TEKS --- */
            .text-muted {
                color: var(--text-muted) !important;
            }
            
            .text-secondary {
                color: rgba(255, 255, 255, 0.7) !important;
            }

            /* --- CREATIVE BACKGROUND BLOBS (GLOWING EFFECTS) --- */
            .hero-wrapper {
                position: relative;
                overflow: hidden;
                padding-top: 80px;
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(90px);
                z-index: -1;
                opacity: 0.6; /* Increased opacity for glow */
                animation: floatBlob 10s infinite alternate;
            }

            .blob-1 {
                top: -20%;
                left: -10%;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, var(--primary-blue), transparent);
            }

            .blob-2 {
                bottom: 0%;
                right: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, var(--light-blue-accent), transparent);
                animation-delay: -5s;
                opacity: 0.3;
            }

            .blob-3 {
                top: 40%;
                left: 40%;
                width: 300px;
                height: 300px;
                background: #2563EB;
                opacity: 0.2;
                filter: blur(120px);
            }
            
            /* Blob tambahan untuk section developer */
            .blob-4 {
                top: 10%;
                right: 20%;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, #005CAA, transparent);
                opacity: 0.2;
                filter: blur(80px);
            }

            @keyframes floatBlob {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(30px, 50px) scale(1.1); }
            }

            /* --- GLASSMORPHISM NAVBAR (DARK MODE) --- */
            .glass-nav {
                background: rgba(0, 20, 40, 0.7); /* Darker glass */
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border-bottom: 1px solid var(--glass-border);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            }

            .nav-link {
                color: #e2e8f0 !important; /* Dibuat lebih terang */
                transition: color 0.3s;
            }
            
            .nav-link:hover {
                color: #ffffff !important;
                text-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
            }

            /* --- TYPOGRAPHY & GRADIENTS --- */
            .gradient-text {
                background: linear-gradient(to right, #60a5fa, #38bdf8); /* Lighter gradient for dark bg */
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 800;
            }

            /* --- BUTTONS --- */
            .btn-glow {
                background: linear-gradient(135deg, #0EA5E9, #2563EB); /* Brighter blue button */
                border: none;
                color: white;
                border-radius: 50px;
                padding: 12px 35px;
                font-weight: 600;
                box-shadow: 0 0 20px rgba(14, 165, 233, 0.4); /* Glowing effect */
                transition: all 0.3s;
            }

            .btn-glow:hover {
                transform: translateY(-3px);
                box-shadow: 0 0 30px rgba(14, 165, 233, 0.6);
                color: white;
            }

            .btn-outline-modern {
                border: 2px solid rgba(255, 255, 255, 0.2);
                color: white;
                border-radius: 50px;
                padding: 10px 28px;
                font-weight: 600;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(5px);
                transition: all 0.3s;
            }

            .btn-outline-modern:hover {
                background: white;
                color: var(--primary-blue);
                border-color: white;
            }

            /* --- CARDS (DARK GLASS) --- */
            .glass-card {
                background: rgba(255, 255, 255, 0.03); /* Transparan */
                border-radius: 24px;
                padding: 2.5rem;
                height: 100%;
                border: 1px solid var(--glass-border);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease, border-color 0.3s;
                position: relative;
                overflow: hidden;
            }

            .glass-card:hover {
                transform: translateY(-10px);
                border-color: var(--light-blue-accent);
                background: rgba(255, 255, 255, 0.07);
            }

            .glass-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; width: 100%; height: 100%;
                background: linear-gradient(180deg, rgba(56, 189, 248, 0.1) 0%, transparent 100%);
                opacity: 0;
                transition: opacity 0.4s;
            }

            .glass-card:hover::before {
                opacity: 1;
            }

            .feature-icon {
                background: rgba(14, 165, 233, 0.15) !important;
                color: #38bdf8 !important;
                border: 1px solid rgba(56, 189, 248, 0.2);
            }

            /* --- DEVELOPER SECTION STYLES (UPDATED) --- */
            .dev-avatar-container {
                position: relative;
                display: inline-block;
                margin-bottom: 1.5rem;
            }

            .dev-avatar {
                /* UKURAN DIPERBESAR MENJADI 180px */
                width: 180px;
                height: 180px;
                
                /* Memastikan gambar mengisi lingkaran tanpa gepeng */
                object-fit: cover; 
                /* Fokus ke bagian atas-tengah (biasanya wajah ada di sini) */
                object-position: center;
                
                border-radius: 50%;
                border: 3px solid rgba(56, 189, 248, 0.3);
                padding: 4px;
                background: rgba(255,255,255,0.05);
                transition: all 0.4s ease;
            }

            .glass-card:hover .dev-avatar {
                border-color: var(--light-blue-accent);
                box-shadow: 0 0 25px rgba(56, 189, 248, 0.3);
                transform: scale(1.05);
            }

            .dev-role {
                font-size: 0.95rem;
                letter-spacing: 1px;
                text-transform: uppercase;
                color: var(--light-blue-accent);
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .dev-desc {
                font-size: 0.9rem;
                color: #cbd5e1;
                margin-bottom: 1.5rem;
                line-height: 1.6;
            }

            .social-icon {
                width: 40px;
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background: rgba(255,255,255,0.1);
                color: white;
                text-decoration: none;
                transition: all 0.3s;
                margin: 0 5px;
                 z-index: 9999;
                pointer-events: auto;
                font-size: 1.1rem;
            }

            .social-icon:hover {
                background: var(--light-blue-accent);
                color: var(--primary-blue);
                transform: translateY(-3px);
            }

            /* --- FLOATING CARDS (Small widgets) --- */
            .float-widget {
                background: rgba(15, 23, 42, 0.9);
                border: 1px solid rgba(255,255,255,0.1);
                color: white;
                backdrop-filter: blur(10px);
            }

            /* --- ANIMATION UNTUK GAMBAR GEDUNG --- */
            .animate-float-slow {
                animation: buildingFloat 6s ease-in-out infinite;
                transform-origin: center bottom;
            }

            @keyframes buildingFloat {
                0% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-15px) scale(1.02); } /* Naik sedikit dan membesar */
                100% { transform: translateY(0px) scale(1); }
            }

            /* Efek Delay untuk elemen lain */
            .animate-float-delayed {
                animation: buildingFloat 7s ease-in-out infinite;
                animation-delay: 1s;
            }

            /* --- FOOTER --- */
            footer {
                background-color: #001529 !important; /* Very dark blue */
                border-top: 1px solid var(--glass-border) !important;
                color: var(--text-muted);
            }

            .hover-link:hover { color: var(--light-blue-accent) !important; }
            
            /* Utilities */
            .text-highlight { color: var(--light-blue-accent); }
            .badge-glow {
                background: rgba(14, 165, 233, 0.2);
                border: 1px solid rgba(14, 165, 233, 0.3);
                color: #7dd3fc;
            }
        </style>
    </head>
    
    <body class="d-flex flex-column min-vh-100">

        <main class="flex-grow-1">
            
            <div class="hero-wrapper">
                <div class="blob blob-1"></div>
                <div class="blob blob-2"></div>
                <div class="blob blob-3"></div>

                <nav class="navbar navbar-expand-lg fixed-top glass-nav">
                    <div class="container">
                        <a class="navbar-brand fw-bold text-white d-flex align-items-center gap-3" href="#">
                            <img src="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" 
                                 alt="Logo IPB" 
                                 height="55" 
                                 class="d-inline-block align-text-center"
                                 style="filter: drop-shadow(0 0 10px rgba(255,255,255,0.3));">
                            
                            <div class="d-flex flex-column" style="line-height: 1.2;">
                                <span class="fw-bold" style="letter-spacing: -0.5px; font-size: 1.2rem;">Ko'SaPrI</span>
                                <span class="small fw-semibold text-highlight" style="font-size: 0.85rem; letter-spacing: 0.5px;">SEKOLAH VOKASI IPB</span>
                            </div>
                        </a>
                        
                        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <i class="fas fa-bars text-white fs-4"></i>
                        </button>
                        
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-center gap-4">
                                @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ url('/dashboard') }}" class="btn btn-glow px-4">
                                                Dashboard <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}" class="nav-link fw-medium">Log in</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a href="{{ route('register') }}" class="btn btn-glow">
                                                    Get Started
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>

                <section class="hero-content pt-5">
                    <div class="container">
                        <div class="row align-items-center min-vh-75">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill badge-glow mb-4 shadow-sm animate-float-delayed">
                                    <span class="badge bg-primary rounded-pill">Info</span>
                                    <span class="small fw-bold">Sistem Pelaporan Terintegrasi IPB</span>
                                </div>
                                
                                <h1 class="display-3 fw-bolder mb-4 text-white" style="line-height: 1.1;">
                                    Sistem Pelaporan <br>
                                    Sarana &
                                    <span class="gradient-text">Prasarana Kampus</span>
                                </h1>
                                
                                <p class="lead mb-5" style="color: #cbd5e1; max-width: 90%;">
                                    Platform digital resmi Sekolah Vokasi IPB untuk pelaporan kerusakan dan pemantauan perbaikan fasilitas secara <span class="fw-bold text-highlight">Real-Time</span> dan transparan.
                                </p>
                                
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ route('register') }}" class="btn btn-glow btn-lg shadow-lg">
                                        Buat Laporan
                                    </a>
                                    <a href="#features" class="btn btn-outline-modern btn-lg">
                                        <i class="fas fa-info-circle me-2"></i> Pelajari Fitur
                                    </a>
                                </div>

                                <div class="mt-5 pt-4 border-top border-secondary border-opacity-25">
                                    <p class="small fw-bold text-uppercase text-muted mb-3">Sistem Terintegrasi Dengan</p>
                                    <div class="tech-stack-container d-flex align-items-center gap-3 opacity-75">
                                        <span class="fw-bold text-light" style="font-size: 0.9rem;">ACADEMIC</span>
                                        <span class="text-secondary">•</span>
                                        <span class="fw-bold text-light" style="font-size: 0.9rem;">HELPDESK SV</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center position-relative pt-5">
                                <div class="hero-img-container position-relative" style="min-height: 650px; display: flex; align-items: center; justify-content: center;">
                                    
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; height: 80%; background: #005CAA; filter: blur(100px); opacity: 0.25; border-radius: 50%; z-index: 1;"></div>
                                    
                                    <div class="position-relative z-2 w-100 d-flex justify-content-center">
                                        <img src="{{ asset('images/zetaditxbaya.png') }}" 
                                             alt="Gedung Vokasi IPB" 
                                             class="img-fluid animate-float-slow" 
                                            
                                             style="filter: drop-shadow(0 30px 60px rgba(0, 92, 170, 0.4)); width: 92%; height: auto; object-fit: contain; margin-top: -160px; margin-bottom: 0px;">
                                    </div>
                                    
                                   
                                    <div class="float-widget p-3 rounded-4 shadow-lg position-absolute z-3 animate-float-delayed d-none d-md-block" 
                                         style="width: 180px; right: 20px !important; top: 10px !important; border-left: 4px solid var(--primary-blue);">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="spinner-grow spinner-grow-sm text-warning" role="status"></div>
                                            <span class="small fw-bold text-light">Status Perbaikan</span>
                                        </div>
                                        <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.1);">
                                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                                        </div>
                                        <span class="text-muted d-block mt-1" style="font-size: 10px;">Gedung CA (AC Rusak)</span>
                                    </div>

                                    <div class="float-widget p-3 rounded-4 shadow-lg position-absolute z-3 animate-float-slow d-none d-md-block" 
                                         style="width: 200px; left: -10px !important; bottom: 20px !important; border-left: 4px solid var(--light-blue-accent);">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted">Total Laporan</small>
                                                <h5 class="fw-bold m-0 text-highlight">128</h5>
                                            </div>
                                            <div class="bg-primary bg-opacity-25 rounded-circle text-info d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="fas fa-clipboard-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section id="features" class="py-5 position-relative" style="background: rgba(0,0,0,0.2);">
                <div class="container py-5">
                    <div class="text-center mb-5" style="max-width: 700px; margin: 0 auto;">
                        <span class="text-highlight fw-bold text-uppercase small ls-2">IPB University Standards</span>
                        <h2 class="display-5 fw-bold mt-2 mb-3 text-white">Fitur Unggulan</h2>
                        <p class="text-muted">Mendukung tata kelola pelaporan kerusakan fasilitas kampus yang responsif, akuntabel, dan efisien.</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon mb-3 d-inline-block p-3 rounded-3">
                                    <i class="fas fa-bolt fa-2x"></i>
                                </div>
                                <h4 class="fw-bold mb-3 text-white">Pelaporan Cepat</h4>
                                <p class="text-muted">Laporkan kerusakan gedung, ruang kelas, atau laboratorium dengan mudah. Cukup isi form dan unggah bukti foto.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon mb-3 d-inline-block p-3 rounded-3" style="color: #a5f3fc !important; background: rgba(165, 243, 252, 0.1) !important;">
                                    <i class="fas fa-list-check fa-2x"></i>
                                </div>
                                <h4 class="fw-bold mb-3 text-white">Tracking Status</h4>
                                <p class="text-muted">Pantau progres tindak lanjut laporan Anda secara <i>real-time</i>, mulai dari status 'Terkirim', 'Diproses', hingga 'Selesai'.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon mb-3 d-inline-block p-3 rounded-3">
                                    <i class="fas fa-mobile-screen-button fa-2x"></i>
                                </div>
                                <h4 class="fw-bold mb-3 text-white">Mobile Responsive</h4>
                                <p class="text-muted">Akses sistem kapan saja dan di mana saja melalui <i>smartphone</i> Anda untuk kemudahan pelaporan di lapangan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="developers" class="py-5 position-relative overflow-hidden">
                <div class="blob blob-4"></div>

                <div class="container">
                    <div class="text-center mb-5">
                        <span class="text-highlight fw-bold text-uppercase small ls-2">Meet The Team</span>
                        <h2 class="display-5 fw-bold mt-2 mb-3 text-white">Tim Pengembang</h2>
                        <p class="text-muted mx-auto" style="max-width: 600px;">
                            Mahasiswa Sekolah Vokasi IPB yang berdedikasi membangun sistem digitalisasi layanan kampus yang modern.
                        </p>
                    </div>

                    <div class="row g-4 justify-content-center mb-4">
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="glass-card text-center p-4">
                                <div class="dev-avatar-container">
                                    <img src="{{ asset('images/binggie.jpeg') }}"  
                                         alt="Developer 1" class="dev-avatar">
                                </div>
                                <h5 class="fw-bold text-white mb-1">Binggie Rashel Prasetyo</h5>
                                <p class="dev-role">Fullstack Engineer</p>
                                <p class="dev-desc">Merancang arsitektur aplikasi secara keseluruhan dan integrasi sistem front-to-back.</p>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="https://github.com/fuumasite" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                                    <a href="https://www.instagram.com/binggiershl?igsh=MTQ5cXhuZnc5cnN1MQ==" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="glass-card text-center p-4">
                                <div class="dev-avatar-container">
                                    <img src="{{ asset('images/jamil.jpeg') }}" 
                                         alt="Developer 2" class="dev-avatar">
                                </div>
                                <h5 class="fw-bold text-white mb-1">Mohammad Jamil Satrio W.</h5>
                                <p class="dev-role">Backend Engineer</p>
                                <p class="dev-desc">Mengembangkan logika server, manajemen database, dan deployment aplikasi.</p>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="https://github.com/satrio-netdevops" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                                    <a href="https://www.linkedin.com/in/mohammad-jamil-satrio-wahyudianto-68368328b/" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/satrio06__?igsh=MWVtM2g0ZGFlNm9zNQ==" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 justify-content-center">

                        <div class="col-lg-4 col-md-6">
                            <div class="glass-card text-center p-4">
                                <div class="dev-avatar-container">
                                    <img src="{{ asset('images/asti.jpeg') }}"  
                                         alt="Developer 3" class="dev-avatar">
                                </div>
                                <h5 class="fw-bold text-white mb-1">Asti Indriyanti</h5>
                                <p class="dev-role">Frontend Engineer</p>
                                <p class="dev-desc">Mengimplementasikan desain UI/UX menjadi antarmuka web yang interaktif dan responsif.</p>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="https://www.instagram.com/astiiyx?igsh=OHBzaDIwanluZm9q" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>

                         <div class="col-lg-4 col-md-6">
                            <div class="glass-card text-center p-4">
                                <div class="dev-avatar-container">
                                    <img src="{{ asset('images/wahyusitanggang.jpeg') }}" 
                                         alt="Developer 4" class="dev-avatar">
                                </div>
                                <h5 class="fw-bold text-white mb-1">Wahyu Pratomo</h5>
                                <p class="dev-role">Frontend Engineer</p>
                                <p class="dev-desc">Mengembangkan komponen visual frontend dan memastikan kompatibilitas antar browser.</p>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="https://github.com/WahyuPratomoo" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                                    <a href="https://www.instagram.com/wahyu.pratomoo?igsh=ajg5aWN2ZXc5Zjhv" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="glass-card text-center p-4">
                                <div class="dev-avatar-container">
                                    <img src="{{ asset('images/gyan.jpg') }}" 
                                         alt="Developer 5" class="dev-avatar">
                                </div>
                                <h5 class="fw-bold text-white mb-1">Gyanrendra Nayaran W.</h5>
                                <p class="dev-role" style="color: #6ee7b7;">Frontend Engineer</p>
                                <p class="dev-desc">Menyusun layout halaman web yang estetis serta memastikan pengalaman pengguna (UX) yang optimal.</p>
                                
                                <div class="d-flex justify-content-center">
                                   <a href="https://www.instagram.com/friedrich_12107?igsh=MXdnOGs3YXN2bmlrbA==" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <footer class="pt-5">
            <div class="container pb-4">
                <div class="row">
                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" 
                                 alt="Logo IPB" 
                                 height="40" 
                                 class="me-3"
                                 style="filter: drop-shadow(0 0 10px rgba(255,255,255,0.3));">
                            <div>
                                <h6 class="fw-bold mb-0 text-white">Layanan Sarana Prasarana</h6>
                                <small class="text-highlight fw-bold">Sekolah Vokasi IPB University</small>
                            </div>
                        </div>
                        <p class="text-muted small pe-lg-5">
                            Kampus IPB Cilibende, Jl. Kumbang No.14, RT.02/RW.06, Babakan, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16128
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                        <h6 class="fw-bold text-white mb-3">Tautan Cepat</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="https://sv.ipb.ac.id/" class="text-decoration-none text-muted hover-link" target="_blank">Website Utama SV</a></li>
                            <li class="mb-2"><a href="https://ipb.ac.id/" class="text-decoration-none text-muted hover-link" target="_blank">IPB University</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <h6 class="fw-bold text-white mb-3">Bantuan</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Panduan Pelaporan</a></li>
                            <li class="mb-2"><a href="https://helpcenter.ipb.ac.id/" class="text-decoration-none text-muted hover-link" target="_blank">Kontak Helpdesk</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top border-secondary border-opacity-25 py-3 text-center" style="background-color: rgba(0,0,0,0.2);">
                <p class="small text-muted mb-0">
                    &copy; {{ date('Y') }} <span class="fw-bold text-highlight">Sekolah Vokasi IPB University</span>. All rights reserved.
                </p>
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>