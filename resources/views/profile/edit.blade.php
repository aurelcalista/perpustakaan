@extends('layout.app')

@section('body-class', 'profile-page')

@section('content')

<div class="profile-body">

    <div class="profile-grid">

        <!-- EDIT PROFIL -->
        <div class="panel-card">
            <h3 class="panel-title">Edit Profil</h3>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- EDIT PASSWORD -->
        <div class="panel-card">
            <h3 class="panel-title">Ganti Kata Sandi</h3>
            @include('profile.partials.update-password-form')
        </div>

    </div>

    <!-- HAPUS AKUN (FULL WIDTH) -->
    <div class="delete-section">
        <div class="panel-card danger-card">
            <h3 class="panel-title text-danger">Hapus Akun</h3>
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>

@endsection
