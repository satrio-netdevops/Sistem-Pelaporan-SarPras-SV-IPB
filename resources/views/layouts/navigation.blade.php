<style>
    /* 1. Styling Navigasi Utama (Atas) */
    .top-navbar {
        background: linear-gradient(to right, #001f5f, #003399); /* Gradasi Navy IPB */
        box-shadow: 0 4px 20px rgba(0, 31, 95, 0.15);
        z-index: 1030;
    }

    .brand-text {
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        color: #fff;
    }

    /* 2. Styling Menu Bawah (Sub Navbar) */
    .sub-navbar {
        background-color: #ffffff;
        border-bottom: 1px solid #edf2f7;
    }

    /* Hapus gap/jarak di tengah */
    .sub-navbar .nav {
        gap: 0; /* Hapus gap antar menu */
    }

    /* Style Dasar Menu (Default) */
    .nav-link-custom {
        font-family: 'Poppins', sans-serif;
        color: #5e6e82 !important; /* Abu-abu saat tidak aktif */
        font-weight: 600;
        font-size: 0.9rem;
        padding: 1rem 1.5rem !important; /* Padding lebih besar untuk menghilangkan gap */
        position: relative;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        white-space: nowrap; /* Mencegah text wrap */
    }

    /* Ikon Default (Abu-abu) */
    .nav-link-custom i {
        color: #5e6e82 !important; /* Ikon abu-abu saat tidak aktif */
        transition: color 0.3s ease;
    }

    /* Saat Mouse Hover -> Jadi Biru */
    .nav-link-custom:hover {
        color: #001f5f !important; /* Teks biru saat hover */
        background-color: #f8f9fa !important;
    }

    /* Ikon saat Hover -> Jadi Biru */
    .nav-link-custom:hover i {
        color: #001f5f !important; /* Ikon biru saat hover */
    }

    /* Saat Menu AKTIF/DIKLIK -> JADI BIRU */
    .nav-link-custom.active {
        color: #001f5f !important;       /* Teks jadi Navy */
        background-color: #f0f7ff !important; /* Background jadi Biru Muda */
    }
    
    /* Ikon pada Menu Aktif -> BIRU */
    .nav-link-custom.active i {
        color: #001f5f !important; /* Ikon jadi Navy saat aktif */
    }
    
    /* Garis Bawah pada Menu Aktif */
    .nav-link-custom.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #001f5f !important; /* Garis Bawah Navy */
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    /* Badge styling */
    .nav-link-custom .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }

    /* 3. Styling Dropdown Profile */
    .user-dropdown-btn {
        color: rgba(255, 255, 255, 0.9);
        transition: all 0.2s;
    }
    .user-dropdown-btn:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
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
        color: #001f5f;
    }
</style>

{{-- Top Navbar (Dark Navy) --}}
<nav class="top-navbar sticky-top py-2">
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
                <button class="btn user-dropdown-btn d-flex align-items-center gap-3 border-0 py-1 px-2" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    {{-- Text User --}}
                    <div class="d-none d-md-flex flex-column align-items-end lh-sm text-end">
                        <span class="fw-bold" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                        <span style="font-size: 0.75rem; opacity: 0.7;">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Mahasiswa/Staff' }}</span>
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
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom animate slideIn" aria-labelledby="profileDropdown">
                    <li class="px-3 py-2 border-bottom mb-2">
                        <span class="d-block small text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Signed in as</span>
                        <span class="fw-bold text-dark text-truncate d-block" style="max-width: 150px;">{{ Auth::user()->email }}</span>
                    </li>
                    
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-circle me-2 text-primary"></i> Edit Profil
                        </a>
                    </li>
                    
                    @if(Auth::user()->role === 'admin')
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2 text-secondary"></i> Pengaturan
                            </a>
                        </li>
                    @endif

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

{{-- Sub Navbar (Menu Links) --}}
<div class="sub-navbar shadow-sm">
    <div class="container">
        <nav class="nav">
            @if(Auth::user()->role === 'admin')
                {{-- Menu ADMIN --}}
                <a class="nav-link nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i> Dasbor
                </a>

                <a class="nav-link nav-link-custom {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                   href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-inbox me-2"></i> Laporan Masuk
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="badge bg-danger ms-2 rounded-pill">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a class="nav-link nav-link-custom {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                   href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users me-2"></i> Pengguna
                </a>

                <a class="nav-link nav-link-custom {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}" 
                   href="{{ route('admin.activity-logs.index') }}">
                    <i class="fas fa-history me-2"></i> Log Aktivitas
                </a>
            @else
                {{-- Menu USER --}}
                <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                   href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i> Laporan Saya
                </a>

                <a class="nav-link nav-link-custom {{ request()->routeIs('reports.create') ? 'active' : '' }}" 
                   href="{{ route('reports.create') }}">
                    <i class="fas fa-plus-circle me-2"></i> Buat Laporan
                </a>
            @endif
        </nav>
    </div>
</div>