<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage; 
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

    public function getFotoProfilUrlAttribute(): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        return Storage::url($this->avatar);
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->nama ?? 'U', 0, 2));
    }

    public function hasFotoProfil(): bool
    {
        return ! empty($this->avatar);
    }

    public function favorit()
{
    return $this->hasMany(\App\Models\Favorit::class, 'user_id');
}

}

     