@extends('index')
@section('title', 'Daftar Data Pegawai')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Daftar Data Pegawai</h4>
                </div>
                <div>
                    @guest()
                    @else
                        <a href="{{ route('pegawai.create') }}">
                            <button type="button" class="btn btn-success btn-md">
                                Tambah Data
                            </button>
                        </a>
                    @endguest
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered" id="pegawai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            @guest()
                            @else
                                <th width=135px>Aksi</th>
                            @endguest
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($pegawai as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nip }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td>{{ $p->pangkat }}</td>
                            <td>{{ $p->golongan }}</td>
                            @guest()
                            @else
                                <td class="text-center flex flex-row">
                                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST">
                                        <a href="{{ route('pegawai.edit', $p->id) }}" id="btn-edit-pegawai" data-id="{{ $p->id }}" class="btn btn-warning btn-sm"><i class="mdi mdi-tooltip-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                </td>
                            @endguest
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                {!! $pegawai->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection