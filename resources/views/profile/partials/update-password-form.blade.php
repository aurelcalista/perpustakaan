@if(session('status') === 'password-updated')
    <div class="alert-success">✅ Password berhasil diperbarui!</div>
@endif

<p style="font-size:13px; color:#8a9bac; font-weight:500; margin: -10px 0 20px;">
    Gunakan password yang panjang dan acak agar akun tetap aman.
</p>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="form-grid" style="display:flex; flex-direction:column; gap:18px;">

        <!-- Password Saat Ini -->
        <div class="form-field">
            <label>Password Saat Ini <span class="req">*</span></label>
            <div class="input-pw-wrap">
                <input type="password" id="current_password" name="current_password"
                       class="form-input {{ $errors->updatePassword->has('current_password') ? 'is-error' : '' }}"
                       placeholder="Masukkan password saat ini"
                       autocomplete="current-password">
                <button type="button" class="toggle-pw" onclick="togglePw('current_password', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                </button>
            </div>
            @if($errors->updatePassword->has('current_password'))
                <span class="input-error">{{ $errors->updatePassword->first('current_password') }}</span>
            @endif
        </div>

        <!-- Password Baru -->
        <div class="form-field">
            <label>Password Baru <span class="req">*</span></label>
            <div class="input-pw-wrap">
                <input type="password" id="new_password" name="password"
                       class="form-input {{ $errors->updatePassword->has('password') ? 'is-error' : '' }}"
                       placeholder="Masukkan password baru"
                       autocomplete="new-password"
                       oninput="checkStrength(this.value); checkMatch()">
                <button type="button" class="toggle-pw" onclick="togglePw('new_password', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                </button>
            </div>
            <div class="strength-bar-wrap"><div class="strength-bar" id="strength-bar"></div></div>
            <span class="strength-label" id="strength-label" style="color:#8a9bac;"></span>
            @if($errors->updatePassword->has('password'))
                <span class="input-error">{{ $errors->updatePassword->first('password') }}</span>
            @endif
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-field">
            <label>Konfirmasi Password Baru <span class="req">*</span></label>
            <div class="input-pw-wrap">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-input"
                       placeholder="Ulangi password baru"
                       autocomplete="new-password"
                       oninput="checkMatch()">
                <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                </button>
            </div>
            <span class="match-label" id="match-label"></span>
            @if($errors->updatePassword->has('password_confirmation'))
                <span class="input-error">{{ $errors->updatePassword->first('password_confirmation') }}</span>
            @endif
        </div>

    </div>

    <div class="form-actions">
        <button type="submit" class="btn-save">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
            Simpan Password
        </button>
    </div>

</form>