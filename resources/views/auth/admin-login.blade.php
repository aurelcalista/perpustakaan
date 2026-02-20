@extends('layout.login')
@section('content')

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
        <p>Silakan login untuk mengakses dashboard admin</p>
    </div>

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                    <input type="text" id="username" name="username"
                           value="{{ old('username') }}"
                           placeholder="Masukkan Username Anda" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                    </svg>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password" required>
                </div>
            </div>
        </div>

        <div class="form-options">
            <label class="remember-me">
                <input type="checkbox" name="remember">
                <span>Ingat Saya</span>
            </label>
            <a href="#" class="forgot-password">Lupa Password?</a>
        </div>

        <button type="submit" class="login-button">Login Admin</button>

    </form>
</div>

@endsection