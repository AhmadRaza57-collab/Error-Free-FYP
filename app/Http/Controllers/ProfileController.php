<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "name" => "required|string|max:255",
            "username" => "required|string|max:50|unique:users,username," . $user->id,
            "email" => "required|email|unique:users,email," . $user->id,
        ]);

        $user->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
        ]);

        return back()->with("success", "Profile updated successfully!");
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "current_password" => "required",
            "password" => "required|min:6|confirmed",
        ]);

        // Check old password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with("error", "Current password is incorrect!");
        }

        // Update password
        $user->update([
            "password" => Hash::make($request->password),
        ]);

        return back()->with("success", "Password changed successfully!");
    }
}
