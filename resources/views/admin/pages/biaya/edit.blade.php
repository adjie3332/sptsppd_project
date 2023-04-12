@extends('index')
@section('title', 'Edit Data Biaya')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Edit Data Biaya</h4>
                        </div>
                        <div>
                            <a href="{{ route('biaya.index') }}">
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
                        <form class="forms-sample" action="{{ route('biaya.update', $biaya->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                    <div class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input value="{{ $biaya->kegiatan }}" type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Tulis Kegiatan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pegawai">Pejabat Pemberi Perintah</label>
                                        <select class="js-example-basic-multiple w-100 form-control" name="nama_pegawai"
                                            id="nama_pegawai">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach ($pegawai as $s)
                                                <option {{ $s->id == $biaya->nama_pegawai? 'selected' : ''}} value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi</label>
                                        <input value="{{ $biaya->lokasi }}" type="text" class="form-control" id="lokasi" name="lokasi"
                                            placeholder="Tulis Lokasi">
                                    </div>
                                    <div class="form-group">
                                        <label for="hari_tgl">Hari Tanggal</label>
                                        <input value="{{ $biaya->hari_tgl }}" type="date" class="form-control" id="hari_tgl" name="hari_tgl"
                                            placeholder="Pilih Tanggal Kepergian">
                                    </div>
                                    <div class="form-group">
                                        <label for="rekening">Rekening</label>
                                        <input value="{{ $biaya->rekening }}" type="text" class="form-control" id="rekening" name="rekening"
                                            placeholder="Tulis Nomor Rekening">
                                    </div>
                                    <div class="form-group">
                                        <label for="uang_harian">Uang Harian (Rp)</label>
                                        <input value="{{ $biaya->uang_harian }}" type="text" class="form-control" id="uang_harian" name="uang_harian"
                                            placeholder="Tulis Nominal Uang Harian">
                                    </div>
                                    <div class="form-group">
                                        <label for="uang_transport">Uang Transport (Rp)</label>
                                        <input value="{{ $biaya->uang_transport }}" type="text" class="form-control" id="uang_transport" name="uang_transport"
                                            placeholder="Tulis Nominal Tang Transport">
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_transport">Biaya Transport (Rp)</label>
                                        <input value="{{ $biaya->biaya_transport }}" type="text" class="form-control" id="biaya_transport"
                                            name="biaya_transport" placeholder="Tulis Nominal Biaya Transport">
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

    
    <script>
        const wrapperFields = document.querySelector('#diperintah-wrapper');
        const addPejabatButton = document.querySelector('#add-diperintah-button');
        const pejabats = [];
    
        const template = (position) =>`<div class="form-group">
                <label>Pejabat ${position}</label>
                <select class="js-example-basic-multiple w-100" name="diperintah[]"
                    id="diperintah">
                    '@foreach($pegawai as $s) <option value="{{ $s->id }}">{{$s->name}}</option> @endforeach
                </select>
            </div>`
    
        addPejabatButton.addEventListener('click', () => {
            const lastChild = wrapperFields.querySelector('.form-group:last-child')
            const currentLength =  wrapperFields.children.length;
            console.log(wrapperFields)
            lastChild.insertAdjacentHTML('afterend', template(currentLength + 1));    
        })
    </script>
</script>

@endsection
