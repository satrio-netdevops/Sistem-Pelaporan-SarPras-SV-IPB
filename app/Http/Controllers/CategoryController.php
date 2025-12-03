<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // 1. Display list of categories
    public function index(): View
    {
        // Kunin ang categories, pinakabago sa taas
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    // 2. Store a new category
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        // Save to Database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // ADD LOG
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Category',
            'details' => 'Added category: ' . $request->name
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    // 3. Update an existing category
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            // Unique check pero ignrahin ang sariling ID para hindi mag-error
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // ADD LOG
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated Category',
            'details' => 'Updated category: ' . $request->name
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    // 4. Delete a category
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        // I-save muna ang pangalan bago i-delete
        $name = $category->name;

        $category->delete();

        // ADD LOG (Gamitin ang $name variable)
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted Category',
            'details' => 'Deleted category: ' . $name
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}