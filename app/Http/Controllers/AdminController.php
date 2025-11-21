<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        // 1. Existing Stats
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStaff = User::where('role', 'staff')->count();
        $lowStockCount = Product::where('quantity', '<=', 10)->count();
        
        // 2. CHART DATA 1: Products per Category
        // Kukunin natin ang pangalan ng category at bilang ng products sa loob nito
        $categoriesData = Category::withCount('products')->get();
        $categoryNames = $categoriesData->pluck('name'); // Labels (e.g., Electronics)
        $productCounts = $categoriesData->pluck('products_count'); // Data (e.g., 5, 10, 2)

        // 3. CHART DATA 2: Stock Status (Healthy vs Low)
        $healthyStockCount = Product::where('quantity', '>', 10)->count();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalStaff', 
            'lowStockCount',
            'categoryNames',
            'productCounts',
            'healthyStockCount'
        ));
    }

    // New Method: Fetch Chart Data via AJAX
    public function getChartData(Request $request)
    {
        $categoryId = $request->category_id;

        if ($categoryId && $categoryId != 'all') {
            // SCENARIO A: Specific Category Selected
            // Ipapakita natin ang TOP 10 Products sa category na ito at ang stock nila
            $products = Product::where('category_id', $categoryId)
                        ->orderBy('quantity', 'desc')
                        ->take(10)
                        ->get();

            $labels = $products->pluck('name'); // X-Axis: Product Names
            $data = $products->pluck('quantity'); // Y-Axis: Stock Quantity

            // Calculate Health for this category only
            $lowStock = Product::where('category_id', $categoryId)->where('quantity', '<=', 10)->count();
            $healthyStock = Product::where('category_id', $categoryId)->where('quantity', '>', 10)->count();

        } else {
            // SCENARIO B: Default (All Categories)
            // Ipapakita ang bilang ng products per category
            $categories = Category::withCount('products')->get();
            
            $labels = $categories->pluck('name'); // X-Axis: Category Names
            $data = $categories->pluck('products_count'); // Y-Axis: Total Products

            // Global Health
            $lowStock = Product::where('quantity', '<=', 10)->count();
            $healthyStock = Product::where('quantity', '>', 10)->count();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'stockHealth' => [$healthyStock, $lowStock]
        ]);
    }
}