<x-app-layout>
    <div class="container py-5">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ECFAE5; border: 1px solid #B0DB9C;">
                    <div>
                        <h2 class="fw-bold text-dark m-0">Dashboard Overview</h2>
                        <p class="text-muted m-0">Welcome back, Admin! Here's what's happening in your inventory.</p>
                    </div>
                    <i class="fas fa-chart-line fa-3x" style="color: #8AB973;"></i>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Total Products</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalProducts }}</h2>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-box text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.products.index') }}" class="small text-decoration-none fw-bold text-primary">
                            View Inventory <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Categories</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalCategories }}</h2>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-tags text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.categories.index') }}" class="small text-decoration-none fw-bold text-warning">
                            Manage Categories <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Staff Users</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalStaff }}</h2>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-users text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.users.index') }}" class="small text-decoration-none fw-bold text-success">
                            Manage Staff <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Low Stock</h6>
                            <h2 class="fw-bold text-danger m-0">{{ $lowStockCount }}</h2>
                        </div>
                        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        @if($lowStockCount > 0)
                            <a href="{{ route('admin.products.index') }}" class="small text-decoration-none fw-bold text-danger">
                                Check Items <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        @else
                            <span class="small text-success fw-bold"><i class="fas fa-check me-1"></i> Stocks are good</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card card-modern h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0 rounded-top-4">
                        <h6 class="m-0 fw-bold text-dark"><i class="fas fa-chart-bar me-2 text-primary"></i> Inventory Analytics</h6>
                        
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-filter text-muted"></i></span>
                            <select id="categoryFilter" class="form-select border-start-0 shadow-none">
                                <option value="all" selected>All Categories</option>
                                @foreach(App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="mainChart" style="height: 320px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-modern h-100">
                    <div class="card-header bg-white py-3 border-bottom-0 rounded-top-4">
                        <h6 class="m-0 fw-bold text-dark"><i class="fas fa-chart-pie me-2 text-success"></i> Stock Health</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="height: 220px; width: 220px; margin-bottom: 20px;">
                            <canvas id="stockChart"></canvas>
                        </div>
                        <p class="text-muted small text-center">
                            This chart updates based on the selected category filter.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <input type="hidden" id="chart-data-url" value="{{ route('admin.dashboard.chart') }}">

    @vite(['resources/js/dashboard.js'])

</x-app-layout>