<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Buku extends Model
{
    public $timestamps = true;
    protected $table = 'tb_buku';
    protected $primaryKey = 'id_buku';
    public $incrementing = false;
    protected $keyType = 'string';

   protected $fillable = [
    'id_buku',
    'judul_buku',
    'pengarang',
    'penerbit',
    'th_terbit',
    'id_kategori',
    'penyunting',
    'edisi',
    'deskripsi_fisik',
    'isbn',
    'bahasa',
    'call_number',
    'sinopsis',
    'foto'
];
public function kategori()
{
    return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
}

}
