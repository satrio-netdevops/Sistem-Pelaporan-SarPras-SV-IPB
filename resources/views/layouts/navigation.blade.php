<style>
    /* =========================================
       1. SETTING UTAMA & WARNA
       ========================================= */
    :root {
        --ipb-navy-dark: #001f5f;
        --ipb-navy-light: #003399;
        --ipb-gold: #ffc107;      /* Kuning Emas untuk aksen */
        --text-white: #ffffff;
        --text-white-dim: rgba(255, 255, 255, 0.75);
    }

    /* Wrapper untuk memastikan background menyatu total */
    .header-wrapper {
        background: linear-gradient(to right, var(--ipb-navy-dark), var(--ipb-navy-light));
        box-shadow: 0 4px 20px rgba(0, 31, 95, 0.2);
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    /* =========================================
       2. TOP NAVBAR (LOGO & PROFIL)
       ========================================= */
    .top-navbar {
        background: transparent; /* Transparan agar ikut warna wrapper */
        padding-top: 0.75rem;
        padding-bottom: 0.25rem; /* Padding bawah tipis */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Garis pemisah sangat tipis */
    }

    .brand-text {
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        color: var(--text-white);
    }

    /* =========================================
       3. SUB NAVBAR (MENU NAVIGASI)
       ========================================= */
    .sub-navbar {
        background: transparent; /* Transparan agar ikut warna wrapper */
        padding: 0; 
        margin: 0;
    }

    .sub-navbar .container {
        display: flex;
        align-items: center;
    }

    .sub-navbar .nav {
        gap: 0; /* Hapus gap antar menu */
    }

    /* Style Item Menu */
    .nav-link-custom {
        font-family: 'Poppins', sans-serif;
        color: var(--text-white-dim) !important;
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.9rem 1.5rem !important;
        position: relative;
        transition: all 0.2s ease;
        border-radius: 0;
        white-space: nowrap;
        display: flex;
        align-items: center;
    }

    /* Ikon Menu */
    .nav-link-custom i {
        margin-right: 8px;
        color: rgba(255, 255, 255, 0.75) !important;
        transition: color 0.2s;
    }

    /* Saat Mouse Hover -> Jadi Putih Transparan */
    .nav-link-custom:hover {
        color: #ffffff !important; 
        background-color: rgba(255, 255, 255, 0.1) !important;
    }

    .nav-link-custom:hover i {
        color: #ffffff !important;
    }

    /* AKTIF: Teks Putih, Background Terang, Garis Bawah Kuning */
    .nav-link-custom.active {
        color: var(--text-white) !important;
        background-color: rgba(255, 255, 255, 0.15) !important;
        font-weight: 600;
    }

    .nav-link-custom.active i {
        color: var(--ipb-gold) !important; /* Ikon jadi kuning */
    }

    /* Garis Kuning di Bawah Menu Aktif */
    .nav-link-custom.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--ipb-gold) !important;
    }

    /* Badge styling */
    .nav-link-custom .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }

    /* =========================================
       4. DROPDOWN PROFIL
       ========================================= */
    .user-dropdown-btn {
        color: rgba(255, 255, 255, 0.9);
        padding: 5px 10px;
        border-radius: 8px;
        transition: all 0.2s;
    }
    
    .user-dropdown-btn:hover, 
    .user-dropdown-btn[aria-expanded="true"] {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .dropdown-menu-custom {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 12px;
        margin-top: 10px !important;
    }
    
    .dropdown-item {
        padding: 10px 20px;
        font-size: 0.9rem;
        border-radius: 6px;
    }
    
    .dropdown-item:hover {
        background-color: #f0f7ff;
        color: var(--ipb-navy-dark);
    }
</style>

{{-- WRAPPER UTAMA (Ini yang bikin menyatu tanpa jarak) --}}
<div class="header-wrapper">
    
    {{-- 1. Top Navbar (Logo & User) --}}
    <nav class="top-navbar py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                
                {{-- Logo Brand --}}
                <a class="navbar-brand d-flex align-items-center gap-3" 
                   href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                    
                    {{-- LOGO IPB --}}
                    <img src="https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png" 
                         alt="IPB Logo" 
                         style="height: 45px; width: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
                    
                    <div class="d-flex flex-column lh-1 brand-text">
                        <span class="fw-bold fs-5">Ko'SaPrI</span>
                        <span style="font-size: 0.75rem; opacity: 0.9; color: #e2e8f0;">Sekolah Vokasi IPB</span>
                    </div>
                </a>

                {{-- User Profile --}}
                <div class="dropdown">
                    <button class="btn user-dropdown-btn d-flex align-items-center gap-3 border-0" 
                            type="button" 
                            id="profileDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        
                        {{-- Text User --}}
                        <div class="d-none d-md-flex flex-column align-items-end lh-sm text-end">
                            <span class="fw-bold" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                            <span style="font-size: 0.75rem; opacity: 0.7;">
                                {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Mahasiswa/Staff' }}
                            </span>
                        </div>

                        {{-- Avatar --}}
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 alt="Avatar" 
                                 class="rounded-circle border border-2 border-white shadow-sm" 
                                 style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-white text-navy d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                 style="width: 40px; height: 40px; font-size: 1.1rem; color: #001f5f;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        
                        <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem; opacity: 0.7;"></i>
                    </button>
                    
                    {{-- Dropdown Menu --}}
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom animate slideIn" 
                        aria-labelledby="profileDropdown">
                        <li class="px-3 py-2 border-bottom mb-2">
                            <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Signed in as</span>
                            <span class="fw-bold text-dark text-truncate d-block" style="max-width: 150px;">{{ Auth::user()->email }}</span>
                        </li>
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-circle me-2 text-primary"></i> Edit Profil
                            </a>
                        </li>
                        
                        {{-- @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2 text-secondary"></i> Pengaturan
                                </a>
                            </li>
                        @endif --}}

                        <li><hr class="dropdown-divider my-2"></li>
                        
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- 2. Sub Navbar (Menu Links) --}}
    <div class="sub-navbar py-3">
        <div class="container">
            <nav class="nav">
                @if(Auth::user()->role === 'admin')
                    {{-- Menu ADMIN --}}
                    <a class="nav-link nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-line"></i> Dasbor
                    </a>

                    <a class="nav-link nav-link-custom {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                       href="{{ route('admin.reports.index') }}">
                        <i class="fas fa-inbox"></i> Laporan Masuk
                        @if(isset($pendingCount) && $pendingCount > 0)
                            <span class="badge bg-danger ms-2 rounded-pill">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <a class="nav-link nav-link-custom {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                       href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i> Pengguna
                    </a>

                    <a class="nav-link nav-link-custom {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}" 
                       href="{{ route('admin.activity-logs.index') }}">
                        <i class="fas fa-history"></i> Log Aktivitas
                    </a>
                @else
                    {{-- Menu USER --}}
                    <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Laporan Saya
                    </a>

                    <a class="nav-link nav-link-custom {{ request()->routeIs('reports.create') ? 'active' : '' }}" 
                       href="{{ route('reports.create') }}">
                        <i class="fas fa-plus-circle"></i> Buat Laporan
                    </a>
                @endif
            </nav>
        </div>
    </div>

</div> 
{{-- End of Header Wrapper --}}