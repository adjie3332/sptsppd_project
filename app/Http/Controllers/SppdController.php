<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Sppd;
use Illuminate\Http\Request;

class SppdController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sppd = Sppd::all();
        return view('pages.sppd', compact('sppd'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sppd()
    {
        $sppd = Sppd::all();
        return $sppd;
    }

    public function create()
    {
        $sppd = Pegawai::with(['pemerintahpd', 'diperintahpd'])->get();
        return view('pages.sppd.create', ['sppd' => $sppd]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'maksud_perintah' => 'required',
            'transportasi' => 'required',
            'tempat_berangkat' => 'required',
            'tempat_tujuan' => 'required',
            'tgl_pergi' => 'required',
            'tgl_kembali' => 'required',
            'pejabat_pemerintah' => 'required',
            'pejabat_diperintah' => 'required',
            'instansi' => 'required',
            'mata_anggaran' => 'required',
        ]);

        // dd($request->all());
        $sppd = Sppd::updateOrCreate([
            'maksud_perintah' => $request->maksud_perintah,
            'transportasi' => $request->transportasi,
            'tempat_berangkat' => $request->tempat_berangkat,
            'tempat_tujuan' => $request->tempat_tujuan,
            'tgl_pergi' => $request->tgl_pergi,
            'tgl_kembali' => $request->tgl_kembali,
            'pejabat_pemerintah' => $request->pejabat_pemerintah,
            'pejabat_diperintah' => $request->pejabat_diperintah,
            'instansi' => $request->instansi,
            'mata_anggaran' => $request->mata_anggaran,
            'keterangan' => $request->keterangan,
        ]);

        $sppd->pengikut()->sync($request->pengikut);

        return redirect()->route('sppd.index')
            ->with('toast_success', 'Data SPPD Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sppd  $sppd
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sppd  $sppd
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sppd = Sppd::findOrFail($id);
        $pegawai = Pegawai::with(['pemerintahpd', 'diperintahpd'])->get();
        // dd($pegawai);
        return view('pages.sppd.edit', ['sppd' => $sppd, 'pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sppd  $sppd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sppd $sppd)
    {
        // $request->validate([
        //     'maksud_perintah' => 'required',
        //     'transportasi' => 'required|min:6',
        //     'tempat_berangkat' => 'required',
        //     'tempat_tujuan' => 'required',
        //     'tgl_pergi' => 'required',
        //     'tgl_kembali' => 'required',
        //     'pejabat_pemerintah' => 'required',
        //     'pejabat_diperintah' => 'required',
        //     'instansi' => 'required',
        //     'mata_anggaran' => 'required',
        // ]);
        $sppd->pengikut()->sync($request->pengikut);
        $sppd->update($request->all());

        return redirect()->route('sppd.index')
            ->with('toast_success', 'Data Sppd Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sppd  $sppd
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sppd = Sppd::find($id);
        $sppd->pengikut()->sync([]);
        $sppd->delete();

        return redirect()->route('sppd.index')
            ->with('toast_success', 'Data Sppd Berhasil Dihapus');
    }
}
