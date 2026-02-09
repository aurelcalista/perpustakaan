<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'tb_anggota';
    protected $primaryKey = 'id_anggota';

    public $incrementing = false;
    protected $keyType = 'string';

    public function sirkulasi()
    {
        return $this->hasMany(Sirkulasi::class, 'id_anggota', 'id_anggota');
    }

    public function logPinjam()
    {
        return $this->hasMany(LogPinjam::class, 'id_anggota', 'id_anggota');
    }
}
