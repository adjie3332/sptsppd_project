@extends('admin.index')
@section('title', 'Edit Data Instansi')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Edit Data Instansi</h4>
                        </div>
                        {{-- <div>
                            @guest()
                            @else
                                <a href="{{ route('instansi-admin.index') }}">
                                    <button type="button" class="btn btn-dark">
                                        <i class="mdi mdi-arrow-left"></i>
                                    </button>
                                </a>
                            @endguest
                        </div> --}}
                    </div>
                    <div class="mt-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="forms-sample" action="{{ route('instansi-admin.update', $instansi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group">
                                    <label for="nama">Nama Instansi</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $instansi->nama }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $instansi->alamat }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" name="telepon" id="telepon" value="{{ $instansi->telepon }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control" name="website" id="website" value="{{ $instansi->website }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="faksimile">Faksimile</label>
                                        <input type="text" class="form-control" name="faksimile" id="faksimile" value="{{ $instansi->faksimile }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="{{ $instansi->email }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kodepos">Kode Pos</label>
                                        <input type="text" class="form-control" name="kodepos" id="kodepos" value="{{ $instansi->kodepos }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kepala_dinas">Kepala Dinas</label>
                                        <select class="js-example-basic-multiple w-100" name="kepala_dinas" id="kepala_dinas">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($pegawai as $s)
                                                <option {{ $s->id == $instansi->kepala_dinas ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sekretaris">Sekretaris</label>
                                        <select class="js-example-basic-multiple w-100" name="sekretaris" id="sekretaris">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($pegawai as $s)
                                                <option {{ $s->id == $instansi->sekretaris ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kabid_KKP">Kabid Konsumsi dan Keamanan Pangan</label>
                                        <select class="js-example-basic-multiple w-100" name="kabid_KKP" id="kabid_KKP">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($pegawai as $s)
                                                <option {{ $s->id == $instansi->kabid_KKP ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kabid_KDCP">Kabid Ketersediaan, Distribusi & Cadangan Pangan</label>
                                        <select class="js-example-basic-multiple w-100" name="kabid_KDCP" id="kabid_KDCP">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($pegawai as $s)
                                                <option {{ $s->id == $instansi->kabid_KDCP ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary me-2">Ubah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
