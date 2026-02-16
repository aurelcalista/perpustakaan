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

                <form method="POST" action="{{ route('profile.update') }}" class="edit-profile-form">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label">ID Anggota (NIS)</label>
                        <input type="text" 
                               name="nis"
                               class="form-control"
                               value="{{ old('nis', auth()->user()->nis) }}"
                               placeholder="Masukkan NIS">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Anggota</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama', auth()->user()->nama) }}"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label class="form-label">No Identitas / Kelas </label>
                        <input type="text"
                               name="noidentitas"
                               class="form-control"
                               value="{{ old('noidentitas', auth()->user()->noidentitas) }}"
                               placeholder="Contoh: X RPL 1">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', auth()->user()->email) }}"
                               placeholder="email@example.com">
                    </div>

                    <div class="form-group-full">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No Telepon</label>
                        <input type="text"
                               name="notlp"
                               class="form-control"
                               value="{{ old('notlp', auth()->user()->notlp) }}"
                               placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">
                            💾 Simpan Perubahan
                        </button>
                        <a href="{{ route('profile.show') }}" class="btn btn-cancel">
                            ❌ Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection