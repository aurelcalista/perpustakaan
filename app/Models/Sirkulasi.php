<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sirkulasi extends Model
{
    protected $table = 'tb_sirkulasi';
    protected $primaryKey = 'id_sk';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_sk',
        'id_buku',
        'id_anggota',
        'tgl_pinjam',
        'tgl_kembali',
        'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }
}
