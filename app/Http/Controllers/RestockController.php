<?php

namespace App\Http\Controllers;

use App\Models\RestockRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RestockController extends Controller
{
    // 1. Display All Requests
    public function index(): View
    {
        // Kunin ang requests, 'Pending' muna ang mauna, sunod ang latest dates
        $requests = RestockRequest::with(['product', 'user'])
                    ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
                    ->latest()
                    ->get();

        return view('admin.restock.index', compact('requests'));
    }

    // 2. Approve Request (Auto-Add Stock)
    public function approve($id)
    {
        $request = RestockRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->withErrors(['error' => 'This request has already been processed.']);
        }

        // A. Update Product Stock (Auto Increment)
        $product = $request->product;
        $product->increment('quantity', $request->quantity);

        // B. Mark Request as Approved
        $request->update(['status' => 'approved']);

        // C. Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Approved Restock',
            'details' => "Approved request for {$product->name}. Added {$request->quantity} stocks."
        ]);

        return back()->with('success', 'Request approved and stocks added successfully!');
    }

    // 3. Reject Request
    public function reject($id)
    {
        $request = RestockRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->withErrors(['error' => 'This request has already been processed.']);
        }

        // Mark as Rejected
        $request->update(['status' => 'rejected']);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Rejected Restock',
            'details' => "Rejected restock request for {$request->product->name}."
        ]);

        return back()->with('success', 'Request rejected.');
    }
    
    // 4. Delete History (Optional Cleanup)
    public function destroy($id)
    {
        RestockRequest::findOrFail($id)->delete();
        return back()->with('success', 'Record deleted.');
    }
}