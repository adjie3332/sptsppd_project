@extends('admin.index')
@section('title', 'Data Instansi')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card ">
        <div class="card-body">
            @foreach ($instansi as $i)
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Data Instansi</h4>
                </div>
                <div>
                    @guest()
                    @else
                        <a href="{{ route('instansi-admin.edit', $i->id) }}" id="btn-edit-instansi" data-id="{{ $i->id }}">
                            <button type="button" class="btn btn-success btn-md">
                            <i class="mdi mdi-update"></i>
                                Ubah Data
                            </button>
                        </a>
                    @endguest
                </div>
            </div>
            <div class="mt-3">
                <form class="forms-sample" action="{{ route('instansi-admin.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label for="nama">Nama Instansi</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $i->nama }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $i->alamat }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon" value="{{ $i->telepon }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website" id="website" value="{{ $i->website }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="faks">Faksimile</label>
                                <input type="text" class="form-control" name="faks" id="faks" value="{{ $i->faksimile }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $i->email }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kodepos">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" id="kodepos" value="{{ $i->kodepos }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kepala_dinas">Kepala Dinas</label>
                                @foreach ($pegawai as $p)
                                    @if ($p->id == $i->kepala_dinas)
                                        <input type="text" class="form-control" name="kepala_dinas" id="kepala_dinas" value="{{ $p->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sekretaris">Sekretaris</label>
                                @foreach ($pegawai as $p)
                                    @if ($p->id == $i->sekretaris)
                                        <input type="text" class="form-control" name="sekretaris" id="sekretaris" value="{{ $p->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kabid_KKP">Kabid Konsumsi dan Keamanan Pangan</label>
                                @foreach ($pegawai as $p)
                                    @if ($p->id == $i->kabid_KKP)
                                        <input type="text" class="form-control" name="kabid_KKP" id="kabid_KKP" value="{{ $p->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kabid_KDCP">Kabid Ketersediaan, Distribusi & Cadangan Pangan</label>
                                @foreach ($pegawai as $p)
                                    @if ($p->id == $i->kabid_KDCP)
                                        <input type="text" class="form-control" name="kabid_KDCP" id="kabid_KDCP" value="{{ $p->name }}" disabled>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
