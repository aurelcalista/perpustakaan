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
            'nis' => ['required', 'string', 'max:8', 'unique:users,nis'],
            'nama' => ['required', 'string', 'max:255'],
            'noidentitas' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'notlp' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        Auth::login($user);

        return redirect(route('/home'));
    }
}
