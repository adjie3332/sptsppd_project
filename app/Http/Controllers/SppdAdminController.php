<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Sppd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppdAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sppd = Sppd::all();
        return view('admin.pages.sppd', compact('sppd'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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
        return view('admin.pages.sppd.create', ['sppd' => $sppd]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user_id = auth()->user()->id;

        // $data = $request->all();
        // $data['user_id'] = $user_id;

        // $request->merge($data);

        $request->validate([
            'nomor_surat' => 'nullable',
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
            'keterangan' => 'nullable',
            'tgl_keluar' => 'required',
            'tempat_tujuan_1' => 'nullable',
            'tgl_tiba_1' => 'nullable',
            'tgl_berangkat_dari_1' => 'nullable',
            'tempat_tujuan_2' => 'nullable',
            'tgl_tiba_2' => 'nullable',
            'tgl_berangkat_dari_2' => 'nullable',
            'tempat_tujuan_3' => 'nullable',
            'tgl_tiba_3' => 'nullable',
            'tgl_berangkat_dari_3' => 'nullable',
            'user_id' => 'required',
        ]);

        // dd($request->all());
        $sppd = Sppd::updateOrCreate([
            'nomor_surat' => $request->nomor_surat,
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
            'tgl_keluar' => $request->tgl_keluar,
            'tempat_tujuan_1' => $request->tempat_tujuan_1,
            'tgl_tiba_1' => $request->tgl_tiba_1,
            'tgl_berangkat_dari_1' => $request->tgl_berangkat_dari_1,
            'tempat_tujuan_2' => $request->tempat_tujuan_2,
            'tgl_tiba_2' => $request->tgl_tiba_2,
            'tgl_berangkat_dari_2' => $request->tgl_berangkat_dari_2,
            'tempat_tujuan_3' => $request->tempat_tujuan_3,
            'tgl_tiba_3' => $request->tgl_tiba_3,
            'tgl_berangkat_dari_3' => $request->tgl_berangkat_dari_3,
            'user_id' => $request->user_id,
        ]);

        // $sppd->pengikut()->sync($request->pengikut);

        if ($sppd) {
            return redirect()->route('sppd.index')
                ->with('toast_success', 'SPPD berhasil ditambahkan');
        } else {
            return redirect()->route('sppd.index')
                ->with('toast_error', 'SPPD gagal disimpan');
        }
        // return redirect()->route('sppd.index')
        //     ->with('toast_success', 'Data SPPD Berhasil Ditambahkan');
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
        return view('admin.pages.sppd.edit', ['sppd' => $sppd, 'pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sppd  $sppd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $sppd = Sppd::findorFail($id);
        $sppd->pengikut()->sync($request->pengikut);
        $sppd->update($request->all());

        return redirect()->route('sppd-admin.index')
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

        return redirect()->route('sppd-admin.index')
            ->with('toast_success', 'Data Sppd Berhasil Dihapus');
    }
}
