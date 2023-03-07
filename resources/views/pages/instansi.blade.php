@extends('index')
@section('title', 'Data Instansi')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card ">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Data Instansi</h4>
                </div>
                <div>
                    @guest()
                    @else
                        <a href="">
                            <button type="button" class="btn btn-success btn-md">
                                Ubah Data
                            </button>
                        </a>
                    @endguest
                </div>
            </div>
            <div class="mt-3">
                <form class="forms-sample" action="{{ route('instansi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label for="nama">Nama Instansi</label>
                            <input type="text" class="form-control" name="name" id="name" value="Dinas Ketahanan Pangan" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="Jl. Nusantara No. 1" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon" value="(0276) 325174" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website" id="website" value="www.ketahananpangan.boyolali.go.id" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="faks">Faksimile</label>
                                <input type="text" class="form-control" name="faks" id="faks" value="(0276) 325174" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="dkp@boyolali.go.id" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kodepos">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" id="kodepos" value="57312" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kepala_dinas">Kepala Dinas</label>
                                <input type="text" class="form-control" name="kepala_dinas" id="kepala_dinas" value="Ir. Joko Suhartono, M.Si." disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kepala_bidang">Sekretaris</label>
                                <input type="text" class="form-control" name="kepala_bidang" id="kepala_bidang" value="Drs. Sabarudin, SH. MM." disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pejabat_pelaksana">Kabid Konsumsi dan Keamanan Pangan</label>
                                <input type="text" class="form-control" name="pejabat_pelaksana" id="pejabat_pelaksana" value="Ir. Wiwit Soco Widawati" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="bendahara">Kabid Ketersediaan, Distribusi & Cadangan Pangan</label>
                                <input type="text" class="form-control" name="bendahara" id="bendahara" value="Drh. Dhian Mujiwiyati" disabled>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection