<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;

class ReportController extends Controller
{
    // 1. MENAMPILKAN DAFTAR LAPORAN (INDEX)
    public function index()
    {
        // LOGIKA ADMIN: Arahkan ke folder admin/reports
        if (Auth::user()->role === 'admin') {
            $reports = Report::with('user')->latest()->paginate(20);
            return view('admin.reports.index', compact('reports'));
        }

        // LOGIKA STAFF: Arahkan ke folder staff/reports (Lihat history sendiri)
        $reports = Report::where('user_id', Auth::id())->latest()->paginate(10);
        return view('staff.reports.index', compact('reports'));
    }

    // Export semua laporan ke PDF
    public function exportPdf(Request $request)
    {
        $reports = Report::with('user')->latest()->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('reports'));

        return $pdf->download('laporan-masuk.pdf');
    }

    // Export semua laporan ke Excel
    public function exportExcel(Request $request)
    {
        $reports = Report::with('user')->latest()->get();

        return Excel::download(new ReportsExport($reports), 'laporan-masuk.xlsx');
    }

    // 2. MENAMPILKAN FORMULIR (CREATE)
    public function create()
    {
        // PENTING: Folder 'products' sudah kamu rename jadi 'reports' di Tahap 1
        return view('staff.reports.create');
    }

    // 3. MENYIMPAN DATA (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'asset_type' => 'required',
            'report_type' => 'required',
            'object_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:10240',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reports', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'asset_type' => $request->asset_type,
            'report_type' => $request->report_type,
            'object_name' => $request->object_name,
            'location' => $request->location,
            'quantity' => 1,
            'description' => $request->description,
            'photo_path' => $photoPath,
            'status' => 'pending'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Buat Laporan',
            'details' => Auth::user()->name . " melaporkan " . $request->report_type . " pada " . $request->object_name . " di " . $request->location
        ]);

        // Setelah lapor, kembalikan ke Dashboard (List Laporan Saya)
        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    // 4. LOGIKA APPROVAL (ADMIN)

   public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'rejected']);

        // LOG LEBIH DETAIL
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tolak Laporan',
            'details' => "Admin menolak laporan: " . $report->object_name . " (Pelapor: " . $report->user->name . ")"
        ]);

        return back()->with('success', 'Laporan ditolak.');
    }

    // Admin: Verifikasi Laporan (Status: Pending -> Approved/Proses)
   public function approve($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'approved']);

        // LOG LEBIH DETAIL
        ActivityLog::create([
            'user_id' => Auth::id(), // ID Admin yang melakukan aksi
            'action' => 'Verifikasi Laporan',
            // Kita tambahkan info pelapornya
            'details' => "Admin memverifikasi laporan: " . $report->object_name . " (Pelapor: " . $report->user->name . ")"
        ]);

        return back()->with('success', 'Laporan diverifikasi. Status: Sedang Diproses.');
    }

    // Admin: Selesaikan Laporan (Status: Approved -> Completed)
    public function complete($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'completed']);

        // LOG LEBIH DETAIL
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Selesaikan Laporan',
            'details' => "Admin menyelesaikan laporan: " . $report->object_name . " (Pelapor: " . $report->user->name . ")"
        ]);

        return back()->with('success', 'Laporan telah diselesaikan.');
    }

    // 5. HAPUS LAPORAN
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // LOG DULU SEBELUM HAPUS
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Hapus Laporan',
            'details' => "Admin menghapus laporan: " . $report->object_name . " " . $report->location . " (Milik: " . $report->user->name . ")"
        ]);

        // Hapus foto jika ada
        if ($report->photo_path) {
            Storage::disk('public')->delete($report->photo_path);
        }

        // Baru hapus data
        $report->delete();
        
        return back()->with('success', 'Laporan dihapus.');
    }
}