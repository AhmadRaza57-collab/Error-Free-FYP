<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            if (Auth::user()->is_active == 'no') {
                Auth::logout();
                return back()->with('error', 'Your Account is inactive');
            }
            return to_route('dashboard');
        }
        return back()->with('error', 'Invalid credentials.');
    }
    public function showRegister()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:teacher,std',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'is_active' => 'no',
        ]);
        return to_route('login')->with('success', 'Registeration Successfull');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        ->session()->invalidate();
        ->session()->regenerateToken();
        return to_route("login")->with("success", "Logged out successfully!");
    }
}
