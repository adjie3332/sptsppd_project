<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pegawai;

class Biaya extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'kegiatan', 'lokasi', 'hari_tgl', 'rekening', 'uang_harian', 'uang_transport', 'biaya_transport'];
    public function pegawaib()
    {
        return $this->belongsToMany(Pegawai::class, 'biaya_diperintah');
    }

    public function uang_harian()
    {
        return $this->hasMany(Biaya::class, 'uang_harian');
    }
    public function uang_transport()
    {
        return $this->hasMany(Biaya::class, 'uang_transport');
    }
    public function biaya_transport()
    {
        return $this->hasMany(Biaya::class, 'biaya_transport');
    }
}
