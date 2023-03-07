@extends('index')
@section('title', 'Edit Data Pegawai')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Edit Data Pegawai</h4>
                        </div>
                        <div>
                            <a href="{{ route('pegawai.index') }}">
                                <button type="button" class="btn btn-dark">
                                    <i class="mdi mdi-arrow-left"></i>
                                </button>
                            </a>
                        </div>
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
                        <form class="forms-sample" action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $pegawai->name }}" placeholder="Tulis Nama Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="id">NIP</label>
                                <input type="text" class="form-control" name="id" id="id" value="{{ $pegawai->id }}" placeholder="Tulis NIP Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $pegawai->jabatan }}" placeholder="Tulis Jabatan Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="pangkat">Pangkat</label>
                                <input type="text" class="form-control" name="pangkat" id="pangkat" value="{{ $pegawai->pangkat }}" placeholder="Tulis Pangkat Pegawai">
                            </div>
                            <div class="form-group">
                                <label for="golongan">Golongan</label>
                                <input type="text" class="form-control" name="golongan" id="golongan" value="{{ $pegawai->golongan }}" placeholder="Tulis Golongan Pegawai">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary me-2">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection