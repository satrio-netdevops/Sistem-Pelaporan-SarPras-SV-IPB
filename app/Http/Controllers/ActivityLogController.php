<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    // 1. Tampilkan Semua Log
    public function index()
    {
        // Ambil data log, urutkan dari yang terbaru
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        
        return view('admin.activity_logs.index', compact('logs'));
    }

    // 2. Hapus Semua Log (Reset) - Fitur Opsional
    public function reset()
    {
        ActivityLog::truncate(); // Hapus semua isi tabel
        return back()->with('success', 'Semua log aktivitas berhasil dibersihkan.');
    }
}