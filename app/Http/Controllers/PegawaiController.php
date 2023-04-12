<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Instansi;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(10);

        return view('admin.pages.pegawai', compact('pegawai'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.pegawai.create');
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
            'name' => 'required|min:1',
            'nip' => 'required',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'eselon' => 'required',
        ]);
        Pegawai::create($request->all());

        return redirect()->route('admin.pegawai.index')
            ->with('toast_success', 'Data Pegawai Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return view('admin.pages.pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('admin.pages.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'name' => 'required|min:1',
            'nip' => 'required',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'eselon' => 'required',
        ]);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')
            ->with('toast_success', 'Data Pegawai Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pegawai $pegawai)
    // {
    //     $pegawai->delete();
    //     return redirect()->route('pegawai.index')
    //         ->with('toast_success', 'Data Pegawai Berhasil Dihapus');
    // }
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $isKabidKDCP = Instansi::where('kabid_KDCP', $id)->exists();
        $isKepala = Instansi::where('kepala_dinas', $id)->exists();
        $isSekretaris = Instansi::where('sekretaris', $id)->exists();
        $isKabidKKP = Instansi::where('kabid_KKP', $id)->exists();

        if ($isKabidKDCP || $isKepala || $isSekretaris || $isKabidKKP) {
            return redirect()->back()->with('toast_error', 'Pegawai tidak dapat dihapus karena merupakan Petinggi Instansi.');
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('toast_success', 'Data Pegawai berhasil dihapus.');
    }
}
