<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage; // untuk Storage::url()
/**
 * @property \Illuminate\Support\Carbon|null $last_login_at
 */
/**
 * @property string|null $avatar
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'nis',
        'nama',
        'noidentitas',
        'alamat',
        'notlp',
        'email',
        'password',
        'role',
        'last_login_at',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    ];


    /**
     * URL lengkap foto profil, atau null bila belum diisi.
     *
     * Penggunaan di Blade:
     *   {{ Auth::user()->foto_profil_url ?? 'default.jpg' }}
     */
    public function getFotoProfilUrlAttribute(): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        return Storage::url($this->avatar);
    }

    /**
     * Dua huruf kapital dari nama, dipakai sebagai inisial avatar.
     *
     * Penggunaan di Blade:
     *   {{ Auth::user()->initials }}
     */
    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->nama ?? 'U', 0, 2));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Cek apakah user sudah punya foto profil.
     */
    public function hasFotoProfil(): bool
    {
        return ! empty($this->avatar);
    }

}

     