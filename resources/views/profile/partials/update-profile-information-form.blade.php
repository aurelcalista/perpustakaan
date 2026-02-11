@extends('layout.app')

@section('content')
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- NIS -->
        <div>
            <x-input-label for="nis" value="NIS" />
            <x-text-input
                id="nis"
                name="nis"
                type="text"
                class="mt-1 block w-full"
                :value="old('nis', $user->nis)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('nis')" />
        </div>

        <!-- Nama -->
        <div>
            <x-input-label for="username" value="Nama" />
            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-1 block w-full"
                :value="old('username', $user->nama)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Kelas / Identitas -->
        <div>
            <x-input-label for="noidentitas" value="Kelas / Identitas" />
            <x-text-input
                id="noidentitas"
                name="noidentitas"
                type="text"
                class="mt-1 block w-full"
                :value="old('noidentitas', $user->noidentitas)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('noidentitas')" />
        </div>

        <!-- Alamat -->
        <div>
            <x-input-label for="alamat" value="Alamat" />
            <x-text-input
                id="alamat"
                name="alamat"
                type="text"
                class="mt-1 block w-full"
                :value="old('alamat', $user->alamat)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <!-- No Telepon -->
        <div>
            <x-input-label for="notlp" value="No Telepon" />
            <x-text-input
                id="notlp"
                name="notlp"
                type="text"
                class="mt-1 block w-full"
                :value="old('notlp', $user->notlp)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('notlp')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
@endsection
