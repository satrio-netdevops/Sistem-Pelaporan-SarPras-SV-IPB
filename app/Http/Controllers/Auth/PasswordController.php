<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // 1. STANDARD VALIDATION (Para masalo ng Global Toast at @error tags)
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // 2. UPDATE PASSWORD
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // 3. RETURN WITH GENERIC 'SUCCESS' KEY (Para basahin ng Toast)
        return back()->with('success', 'Password updated successfully!');
    }
}