<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Spt;
use App\Models\Sppd;
use App\Models\User;
use App\Http\Controllers\SptController;
use App\Http\Controllers\SppdController;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Exception;
use Attribute;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class LaporanController extends Controller
{
    public function lap_spt(Request $request)
    {
        $lap_spt = Spt::query();

        $tgl_awal = null;
        $tgl_akhir = null;

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tgl_awal = $request->input('tgl_awal');
            $tgl_akhir = $request->input('tgl_akhir');
            $lap_spt->whereBetween('tgl_ditetapkan', [$tgl_awal, $tgl_akhir]);
        } else {
            $tgl_awal = now()->format('2023-03-01');
            $tgl_akhir = now()->format('Y-m-d');
            $lap_spt->whereBetween('tgl_ditetapkan', [$tgl_awal, $tgl_akhir]);
        }

        // Fitur Pencarian
        $search = $request->input('search');
        if (!empty($search)) {
            $lap_spt->where(function ($query) use ($search) {
                $query->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhere('maksud_tugas', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%');
            });
        }

        $lap_spt = $lap_spt->get();

        if ($request->has('print')) {
            // Panggil fungsi untuk generate file PDF
            $pdfController = new PdfController();
            return $pdfController->printLaporanSpt($tgl_awal, $tgl_akhir, $lap_spt);
        }

        return view('pages.laporan.lap_spt', compact('lap_spt', 'tgl_awal', 'tgl_akhir'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // SPPD
    public function lap_sppd(Request $request)
    {
        $lap_sppd = Sppd::query();

        $tgl_awal = null;
        $tgl_akhir = null;

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tgl_awal = $request->input('tgl_awal');
            $tgl_akhir = $request->input('tgl_akhir');
            $lap_sppd->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir]);
        } else {
            $tgl_awal = now()->format('2023-03-01');
            $tgl_akhir = now()->format('Y-m-d');
            $lap_sppd->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir]);
        }

        $search = $request->input('search');
        if (!empty($search)) {
            $lap_sppd->where(function ($query) use ($search) {
                $query->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhere('pejabat_diperintah', 'like', '%' . $search . '%')
                    ->orWhere('maksud_perintah', 'like', '%' . $search . '%')
                    ->orWhere('tempat_tujuan', 'like', '%' . $search . '%');
            });
        }

        $lap_sppd = $lap_sppd->get();

        if ($request->has('print')) {
            // Panggil fungsi untuk generate file PDF
            $pdfController = new PdfController();
            return $pdfController->printLaporanSppd($tgl_awal, $tgl_akhir, $lap_sppd);
        }

        return view('pages.laporan.lap_sppd', compact('lap_sppd', 'tgl_awal', 'tgl_akhir'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


}
