@extends('layout.app')

@section('body-class', 'profile-page')

@section('content')

<div class="profile-page-wrap">
    <div class="profile-container">

        <!-- BODY -->
        <div class="profile-body">

            <!-- SIDEBAR NAV -->
            <nav class="profile-nav-card">
                <a class="profile-nav-item active" href="javascript:void(0)" onclick="switchPanel('profil', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    Edit Profil
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('password', this)">
                    <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                    Ganti Password
                </a>
                <a class="profile-nav-item nav-danger" href="javascript:void(0)" onclick="switchPanel('hapus', this)">
                    <svg viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                    Hapus Akun
                </a>
                <a class="profile-nav-item" href="{{ route('profile.show') }}">
                    <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    Kembali ke Profil
                </a>
            </nav>

            <!-- PANELS -->
            <div>

                <!-- EDIT PROFIL -->
                <div class="profile-panel active" id="panel-profil">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Edit Profil</h2>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- GANTI PASSWORD -->
                <div class="profile-panel" id="panel-password">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Ganti Kata Sandi</h2>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- HAPUS AKUN -->
                <div class="profile-panel" id="panel-hapus">
                    <div class="panel-card" style="border: 1px solid #ffcccc;">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title" style="color: #c53030;">Hapus Akun</h2>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div><!-- end panels -->

        </div><!-- end profile-body -->

    </div>
</div>

<script>
function switchPanel(name, el) {
    document.querySelectorAll('.profile-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.profile-nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    el.classList.add('active');
}
</script>

@endsection