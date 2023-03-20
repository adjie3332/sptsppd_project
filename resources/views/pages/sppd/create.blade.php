@extends('index')
@section('title', 'Tambah Data SPPD')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Tambah Data SPPD</h4>
                        </div>
                        <div>
                            <a href="{{ route('sppd.index') }}">
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
                        <form id="form-sppd" class="forms-sample" action="{{ route('sppd.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat</label>
                                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Tulis Nomor Surat">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pejabat_pemerintah">Pejabat Pemberi Perintah</label>
                                        <select class="js-example-basic-multiple w-100 form-control" name="pejabat_pemerintah" id="pejabat_pemerintah">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($sppd as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_berangkat">Tempat Berangkat</label>
                                        <input type="text" class="form-control" id="tempat_berangkat" name="tempat_berangkat" value="DKP Kab. Boyolali" placeholder="Tulis Tempat Keberangkatan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_pergi">Tanggal Pergi</label>
                                        <input type="date" class="form-control" id="tgl_pergi" name="tgl_pergi" placeholder="Pilih Tanggal Kepergian">
                                    </div>
                                    <div class="form-group">
                                        <label for="maksud_perintah">Maksud Perjalanan Dinas</label>
                                        <input type="text" class="form-control" id="maksud_perintah" name="maksud_perintah" placeholder="Tulis Maksud Perjalanan Dinas">
                                    </div>
                                    <div class="form-group">
                                        <label for="transportasi">Transportasi</label>
                                        <input type="text" class="form-control" id="transportasi" name="transportasi" placeholder="Tulis Transportasi yang Digunakan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_keluar">Tanggal Dikeluarkan</label>
                                        <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" placeholder="Pilih Tanggal Dikeluarkan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pejabat_diperintah">Pegawai yang Diperintah</label>
                                        <select class="js-example-basic-multiple w-100" name="pejabat_diperintah" id="pejabat_diperintah">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($sppd as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_tujuan">Tempat Tujuan</label>
                                        <input type="text" class="form-control" id="tempat_tujuan" name="tempat_tujuan" placeholder="Tulis Tempat Tujuan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_kembali">Tanggal Kembali</label>
                                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" placeholder="Pilih Tanggal Kembali">
                                    </div>
                                    <div class="form-group">
                                        <label for="instansi">Instansi</label>
                                        <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Tulis Instansi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mata_anggaran">Mata Anggaran</label>
                                        <input type="text" class="form-control" id="mata_anggaran" name="mata_anggaran" placeholder="Tulis Mata Anggaran">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Tulis Keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <div>
                                            <label for=tempat>Tujuan Berangkat dan Tiba</label>
                                        </div>
                                        <div>
                                            <button id="add-tempat-button" type="button" class="btn btn-success">
                                                Tekan Untuk Menambahkan Tujuan
                                            </button>
                                            <button id="remove-tempat-button" type="button" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="tempat-wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@include('sweetalert::alert')
<script>
    const form = document.querySelector('#form-sppd');
    const wrapperFields = document.querySelector('#tempat-wrapper');
    const addTempatButton = document.querySelector('#add-tempat-button');
    const removeTempatButton = document.querySelector('#remove-tempat-button');

    const template = (position, romawi) =>
        `<div class="form-group">
            <label> Romawi ${romawi}</label>
            <div class="row">
                <div class="col">
                    <label for="tempat_tujuan_${position}">Tujuan ${position}</label>
                    <input type="text" class="form-control" id="tempat_tujuan_${position}" name="tempat_tujuan_${position}" placeholder="Tulis Tempat Berangkat">
                </div>
                <div class="col">
                    <label for="tgl_tiba_${position}">Tanggal Tiba</label>
                    <input type="date" class="form-control" id="tgl_tiba_${position}" name="tgl_tiba_${position}" placeholder="Pilih Tanggal Tiba">
                </div>
                <div class="col">
                    <label for="tgl_berangkat_dari_${position}">Tanggal Berangkat dari</label>
                    <input type="date" class="form-control" id="tgl_berangkat_dari_${position}" name="tgl_berangkat_dari_${position}" placeholder="Tulis Tempat Tujuan">
            </div>
        </div>`;

    let position = 1;
    let romawi = 2;

    addTempatButton.addEventListener('click', () => {
    if (position > 3 && romawi > 4 ) {
        Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Maaf, sudah melebihi limit tempat yang dapat ditambahkan.',
        showConfirmButton: false,
        timer: 1500
        })
        return;
    }

    wrapperFields.insertAdjacentHTML('beforeend', template(position, romawi));
    position++;
    romawi++
    });

    removeTempatButton.addEventListener('click', () => {
    if (position > 1 && romawi > 2) {
        const lastTempat = wrapperFields.lastElementChild;
        lastTempat.remove();
        position--;
        romawi--;
    }
    });
    form.addEventListener('submit', (event) => {
    // Pastikan data dari wrapper juga dikirim bersama form utama
    const tempatBerangkat = document.querySelectorAll('[id^="tempat_berangkat_"]');
    const tglBerangkat = document.querySelectorAll('[id^="tgl_berangkat_"]');
    const tempatTiba = document.querySelectorAll('[id^="tempat_tiba_"]');
    const tglTiba = document.querySelectorAll('[id^="tgl_tiba_"]');
    const tempatBerangkatValues = [];
    const tglBerangkatValues = [];
    const tempatTibaValues = [];
    const tglTibaValues = [];

    // Dapatkan nilai dari setiap input field
    tempatBerangkat.forEach((input) => {
        tempatBerangkatValues.push(input.value);
    });

    tglBerangkat.forEach((input) => {
        tglBerangkatValues.push(input.value);
    });

    tempatTiba.forEach((input) => {
        tempatTibaValues.push(input.value);
    });

    tglTiba.forEach((input) => {
        tglTibaValues.push(input.value);
    });

    // Tambahkan data dari wrapper ke dalam form utama
    const wrapperData = {
        tempat_berangkat: tempatBerangkatValues,
        tgl_berangkat: tglBerangkatValues,
        tempat_tiba: tempatTibaValues,
        tgl_tiba: tglTibaValues,
    };

    const wrapperDataJson = JSON.stringify(wrapperData);
    const wrapperInput = document.createElement('input');
    wrapperInput.type = 'hidden';
    wrapperInput.name = 'wrapper_data';
    wrapperInput.value = wrapperDataJson;
    form.appendChild(wrapperInput);
    });
</script>

@endsection
