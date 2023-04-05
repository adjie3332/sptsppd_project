<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use Carbon\Carbon;

class Spt extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'nomor_surat', 'dasar_perintah', 'maksud_tugas', 'tgl_pergi', 'tgl_kembali', 'waktu', 'tempat', 'tempat_ditetapkan', 'tgl_ditetapkan', 'yang_menetapkan'];
    // protected $dates = ['hari_tgl', 'tgl_ditetapkan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diperintah()
    {
        return $this->belongsToMany(Pegawai::class, 'spt_diperintahs');
    }
    public function menetapkan()
    {
        return $this->hasOne(Pegawai::class, 'id', 'yang_menetapkan');
    }
}
