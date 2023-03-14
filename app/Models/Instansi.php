<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama', 'alamat', 'telepon', 'faksimile', 'website', 'email', 'kodepos', 'kepala_dinas', 'sekretaris', 'kabid_KKP', 'kabid_KDCP'];

    public function kepalaa_dinas()
    {
        return $this->hasOne(Pegawai::class, 'id', 'kepala_dinas');
    }
    public function sekretaris()
    {
        return $this->hasOne(Pegawai::class, 'id', 'sekretaris');
    }
    public function kabid_KKP()
    {
        return $this->hasOne(Pegawai::class, 'id', 'kabid_KKP');
    }
    public function kabid_KDCP()
    {
        return $this->hasOne(Pegawai::class, 'id', 'kabid_KDCP');
    }

}
