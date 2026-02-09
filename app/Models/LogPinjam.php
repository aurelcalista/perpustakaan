<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPinjam extends Model
{
    protected $table = 'log_pinjam';
    protected $primaryKey = 'id_log';

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }
}
