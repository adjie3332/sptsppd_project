@extends('index')
@section('title', 'Daftar Data Biaya')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Daftar Data Biaya</h4>
                </div>
                <div>
                    <a href="{{ route('biaya.create') }}">
                        <button type="button" class="btn btn-success btn-md">
                            Tambah Data
                        </button>
                    </a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered" id="table_sppd">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Nama Pegawai</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Kode Rekening</th>
                            <th>Uang Harian</th>
                            <th>Uang Transport</th>
                            <th>Biaya Transport</th>
                            <th>Penerimaan</th>
                            @guest()
                            @else
                                <th width=135px>Aksi</th>
                            @endguest
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biaya as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->kegiatan }}</td>
                                {{-- <td>{{ $s->namaa->name }} - {{ $s->namaa->nip }}</td> --}}
                                <td>{{ $s->lokasi }}</td>
                                <td>{{ $s->hari_tgl }}</td>
                                <td>{{ $s->rekening }}</td>
                                <td>@currency($s->uang_harian)</td>
                                <td> @currency($s->uang_transport)</td>
                                <td> @currency($s->biaya_transport)</td>
                                <td>@currency($s->uang_harian + $s->uang_transport + $s->biaya_transport)</td>
                                @guest()
                                @else
                                    <td class="text-center flex flex-row">
                                        <form action="{{ route('biaya.destroy', $s->id) }}" method="POST">
                                            <a href="/pdf3/{{ $s->id }}" id="btn-show-biaya" data-id="{{ $s->id }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                                            <a href="{{ route('biaya.edit', $s->id) }}" id="btn-edit-biaya" data-id="{{ $s->id }}" class="btn btn-warning btn-sm"><i class="mdi mdi-tooltip-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger  btn-sm"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                    </td>
                                @endguest
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection