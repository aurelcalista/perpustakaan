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

        if (! Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin',
        ])) {
            return back()->withErrors([
                'username' => 'Login admin gagal',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}

