<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Sppd extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nomor_surat', 'maksud_perintah', 'transportasi', 'tempat_berangkat', 'tempat_tujuan',  'tgl_pergi', 'tgl_kembali', 'pejabat_pemerintah', 'pejabat_diperintah', 'instansi', 'mata_anggaran', 'keterangan','tgl_keluar' , 'tempat_tujuan_1', 'tgl_tiba_1', 'tgl_berangkat_dari_1', 'tempat_tujuan_2', 'tgl_tiba_2', 'tgl_berangkat_dari_2', 'tempat_tujuan_3', 'tgl_tiba_3', 'tgl_berangkat_dari_3'];
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
