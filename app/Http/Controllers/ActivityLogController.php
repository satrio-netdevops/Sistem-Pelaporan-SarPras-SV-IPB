<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        // Kunin lahat ng logs, latest first
        $logs = ActivityLog::with('user')->latest()->get();
        
        return view('admin.activity_logs.index', compact('logs'));
    }
}