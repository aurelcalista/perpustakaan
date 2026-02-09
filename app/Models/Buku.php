<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'tb_buku';
    protected $primaryKey = 'id_buku';
    public $incrementing = false;
    protected $keyType = 'string';
    public function sirkulasi()
    {
        return $this->hasMany(Sirkulasi::class, 'id_buku', 'id_buku');
    }
    public function logPinjam()
    {
        return $this->hasMany(LogPinjam::class, 'id_buku', 'id_buku');
    }
}
