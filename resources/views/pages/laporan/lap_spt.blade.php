@extends('index')
@section('title', 'Laporan Data SPT')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Laporan Data SPT</h4>
                </div>
                @guest()
                @else
                    <div>
                        <form action="{{ route('laporan.lap_spt') }}" method="GET" class="d-flex">
                            <input type="text" name="search" placeholder="Cari data..." class="form-control me-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form><br>
                            <a href="{{ route('laporan.lap_spt') }}" class="btn btn-warning btn-md">
                                <i class="mdi mdi-refresh"></i>
                                Refresh
                            </a>
                            <button type="button" class="btn btn-success btn-md" data-bs-toggle=modal data-bs-target=#modalFilter >
                                <i class="mdi mdi-filter"></i>
                                Filter Data
                            </button>
                                <a href="{{ route('laporan.lap_spt', ['tgl_awal' => request()->input('tgl_awal'), 'tgl_akhir' => request()->input('tgl_akhir'), 'print' => true]) }}" target="_blank" class="btn btn-primary btn-md">
                                    <i class="mdi mdi-printer"></i>
                                    Print
                                </a>
                    </div>
                @endguest
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered" id="table_lap_spt">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Ditetapkan</th>
                            <th>Nomor Surat</th>
                            <th>Pegawai yang Diperintah</th>
                            <th>Maksud Tugas</th>
                            <th>Tanggal Pergi</th>
                            <th>Tanggal Kembali</th>
                            <th>Tempat</th>
                            <th>Pembuat Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lap_spt as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->tgl_ditetapkan }}</td>
                                <td>{{ $s->nomor_surat }}</td>
                                <td>
                                    @foreach ($s->diperintah()->get() as $diperintah)
                                        <div>{{ $loop->iteration }}. {{ $diperintah->name }}</div>
                                    @endforeach
                                </td>
                                <td>{{ $s->maksud_tugas }}</td>
                                <td>{{ $s->tgl_pergi }}</td>
                                <td>{{ $s->tgl_kembali }}</td>
                                <td>{{ $s->tempat }}</td>
                                <td>
                                    @if ($s->user_id)
                                        <i class="mdi mdi-account-edit"></i>{{ $s->user->name }}
                                    @else
                                        User tidak ditemukan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modalFilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Data SPT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laporan.lap_spt') }}" method="get">
                            <div class="form-group">
                                <label for="tgl_awal">Tanggal awal</label>
                                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tgl_akhir">Tanggal akhir</label>
                                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- @include('sweetalert::alert') -->
@endsection
