<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Spt;
use App\Models\Sppd;
use App\Http\Controllers\SptController;
use App\Http\Controllers\SppdController;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function lap_spt(Request $request)
    {
        $lap_spt = Spt::query();

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tgl_awal = $request->input('tgl_awal');
            $tgl_akhir = $request->input('tgl_akhir');
            $lap_spt->whereBetween('tgl_ditetapkan', [$tgl_awal, $tgl_akhir]);
        }

        $lap_spt = $lap_spt->get();

        return view('pages.laporan.lap_spt', compact('lap_spt'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function lap_sppd(Request $request)
    {
        $lap_sppd = Sppd::query();

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tgl_awal = $request->input('tgl_awal');
            $tgl_akhir = $request->input('tgl_akhir');
            $lap_sppd->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir]);
        }

        $lap_sppd = $lap_sppd->get();

        return view('pages.laporan.lap_sppd', compact('lap_sppd'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
