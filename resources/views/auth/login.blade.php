@extends('layout.login')
@section('content')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
      <!-- logo -->
        <div class="login-container">
            <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/logosmk.png') }}" alt="logo" class="img-thumbnail rounded-circle" width="150">
            </div>
            <h1 class="school-name">SMK Negeri 1 Cirebon</h1>
            <p class="library-title">Sistem Informasi Perpustakaan</p>
        </div>

        <div class="welcome-text">
            <h2>Selamat Datang</h2>
            <p>Silakan login untuk mengakses perpustakaan digital</p>
        </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="nis">ID Anggota (NIS)</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                        </svg>
                        <input type="text" id="nis" name="nis" placeholder="Masukkan NIS Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>
            </div>

            <div class="form-options">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
            </div>

            <button type="submit" class="login-button">Login</button>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>
        </form>
    </div>
@endsection
