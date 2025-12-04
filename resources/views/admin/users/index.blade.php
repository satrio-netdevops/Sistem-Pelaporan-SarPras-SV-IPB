<x-app-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Palette Warna (Konsisten) */
            --ipb-blue: #004a8f;
            --ipb-dark: #002a52;
            --color-blue: #2563eb;
            --color-green: #10b981;
            --color-red: #ef4444;
            --color-indigo: #6366f1;
            
            --bg-body: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Poppins', sans-serif !important;
            color: var(--text-dark);
        }

        /* 2. HERO HEADER STYLE */
        .page-hero {
            background: linear-gradient(135deg, var(--ipb-dark) 0%, var(--ipb-blue) 100%);
            color: white;
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 74, 143, 0.3);
        }

        /* Dekorasi Background Abstrak */
        .page-hero::before {
            content: '';
            position: absolute;
            top: -50%; left: -10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            filter: blur(40px);
        }

        .hero-icon-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
            width: 60px; height: 60px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Tombol Add User di Header */
        .btn-add-user {
            background: white;
            color: var(--ipb-blue);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-decoration: none;
        }
        
        .btn-add-user:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.2);
            background: #f8fafc;
            color: var(--ipb-dark);
        }

        /* 3. CARD & TABLE STYLE */
        .user-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* TABLE CONTROLS (Show Entries & Search) */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 1.5rem 1rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .entries-control {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .entries-control label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
            margin: 0;
        }

        .entries-select {
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23004a8f' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            appearance: none;
        }

        .entries-select:hover {
            border-color: var(--ipb-blue);
            box-shadow: 0 0 0 3px rgba(0, 74, 143, 0.1);
        }

        .entries-select:focus {
            outline: none;
            border-color: var(--ipb-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 143, 0.15);
        }

        .search-control {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .search-control label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
            margin: 0;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .search-input {
            padding: 0.5rem 1rem 0.5rem 2.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            background: white;
            color: var(--text-dark);
            font-size: 0.875rem;
            width: 250px;
            transition: all 0.2s;
        }

        .search-input:hover {
            border-color: var(--ipb-blue);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--ipb-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 143, 0.15);
        }

        .search-input::placeholder {
            color: #94a3b8;
        }

        .custom-table thead th {
            background-color: #03305dff;
            color: #ffffffff;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .custom-table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: var(--text-dark);
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Hover Effect pada Baris */
        .custom-table tbody tr {
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.001);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            position: relative;
            z-index: 10;
        }

        /* 4. AVATAR STYLING */
        .avatar-wrapper {
            width: 45px; height: 45px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }

        .avatar-img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .avatar-initial {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); /* Indigo Gradient */
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* 5. ACTION BUTTONS */
        .btn-action {
            width: 36px; height: 36px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 0.75rem;
            transition: all 0.2s;
            border: none;
            background: #f1f5f9;
            color: var(--text-muted);
        }

        .btn-action:hover { transform: translateY(-3px); }

        .btn-edit:hover { background-color: #eff6ff; color: var(--color-blue); box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); }
        .btn-delete:hover { background-color: #fef2f2; color: var(--color-red); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2); }

        /* 6. PAGINATION STYLE */
        .pagination-wrapper {
            padding: 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pagination-info strong {
            color: var(--ipb-blue);
            font-weight: 700;
        }

        .pagination-controls {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .pagination-controls .pagination {
            margin: 0;
            display: flex;
            gap: 0.5rem;
        }

        .pagination-controls .page-link {
            border: 2px solid #e2e8f0;
            background: white;
            color: var(--text-dark);
            padding: 0.5rem 0.875rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            text-decoration: none;
            min-width: 40px;
            text-align: center;
        }

        .pagination-controls .page-link:hover {
            background: var(--ipb-blue);
            color: white;
            border-color: var(--ipb-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 74, 143, 0.25);
        }

        .pagination-controls .page-item.active .page-link {
            background: linear-gradient(135deg, var(--ipb-dark) 0%, var(--ipb-blue) 100%);
            color: white;
            border-color: var(--ipb-blue);
            box-shadow: 0 4px 10px rgba(0, 74, 143, 0.3);
        }

        .pagination-controls .page-item.disabled .page-link {
            background: #f1f5f9;
            color: #cbd5e1;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination-controls .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: none;
            background: #f1f5f9;
            color: #cbd5e1;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-control,
            .entries-control {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .pagination-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

    </style>

    <div class="container py-5">
        
       <div class="page-hero">
            <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center gap-3 w-100">
                
                <div class="d-flex flex-column flex-md-row align-items-center position-relative z-1 text-center text-md-start">
                    
                    <div class="hero-icon-box mb-2 mb-md-0 me-md-4">
                        <i class="fas fa-users-cog fa-2x text-white"></i>
                    </div>
                    
                    <div>
                        <h3 class="fw-bold m-0">Manage Users</h3>
                        <p class="m-0 opacity-75 mt-1" style="font-weight: 300;">Kelola akun pengguna, peran, dan hak akses sistem.</p>
                    </div>
                </div>
                
                <div class="position-relative z-1">
                    <a href="{{ route('admin.users.create') }}" class="btn-add-user">
                        <i class="fas fa-plus-circle text-primary"></i>
                        <span>Add New User</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="user-card">
            <!-- Table Controls: Show Entries & Search -->
            <div class="table-controls">
                <div class="entries-control">
                    <label for="entries">Show</label>
                    <select id="entries" class="entries-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label>entries</label>
                </div>

                <div class="search-control">
                    <label for="search">Search:</label>
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="search" class="search-input" placeholder="Type to search...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 35%;">User Profile</th>
                            <th style="width: 25%;">Email Address</th>
                            <th style="width: 20%;">Joined Date</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center fw-bold text-muted">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-wrapper">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="avatar-img">
                                            @else
                                                <div class="avatar-initial">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark fs-6">{{ $user->name }}</div>
                                            <span class="badge bg-light text-secondary border fw-normal" style="font-size: 0.7rem;">
                                                User Account
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="bg-light rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="far fa-envelope text-primary small"></i>
                                        </div>
                                        <span class="fw-medium">{{ $user->email }}</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $user->created_at->format('d M Y') }}</span>
                                        <span class="text-muted small">
                                            {{ $user->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action btn-edit" title="Edit User" data-bs-toggle="tooltip">
                                            <i class="fas fa-pen-nib"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf @method('DELETE')
                                            <button class="btn-action btn-delete" title="Delete User" data-bs-toggle="tooltip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Enhanced Pagination -->
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    @if(method_exists($users, 'total'))
                        Showing <strong>{{ $users->firstItem() ?? 1 }}</strong> to <strong>{{ $users->lastItem() ?? 10 }}</strong> of <strong>{{ $users->total() }}</strong> entries
                    @else
                        Showing <strong>1</strong> to <strong>{{ $users->count() }}</strong> of <strong>{{ $users->count() }}</strong> entries
                    @endif
                </div>

                <div class="pagination-controls">
                    @if(method_exists($users, 'hasPages') && $users->hasPages())
                        {{ $users->links() }}
                    @else
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Search functionality (client-side demo)
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('.custom-table tbody tr');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Entries selector (demo - would need backend implementation)
            const entriesSelect = document.getElementById('entries');
            entriesSelect.addEventListener('change', function() {
                console.log('Show ' + this.value + ' entries');
                // In production, this would trigger a page reload with new per_page parameter
            });
        });
    </script>
</x-app-layout>