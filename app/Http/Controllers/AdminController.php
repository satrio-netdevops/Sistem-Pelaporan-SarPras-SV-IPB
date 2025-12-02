<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report; // Pastikan import Model Report
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Hitung Total Semua Laporan
        $totalReports = Report::count();

        // 2. Hitung Laporan yang Masih Pending (Butuh Aksi)
        $pendingReports = Report::where('status', 'pending')->count();

        // 3. Hitung Laporan yang Sudah Diproses (Approved/Completed)
        $processedReports = Report::whereIn('status', ['approved', 'completed'])->count();

        // 4. Hitung Total User (Kecuali Admin biar datanya real)
        $totalUsers = User::where('role', '!=', 'admin')->count();

        return view('admin.dashboard', compact(
            'totalReports', 
            'pendingReports', 
            'processedReports', 
            'totalUsers'
        ));
    }
    
    // ... method chart data biarkan dulu atau sesuaikan nanti ...
    public function getChartData()
    {
        // Kembalikan data jumlah laporan per hari untuk 7 hari terakhir
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('d M');
            $data[] = Report::whereDate('created_at', $date)->count();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}