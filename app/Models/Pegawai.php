<?php

namespace App\Models;

use App\Models\Sppd;
use App\Models\Spt;
use App\Models\Instansi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    // public $incrementing = false;
    protected $fillable = ['id', 'nip', 'name', 'jabatan', 'pangkat', 'golongan'];

    /**
     * Get all of the comments for the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    public function pemerintahpd()
    {
        return $this->hasMany(Sppd::class, 'pejabat_pemerintah');
    }
    public function diperintahpd()
    {
        return $this->hasMany(Sppd::class, 'pejabat_diperintah');
    }


    public function kepala_dinass()
    {
        return $this->hasMany(Instansi::class, 'kepala_dinas');
    }
    public function pejabat_pelaksanaa()
    {
        return $this->hasMany(Instansi::class, 'pejabat_pelaksana');
    }
    public function bendaharaa()
    {
        return $this->hasMany(Instansi::class, 'bendahara');
    }

    public function menetapkanpt()
    {
        return $this->hasMany(Spt::class, 'yang_menetapkan');
    }
}
