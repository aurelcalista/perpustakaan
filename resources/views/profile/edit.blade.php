@extends('layout.app')

@section('body-class', 'profile-page')

@section('content')

<div class="library-profile-container">
    <div class="profile-layout">
        <div class="profile-main">

            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profil</h3>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" 
                               name="nis"
                               class="form-control"
                               value="{{ old('nis', auth()->user()->nis) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', auth()->user()->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text"
                               name="kelas"
                               class="form-control"
                               value="{{ old('kelas', auth()->user()->kelas) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat"
                                  class="form-control">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text"
                               name="no_telp"
                               class="form-control"
                               value="{{ old('no_telp', auth()->user()->no_telp) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', auth()->user()->email) }}">
                    </div>

                    <button type="submit" class="btn btn-success">
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
