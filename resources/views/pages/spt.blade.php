@extends('index')
@section('title', 'Daftar Data SPT')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title">Daftar Data SPT</h4>
            </div>
            @guest()
            @else
            <div>
                <a href="{{ route('spt.create') }}">
                    <button type="button" class="btn btn-success btn-md">
                        Tambah Data
                    </button>
                </a>
            </div>
            @endguest
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered" id="table_spt">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Dasar Perintah</th>
                        <th>Pegawai yang Diperintah</th>
                        <th>Maksud Tugas</th>
                        <th>Tanggal Pergi</th>
                        <th>Tanggal Kembali</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Tempat Ditetapkan</th>
                        <th>Tanggal Ditetapkan</th>
                        <th>Yang Menetapkan</th>
                        @guest()
                        @else
                        <th width=135px>Aksi</th>
                        @endguest
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spt as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nomor_surat }}</td>
                        <td>{{ $s->dasar_perintah }}</td>
                        <td>
                            @foreach ($s->diperintah()->get() as $diperintah)
                            <div>{{ $loop->iteration }}. {{ $diperintah->name }} - {{ $diperintah->nip }}</div>
                            @endforeach
                        </td>
                        <td>{{ $s->maksud_tugas }}</td>
                        <td>{{ $s->tgl_pergi }}</td>
                        <td>{{ $s->tgl_kembali }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>{{ $s->tempat }}</td>
                        <td>{{ $s->tempat_ditetapkan }}</td>
                        <td>{{ $s->tgl_ditetapkan }}</td>
                        <td>{{ $s->menetapkan->name }}</td>
                        @guest()
                        @else
                        <td class="text-center flex flex-row">
                            <form action="{{ route('spt.destroy', $s->id) }}" method="POST">
                                <a href="/pdf1/{{ $s->id }}" id="btn-show-spt" data-id="{{ $s->id }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                                <a href="{{ route('spt.edit', $s->id) }}" id="btn-edit-spt" data-id="{{ $s->id }}" class="btn btn-warning btn-sm"><i class="mdi mdi-tooltip-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></button>
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