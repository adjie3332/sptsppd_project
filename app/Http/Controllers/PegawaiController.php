<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
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

        return view('pages.pegawai', compact('pegawai'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pegawai.create');
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
            'nip' => 'required| unique:pegawais',
            'name' => 'required|min:6',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
        ]);
        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')
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
        return view('pages.pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pages.pegawai.edit', compact('pegawai'));
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
            'nip' => 'required',
            'name' => 'required|min:6',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
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
        Pegawai::find($id)->delete();
        return redirect()->route('pegawai.index')
            ->with('toast_success', 'Data Pegawai Berhasil Dihapus');
    }
}
