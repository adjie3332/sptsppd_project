<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama', 'alamat', 'telepon', 'faksimile', 'website', 'email', 'kodepos', 'kepala_dinas', 'pejabat_pelaksana', 'bendahara'];

    public function kepalaa_dinas()
    {
        return $this->hasOne(Pegawai::class, 'id', 'kepala_dinas');
    }
    public function pejabatt_pelaksana()
    {
        return $this->hasOne(Pegawai::class, 'id', 'pejabat_pelaksana');
    }
    public function bendaharas()
    {
        return $this->hasOne(Pegawai::class, 'id', 'bendahara');
    }
}
