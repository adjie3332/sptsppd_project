<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pegawai;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biaya = Biaya::all();
        return view('pages.biaya', compact('biaya'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $biaya = Pegawai::all();
        // dd($biaya);
        return view('pages.biaya.create', ['biaya' => $biaya]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'kegiatan' => 'required',
        //     'lokasi' => 'required',
        //     'hari_tgl' => 'required',
        //     'rekening' => 'required',
        //     'moreFields.*.uang_harian' => 'required',
        //     'moreFields.*.uang_transport' => 'required',
        //     'moreFields.*.biaya_transport' => 'required',
        // ]);

        // // dd($request->all());
        // $biaya = Biaya::updateOrCreate([
        //     'kegiatan' => $request->kegiatan,
        //     'lokasi' => $request->lokasi,
        //     'hari_tgl' => $request->hari_tgl,
        //     'rekening' => $request->rekening,
        //     'moreFields.*.uang_harian' => $request->uang_harian,
        //     'moreFields.*.uang_transport' => $request->uang_transport,
        //     'moreFields.*.biaya_transport' => $request->biaya_transport,
        // ]);

        // foreach ($request->moreFields as $key => $value) {
        //     Biaya::create($value);
        // }
        // $biaya->pegawaib()->sync($request->pegawaib);
        // return redirect()->route('biaya.index')
        //     ->with('toast_success', 'Data Biaya Berhasil Ditambahkan');

        $rules = [];


        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {


            foreach($request->input('name') as $key => $value) {
                Biaya::create(['name'=>$value]);
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function show(Biaya $biaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $biaya = Biaya::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('pages.biaya.edit', ['biaya' => $biaya, 'pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biaya $biaya)
    {
        $biaya->pegawaib()->sync($request->pegawaib);
        $biaya->update($request->all());
        return redirect()->route('biaya.index')
            ->with('toast_success', 'Data Biaya Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biaya = Biaya::find($id);
        $biaya->pegawaib()->sync([]);
        $biaya->uang_harian()->sync([]);
        $biaya->uang_transport()->sync([]);
        $biaya->biaya_transport()->sync([]);
        $biaya->delete();

        return redirect()->route('biaya.index')
            ->with('toast_success', 'Data Biaya Berhasil Dihapus');
    }
}
