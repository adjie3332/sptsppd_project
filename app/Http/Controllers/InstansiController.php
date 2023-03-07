<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::latest()->paginate(10);
        return view('pages.instansi', compact('instansi'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansi = Pegawai::with(['kepala_dinass', 'pejabat_pelaksanaa', 'bendaharaa'])->get();
        // dd($instansi);
        return view('pages.instansi.create', ['instansi' => $instansi]);
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
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'faksimile' => 'required',
            'website' => 'required',
            'email' => 'required',
            'kodepos' => 'required',
            'kepala_dinas' => 'required',
            'pejabat_pelaksana' => 'required',
            'bendahara' => 'required',
        ]);
        Instansi::create($request->all());

        return redirect()->route('instansi.index')
            ->with('toast_success', 'Data Pegawai Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        return view('pages.instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        $pegawai = Pegawai::with(['kepala_dinass', 'pejabat_pelaksanaa', 'bendaharaa'])->get();
        return view('pages.instansi.edit', ['instansi' => $instansi, 'pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'faksimile' => 'required',
            'website' => 'required',
            'email' => 'required',
            'kodepos' => 'required',
            'kepala_dinas' => 'required',
            'pejabat_pelaksana' => 'required',
            'bendahara' => 'required',
        ]);
        $instansi->update($request->all());

        return redirect()->route('instansi.index')
            ->with('toast_success', 'Data Instansi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Instansi::find($id)->delete();
        return redirect()->route('instansi.index')
            ->with('toast_success', 'Data Pegawai Berhasil Dihapus');
    }
}
