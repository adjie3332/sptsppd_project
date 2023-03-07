@extends('index')
@section('title', 'Dashboard')
@section('content')
    <div class="row flex-grow">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-primary card-rounded">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title card-title-dash text-white mb-4">Data SPPD</h4>
                            <p class="text-light mb-1">Jumlah Data SPPD</p>
                            <h2 class="text-light">{{ $sppd }}</h2>
                        </div>
                        <div class="col align-self-center">
                            <a href="{{ route('sppd.index') }}">
                                <button type="button" class="btn btn-outline-dark btn-icon-text btn-lg">
                                    <i class="ti-file btn-icon-prepend"></i>
                                    LIHAT
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-danger card-rounded">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title card-title-dash text-white mb-4">Data SPT</h4>
                            <p class="text-light mb-1">Jumlah Data SPT</p>
                            <h2 class="text-light">{{ $spt }}</h2>
                        </div>
                        <div class="col align-self-center">
                            <a href="{{ route('spt.index') }}">
                                <button type="button" class="btn btn-outline-dark btn-icon-text btn-lg">
                                    <i class="ti-file btn-icon-prepend"></i>
                                    LIHAT
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row flex-grow">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-success card-rounded">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title card-title-dash text-white mb-4">Data Penerimaan Uang
                            </h4>
                            <p class="text-light mb-1">Jumlah Data Penerimaan Uang</p>
                            <h2 class="text-light">{{ $biaya }}</h2>
                        </div>
                        <div class="col align-self-center">
                            <a href="{{ route('biaya.index') }}">
                                <button type="button" class="btn btn-outline-dark btn-icon-text btn-lg">
                                    <i class="ti-file btn-icon-prepend"></i>
                                    LIHAT
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-warning card-rounded">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title card-title-dash text-dark mb-4">Data Pegawai</h4>
                            <p class="status-summary-ight-white mb-1">Jumlah Data Pegawai</p>
                            <h2 class="text-dark">{{ $pegawai }}</h2>
                        </div>
                        <div class="col align-self-center">
                            <a href="{{ route('pegawai.index') }}">
                                <button type="button" class="btn btn-outline-dark btn-icon-text btn-lg">
                                    <i class="ti-file btn-icon-prepend"></i>
                                    LIHAT
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection