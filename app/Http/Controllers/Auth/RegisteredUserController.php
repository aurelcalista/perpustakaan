<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       $request->validate([
            'nis' => 'required|string|max:8|unique:users,nis',
            'nama' => 'required|string|max:255',
            'noidentitas' => 'required|string',
            'alamat' => 'required|string',
            'notlp' => 'required|string',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.max'=>'NIS maksimal 8 karakter',
            'nis.unique' => 'NIS sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);


        $user = User::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'noidentitas' => $request->noidentitas,
            'alamat' => $request->alamat,
            'notlp' => $request->notlp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa'
        ]);

        event(new Registered($user));
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

    }
}
