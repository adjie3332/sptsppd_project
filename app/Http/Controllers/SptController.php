<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Spt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spt = Spt::all();
        return view('pages.spt', compact('spt'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spt = Pegawai::with(['menetapkanpt'])->get();
        // dd($spt);
        return view('pages.spt.create', ['spt' => $spt]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // $user = Auth::user();
    // $request->merge(['users' => $user->id]);

    $request->validate([
        'nomor_surat' => 'nullable',
        'dasar_perintah' => 'nullable',
        'maksud_tugas' => 'required',
        'tgl_pergi' => 'required',
        'tgl_kembali' => 'required',
        'waktu' => 'required',
        'tempat' => 'required',
        'tempat_ditetapkan' => 'required',
        'tgl_ditetapkan' => 'required',
        'yang_menetapkan' => 'required',
        'user_id' => 'required',
    ]);

    // dd($request->all());
    $nama_diperintah = $request->diperintah;
    $tgl_pergi = $request->tgl_pergi;
    $tgl_kembali = $request->tgl_kembali;

    // Cek apakah nama dan tanggal perintah sudah ada di database
    $existingSpt = Spt::whereHas('diperintah', function ($query) use ($request) {
        $query->whereIn('pegawai_id', $request->diperintah);
    })
    ->where(function ($query) use ($request) {
        $query->whereBetween('tgl_pergi', [$request->tgl_pergi, $request->tgl_kembali])
              ->orWhereBetween('tgl_kembali', [$request->tgl_pergi, $request->tgl_kembali])
              ->orWhere(function ($query) use ($request) {
                  $query->where('tgl_pergi', '<=', $request->tgl_pergi)
                        ->where('tgl_kembali', '>=', $request->tgl_kembali);
              });
    })->first();

    // Jika sudah ada, berikan alert dan kembalikan ke halaman sebelumnya
    if ($existingSpt) {
        session()->flash('toast_error', 'Nama telah diperintahkan pada tanggal yang sama!');
        return redirect()->back();
    }

    // Jika belum ada, simpan data ke database
    $spt = Spt::updateOrCreate([
        'nomor_surat' => $request->nomor_surat,
        'dasar_perintah' => $request->dasar_perintah,
        'maksud_tugas' => $request->maksud_tugas,
        'tgl_pergi' => $request->tgl_pergi,
        'tgl_kembali' => $request->tgl_kembali,
        'waktu' => $request->waktu,
        'tempat' => $request->tempat,
        'tempat_ditetapkan' => $request->tempat_ditetapkan,
        'tgl_ditetapkan' => $request->tgl_ditetapkan,
        'yang_menetapkan' => $request->yang_menetapkan,
        'user_id' => $request->user_id,
    ]);
    $spt->diperintah()->sync($request->diperintah);

    return redirect()->route('spt.index')
        ->with('toast_success', 'Data SPT Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spt  $spt
     * @return \Illuminate\Http\Response
     */
    public function show(Spt $spt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spt  $spt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spt = Spt::findOrFail($id);
        $pegawai = Pegawai::with('menetapkanpt')->get();

        // dd($pegawai);
        return view('pages.spt.edit', ['spt' => $spt, 'pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spt  $spt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $spt = Spt::findOrFail($id);
        $spt->diperintah()->sync($request->diperintah);
        $spt->update($request->all());

        return redirect()->route('spt.index')
            ->with('toast_success', 'Data SPT Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spt  $spt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spt = Spt::findOrFail($id);
        $spt->diperintah()->sync([]);
        $spt->delete();

        return redirect()->route('spt.index')
            ->with('toast_success', 'Data SPT Berhasil Dihapus');
    }


    // /**
    //  * Determine if the given option is the currently selected option.
    //  *
    //  * @param  string  $option
    //  * @return bool
    //  */
    // public function isSelected($option)
    // {
    //     $option === $this->selected;
    // }
}
