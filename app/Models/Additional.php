<?php

namespace App\Models;

use App\Models\Biaya;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Additional extends Model
{
    use HasFactory;
    protected $fillable = ['uang_harian', 'uang_transport', 'biaya_transport'];

    public function uang_harianb()
    {
        return $this->belongsTo(Biaya::class, 'uang_harian');
    }
    public function uang_transportb()
    {
        return $this->belongsTo(Biaya::class, 'uang_transport');
    }
    public function biaya_transportb()
    {
        return $this->belongsTo(Biaya::class, 'biaya_transport');
    }
}
