<x-guest-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            padding: 50px 40px;
            backdrop-filter: blur(10px);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #48c6ef 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .logo svg {
            width: 60px;
            height: 60px;
            fill: white;
        }

        .school-name {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #48c6ef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
        }

        .library-title {
            font-size: 16px;
            color: #64748b;
            font-weight: 500;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-text h2 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .welcome-text p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .session-status {
            background: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #48c6ef 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 15px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
            color: #64748b;
            font-size: 14px;
        }

        .register-link button {
            background: none;
            border: none;
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: color 0.3s ease;
            text-decoration: underline;
        }

        .register-link button:hover {
            color: #48c6ef;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 40px 30px;
            }

            .school-name {
                font-size: 20px;
            }

            .welcome-text h2 {
                font-size: 24px;
            }
        }
    </style>

    <div class="login-container">

        <div class="logo-container">
            <div class="logo">
            <img src="{{ asset('images/logosmk.png') }}" alt="logo" class="img-thumbnail rounded-circle" width="150">
            </div>
            <h1 class="school-name">SMK Negeri 1 Cirebon</h1>
            <p class="library-title">Sistem Informasi Perpustakaan</p>
        </div>

        <div class="welcome-text">
            <h2>Verifikasi Email</h2>
            <p>Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda dengan mengklik link yang telah kami kirimkan.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="session-status">
                Link verifikasi baru telah dikirimkan ke alamat email Anda.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="login-button">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <div class="register-link">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                Ingin ganti akun?
                <button type="submit">{{ __('Log Out') }}</button>
            </form>
        </div>

    </div>
</x-guest-layout>