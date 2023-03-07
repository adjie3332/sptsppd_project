@extends('index')
@section('title', 'Daftar Data SPPD')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Daftar Data SPPD</h4>
                </div>
                @guest()
                @else
                    <div>
                        <a href="{{ route('sppd.create') }}">
                            <button type="button" class="btn btn-success btn-md">
                                Tambah Data
                            </button>
                        </a>
                    </div>
                @endguest
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered" id="table_sppd">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Pejabat Pemberi Perintah</th>
                            <th rowspan="2">Pegawai yang Diperintah</th>
                            <th rowspan="2">Maksud Perjalanan Dinas</th>
                            <th rowspan="2">Transportasi</th>
                            <th rowspan="2">Tempat Berangkat</th>
                            <th rowspan="2">Tempat Tujuan</th>
                            <th rowspan="2">Tgl. Pergi</th>
                            <th rowspan="2">Tgl. Kembali</th>
                            <th rowspan="2">Pengikut - NIP</th>
                            <th colspan="2">Pembebanan Anggaran</th>
                            <th rowspan="2">Keterangan</th>
                            @guest()
                            @else
                                <th rowspan="2" width=135px>Aksi</th>
                            @endguest
                        </tr>
                        <tr>
                            <th>Instansi</th>
                            <th>Mata Anggaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sppd as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->pejabat_pemerintahh->name }}</td>
                                <td>{{ $s->pejabat_diperintahh->name }}</td>
                                <td>{{ $s->maksud_perintah }}</td>
                                <td>{{ $s->transportasi }}</td>
                                <td>{{ $s->tempat_berangkat }}</td>
                                <td>{{ $s->tempat_tujuan }}</td>
                                <td>{{ $s->tgl_pergi }}</td>
                                <td>{{ $s->tgl_kembali }}</td>
                                <td>
                                    @foreach ($s->pengikut()->get() as $pengikut)
                                        <div>{{ $loop->iteration }}. {{ $pengikut->name }} - {{ $pengikut->nip }}</div>
                                    @endforeach
                                </td>
                                <td>{{ $s->instansi }}</td>
                                <td>{{ $s->mata_anggaran }}</td>
                                <td>{{ $s->keterangan }}</td>
                                @guest()
                                @else
                                    <td class="text-center flex flex-row">
                                        <form action="{{ route('sppd.destroy', $s->id) }}" method="POST">
                                            <a href="/pdf2/{{ $s->id }}" id="btn-show-sppd" data-id="{{ $s->id }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                                            <a href="{{ route('sppd.edit', $s->id) }}" id="btn-edit-sppd" data-id="{{ $s->id }}" class="btn btn-warning btn-sm"><i class="mdi mdi-tooltip-edit"></i></a>
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