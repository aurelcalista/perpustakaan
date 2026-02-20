<section>
    <p style="font-size:13px; color:#8a9bac; font-weight:500; margin: -10px 0 20px;">
        Setelah akun dihapus, semua data akan hilang permanen. Pastikan kamu sudah menyimpan data penting sebelum melanjutkan.
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="background:#c53030; color:#fff; border:none; border-radius:9px;
               padding:11px 22px; font-size:14px; font-weight:700; cursor:pointer;
               font-family:inherit; transition:background 0.2s;"
        onmouseover="this.style.background='#9b2c2c'"
        onmouseout="this.style.background='#c53030'">
        🗑 Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding:28px;">
            @csrf
            @method('delete')

            <h2 style="font-size:17px; font-weight:800; color:#1a2332; margin:0 0 8px;">
                Yakin ingin menghapus akun?
            </h2>
            <p style="font-size:13px; color:#8a9bac; font-weight:500; margin:0 0 22px;">
                Semua data akan dihapus permanen. Masukkan password untuk konfirmasi.
            </p>

            <div class="form-field" style="margin-bottom:6px;">
                <label style="font-size:12px; font-weight:700; color:#5a6b7b;
                              text-transform:uppercase; letter-spacing:0.5px;">
                    Password
                </label>
                <div class="input-pw-wrap">
                    <input type="password" id="delete_password" name="password"
                           class="form-input {{ $errors->userDeletion->has('password') ? 'is-error' : '' }}"
                           placeholder="Masukkan password kamu">
                    <button type="button" class="toggle-pw" onclick="togglePw('delete_password', this)">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
                @if($errors->userDeletion->has('password'))
                    <span class="input-error">{{ $errors->userDeletion->first('password') }}</span>
                @endif
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:24px;
                        padding-top:18px; border-top:1px solid #f0f4f8;">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="btn-cancel-link">
                    Batal
                </button>
                <button type="submit"
                        style="background:#c53030; color:#fff; border:none; border-radius:9px;
                               padding:11px 22px; font-size:14px; font-weight:700; cursor:pointer;
                               font-family:inherit; transition:background 0.2s;"
                        onmouseover="this.style.background='#9b2c2c'"
                        onmouseout="this.style.background='#c53030'">
                    🗑 Ya, Hapus Akun
                </button>
            </div>

        </form>
    </x-modal>
</section>