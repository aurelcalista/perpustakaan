@extends('layout.login')
@section('content')

    <form method="POST" action="{{ route('register') }}">
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
            <p>Silakan registrasi untuk mengakses perpustakaan digital</p>
        </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                        </svg>
                        <input type="text" id="nis" name="nis" placeholder="Masukkan NIS Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Anggota</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="noidentitas">Nomor Identitas / Kelas</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        <select id="noidentitas" name="noidentitas" required>
                            <option value=""> Pilih Kelas Anda </option>
                            <option value="XI RPL 1" {{ old('noidentitas') == 'X RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                            <option value="XI RPL 2" {{ old('noidentitas') == 'X RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                    <input 
                        type="email" id="email" name="email" placeholder="Masukkan Email Anda" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notlp">No Telepon</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <input type="text" id="notlp" name="notlp" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" class="form-control" minlength="8" maxlength="20" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                    </svg>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang kata sandi" required>
                </div>
            </div>

              <!-- Privacy Policy Checkbox -->
            <div style="margin-top: 1.5rem;">
                <label style="display: flex; align-items: start; gap: 0.5rem; cursor: pointer; font-size: 0.875rem;">
                    <input type="checkbox" required style="margin-top: 0.25rem;">
                    <span>Saya menyatakan telah membaca dan menyetujui terkait <a href="#" style="color: #5ac4c2; text-decoration: none; font-weight: 600;">Kebijakan Privasi</a></span>
                </label>
            </div>
<br>
            <button type="submit" class="login-button">Register</button>

            <div class="register-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
@endsection

