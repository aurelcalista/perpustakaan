
@section('body-class', 'profile-page')

<div class="edit-page-wrap">
    <div class="edit-container">

        <a href="{{ route('profile.show') }}" class="back-btn">
            <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Kembali ke Profil
        </a>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="edit-card">
            <h2 class="edit-card-title">Edit Profil</h2>

            <!-- Avatar Upload -->
            <div class="avatar-upload-area">
                <div class="avatar-preview-wrap" onclick="document.getElementById('avatar-file-input').click()">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" id="avatar-edit-preview">
                    @else
                        <div class="avatar-initials-small" id="avatar-edit-initials">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                        </div>
                        <img id="avatar-edit-preview" style="display:none; width:100%; height:100%; object-fit:cover; position:absolute; inset:0;">
                    @endif
                    <div class="avatar-overlay">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z"/>
                            <path d="M9 3L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2h-3.17L15 3H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                        </svg>
                    </div>
                </div>
                <button type="button" class="btn-pilih-foto" onclick="document.getElementById('avatar-file-input').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z"/>
                        <path d="M9 3L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2h-3.17L15 3H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                    </svg>
                    Pilih Foto Profil
                </button>
                <input type="file" id="avatar-file-input" accept="image/*" style="display:none;" onchange="previewAvatarEdit(event)">
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" id="avatar-base64-edit" name="foto_base64">

                <div class="form-grid">

                    <div class="form-field">
                        <label>NIS / ID Anggota</label>
                        <input type="text" class="form-input" value="{{ Auth::user()->nis }}" disabled>
                        <span class="field-note">NIS tidak dapat diubah</span>
                    </div>

                    <div class="form-field">
                        <label>Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="nama"
                               class="form-input {{ $errors->has('nama') ? 'is-error' : '' }}"
                               value="{{ old('nama', Auth::user()->nama) }}"
                               placeholder="Masukkan nama lengkap" required>
                        @error('nama') <span class="input-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-field">
                        <label>No. Identitas / Kelas</label>
                        <input type="text" name="noidentitas" class="form-input"
                               value="{{ old('noidentitas', Auth::user()->noidentitas ?? '') }}"
                               placeholder="Contoh: X RPL 1">
                    </div>

                    <div class="form-field">
                        <label>Email <span class="req">*</span></label>
                        <input type="email" name="email"
                               class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                               value="{{ old('email', Auth::user()->email) }}"
                               placeholder="email@example.com" required>
                        @error('email') <span class="input-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-field">
                        <label>No. Telepon</label>
                        <input type="text" name="notlp" class="form-input"
                               value="{{ old('notlp', Auth::user()->notlp ?? '') }}"
                               placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-field full">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-input"
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', Auth::user()->alamat ?? '') }}</textarea>
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.show') }}" class="btn-cancel-link">Batal</a>
                </div>

            </form>
        </div>

    </div>
</div>
