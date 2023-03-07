<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\Pegawai;
use App\Models\Spt;
use App\Models\Biaya;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::count();
        $sppd = Sppd::count();
        $spt = Spt::count();
        $biaya = Biaya::count();
        return view('pages.dashboard', ['pegawai' => $pegawai, 'spt' => $spt, 'sppd' => $sppd, 'biaya' => $biaya]);
    }
}
