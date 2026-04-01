<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';

    protected $fillable = [
        'user_id',
        'nama',
        'kelas',
        'id_buku',
        'isi',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}