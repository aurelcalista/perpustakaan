<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function create()
    {
        return view('auth.admin-login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Login tanpa cek role dulu
        if (! Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->filled('remember'))) {
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput($request->only('username'));
        }

        // Cek role setelah berhasil login
        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return back()->withErrors([
                'username' => 'Anda tidak memiliki akses sebagai admin',
            ])->withInput($request->only('username'));
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}