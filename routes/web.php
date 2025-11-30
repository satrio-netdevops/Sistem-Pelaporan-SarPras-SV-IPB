<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;

// LANDING PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/terms', 'auth.terms')->name('terms');
Route::view('/privacy-policy', 'auth.privacy-policy')->name('privacy.policy');
// AREA AUTHENTICATED (User & Admin bisa masuk sini)
Route::middleware(['auth'])->group(function () {
    
    // DASHBOARD: Diarahkan ke Controller Laporan
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');

    // FITUR LAPORAN (STAFF/USER)
    // 1. Form Buat Laporan (GET)
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    // 2. Kirim Laporan (POST)
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    // 3. Hapus Laporan Sendiri (DELETE)
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AREA KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin (Statistik)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/chart-data', [AdminController::class, 'getChartData'])->name('dashboard.chart');

    // Manajemen Laporan (Lihat Semua, Approve, Reject)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); // Admin lihat semua
    Route::patch('/reports/{id}/approve', [ReportController::class, 'approve'])->name('reports.approve');
    Route::patch('/reports/{id}/reject', [ReportController::class, 'reject'])->name('reports.reject');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy'); // Admin hapus paksa
    Route::patch('/reports/{id}/complete', [ReportController::class, 'complete'])->name('reports.complete');
    // Manajemen User & Logs
    Route::resource('users', UserController::class);
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::post('/activity-logs/reset', [ActivityLogController::class, 'reset'])->name('activity-logs.reset');
});

require __DIR__.'/auth.php';