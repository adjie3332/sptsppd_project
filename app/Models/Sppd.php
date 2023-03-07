<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Sppd extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'maksud_perintah', 'transportasi', 'tempat_berangkat', 'tempat_tujuan',  'tgl_pergi', 'tgl_kembali', 'pejabat_pemerintah', 'pejabat_diperintah', 'instansi', 'mata_anggaran', 'keterangan'];
    // protected $dates = ['tgl_pergi', 'tgl_kembali'];
    public function pengikut()
    {
        return $this->belongsToMany(Pegawai::class, 'sppd_pengikuts');
    }

    public function pejabat_pemerintahh()
    {
        return $this->hasOne(Pegawai::class, 'id', 'pejabat_pemerintah');
    }

    public function pejabat_diperintahh()
    {
        return $this->hasOne(Pegawai::class, 'id', 'pejabat_diperintah');
    }
}
