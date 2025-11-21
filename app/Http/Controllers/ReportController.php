<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF

class ReportController extends Controller
{
    public function exportInventory()
    {
        // 1. Kunin lahat ng products kasama ang Category
        $products = Product::with('category')->orderBy('name')->get();

        // 2. Calculate Total Inventory Value (Price * Quantity ng bawat item)
        $totalValue = $products->sum(function ($product) {
            return $product->price * $product->quantity;
        });

        // 3. Kunin ang Date ngayon
        $date = now()->format('F d, Y');

        // 4. I-load ang view at ipasa ang data
        $pdf = Pdf::loadView('admin.reports.inventory_pdf', compact('products', 'totalValue', 'date'));

        // 5. I-download ang PDF (inventory-report.pdf)
        return $pdf->download('inventory-report-'.now()->format('Y-m-d').'.pdf');
    }
}