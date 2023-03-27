@extends('index')
@section('title', 'Laporan Data SPPD')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Laporan Data SPPD</h4>
                </div>

                @guest()
                @else
                    <div>
                            <button type="button" class="btn btn-success btn-md" data-bs-toggle=modal data-bs-target=#modalFilter >
                                <i class="mdi mdi-filter"></i>
                                Filter Data
                            </button>
                            <a type="button" class="btn btn-primary btn-md" href="">
                                <i class="mdi mdi-printer"></i>
                                Print
                            </a>
                    </div>
                @endguest
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered" id="table_lap_sppd">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Tanggal Dikeluarkan</th>
                            <th rowspan="2" >Nomor Surat</th>
                            <th rowspan="2">Pegawai yang Diperintah</th>
                            <th rowspan="2">Maksud Perjalanan Dinas</th>
                            <th rowspan="2">Tempat Tujuan</th>
                            <th rowspan="2">Tgl. Pergi</th>
                            <th rowspan="2">Tgl. Kembali</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($lap_sppd as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->tgl_keluar }}</td>
                                    <td>{{ $s->nomor_surat }}</td>
                                    <td>{{ $s->pejabat_diperintahh->name }}</td>
                                    <td>{{ $s->maksud_perintah }}</td>
                                    <td>{{ $s->tempat_tujuan }}</td>
                                    <td>{{ $s->tgl_pergi }}</td>
                                    <td>{{ $s->tgl_kembali }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <div class="modal fade" id="modalFilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Filter Data SPPD</h5>
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
    </div>
    @include('sweetalert::alert')
@endsection
