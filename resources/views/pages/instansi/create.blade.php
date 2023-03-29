@extends('index')
@section('title', 'Data Instansi')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Data Instansi</h4>
                        </div>
                        <div>
                            @guest()
                            @else
                                <a href="{{ route('instansi.index') }}" class="btn btn-success btn-md">
                                    <i class="mdi mdi-tooltip-edit"></i>
                                </a>
                            @endguest
                        </div>
                    </div>
                    <div class="mt-3">
                        <form class="forms-sample" action="{{ route('instansi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Instansi</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Dinas Ketahanan Pangan" disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    placeholder="Jl. Nusantara No. 1" disabled>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon"
                                    placeholder="(0276) 325174" disabled>
                            </div>
                            <div class="form-group">
                                <label for="faks">Faksimile</label>
                                <input type="text" class="form-control" name="faks" id="faks"
                                    placeholder="(0276) 325174" disabled>
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website" id="website"
                                    placeholder="www.ketahananpangan.boyolali.go.id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="dkpo@boyolali.go.id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="kodepos">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" id="kodepos" placeholder="57312"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="kepala_dinas">Kepala Dinas</label>
                                <select class="js-example-basic-multiple w-100" name="kepala_dinas" id="kepala_dinas">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach ($instansi as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sekretaris">Sekretaris</label>
                                <select class="js-example-basic-multiple w-100" name="sekretaris"
                                    id="sekretaris">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach ($instansi as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabid_KKP">Kabid Konsumsi dan Keamanan Pangan</label>
                                <select class="js-example-basic-multiple w-100" name="kabid_KKP" id="kabid_KKP">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach ($instansi as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabid_KDCP">Kabid Ketersediaan, Distribusi & Cadangan Pangan</label>
                                <select class="js-example-basic-multiple w-100" name="kabid_KDCP" id="kabid_KDCP">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach ($instansi as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
