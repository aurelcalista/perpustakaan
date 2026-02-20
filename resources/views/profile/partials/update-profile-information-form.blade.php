@if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
@endif


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
    <label>Kelas</label>
    <select name="noidentitas" class="form-input">
        <option value="">-- Pilih Kelas --</option>
        <option value="X RPL 1"  {{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'X RPL 1'  ? 'selected' : '' }}>X RPL 1</option>
        <option value="X RPL 2"  {{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'X RPL 2'  ? 'selected' : '' }}>X RPL 2</option>
        <option value="XI RPL 1" {{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
        <option value="XI RPL 2" {{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
        <option value="XII RPL 1"{{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'XII RPL 1'? 'selected' : '' }}>XII RPL 1</option>
        <option value="XII RPL 2"{{ old('noidentitas', Auth::user()->noidentitas ?? '') == 'XII RPL 2'? 'selected' : '' }}>XII RPL 2</option>
        {{-- tambah kelas lain di sini --}}
    </select>
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
    </div>
</form>