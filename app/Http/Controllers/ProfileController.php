<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    // Show the user profile
    public function indexProfile()
    {
        return view('admin.profile');
    }

    // Change password functionality
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }
    
        auth()->user()->update(['password' => Hash::make($request->new_password)]);
    
        return redirect()->route('indexProfile')->with('success', 'Password updated successfully!');
    }
    
}
