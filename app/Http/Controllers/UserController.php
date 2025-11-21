<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog; 
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // 1. Display list
    public function index(): View
    {
        $users = User::where('role', 'staff')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. Show Create Form
    public function create(): View
    {
        return view('admin.users.create');
    }

    // 3. Store New User (WITH LOG)
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        // RECORD ACTIVITY
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Staff',
            'details' => 'Added new staff: ' . $user->name . ' (' . $user->email . ')'
        ]);

        return redirect()->route('admin.users.index')->with('success', 'New staff added successfully!');
    }

    // 4. Show Edit Form
    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 5. Update User (WITH LOG)
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // RECORD ACTIVITY
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated Staff',
            'details' => 'Updated details for staff: ' . $user->name
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Staff details updated successfully!');
    }

    // 6. Delete User (WITH LOG)
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'admin') {
            return back()->withErrors(['error' => 'Cannot delete an Admin account.']);
        }

        // Capture name before deleting
        $staffName = $user->name;
        $staffEmail = $user->email;

        $user->delete();

        // RECORD ACTIVITY
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted Staff',
            'details' => 'Removed staff account: ' . $staffName . ' (' . $staffEmail . ')'
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Staff account deleted successfully!');
    }
}