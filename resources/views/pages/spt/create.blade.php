@extends('index')
@section('title', 'Tambah Data SPT')
@section('content')
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Tambah Data SPT</h4>
                        </div>
                        <div>
                            <a href="{{ route('spt.index') }}">
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
                        <form class="forms-sample" action="{{ route('spt.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nomor_surat">Nomor Surat</label>
                                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Tulis Nomor Surat"></input>
                                    </div>
                                    <div class="form-group">
                                    <label>Pejabat Memerintah</label>
                                        <select class="js-example-basic-multiple w-100" name="memerintah[]"
                                            id="memerintah">
                                            <label for="hari">Tanggal Mulai Diperintah</label>
                                            <input type="date" class="form-control" id="hari_tgl" name="hari_tgl" placeholder="Pilih Tanggal Kepergian">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dasar_perintah">Dasar Perintah</label>
                                        <input type="text" class="form-control" id="dasar_perintah" name="dasar_perintah" placeholder="Tulis Dasar Perintah"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="hari_tgl">Hari/Tanggal</label>
                                        <input type="date" class="form-control" id="hari_tgl" name="hari_tgl" placeholder="Pilih Tanggal Kepergian">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="maksud_tugas">Maksud Tugas</label>
                                        <input type="text" class="form-control" id="maksud_tugas" name="maksud_tugas" placeholder="Tulis Maksud Tugas"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu">Waktu</label>
                                        <input type="time" value="{{Carbon\Carbon::now()->format('Y-m-d').'T'.Carbon\Carbon::now()->format('H:i')}}" class="form-control" id="waktu" name="waktu" placeholder="Pilih Waktu Kepergian">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tulis Tempat">
                                </div>
                                <div>
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <div>
                                            <label for=pejabatdiperintah>Pejabat yang Diperintah</label>
                                        </div>
                                        <div>
                                            <button id="add-diperintah-button" class="btn btn-success" type="button">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                            <button id="remove-diperintah-button" type="button" class="btn btn-danger">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="diperintah-wrapper">
                                        <div class="form-group">
                                            <label>Pejabat Diperintah 1</label>
                                            <select class="js-example-basic-multiple w-100" name="diperintah[]"
                                                id="diperintah">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach ($spt as $s)
                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tempat_ditetapkan">Tempat Ditetapkan</label>
                                        <input type="text" class="form-control" id="tempat_ditetapkan" name="tempat_ditetapkan" placeholder="Tulis Tempat Ditetapkan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tgl_ditetapkan">Tanggal Ditetapkan</label>
                                        <input type="date" class="form-control" id="tgl_ditetapkan" name="tgl_ditetapkan" placeholder="Tulis Tanggal Ditetapkan">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="yang_menetapkan">Petugas yang Menetapkan</label>
                                    <select class="js-example-basic-multiple w-100 form-control" name="yang_menetapkan" id="yang_menetapkan">
                                        <option value="">Pilih Salah Satu</option>
                                        @foreach ($spt as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
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

<script>
    const wrapperFields = document.querySelector('#diperintah-wrapper');
    const addPejabatButton = document.querySelector('#add-diperintah-button');
    const removePengikutButton = document.querySelector('#remove-diperintah-button');
    const pejabats = [];

    const template = (position) =>`<div class="form-group">
            <label>Pejabat ${position}</label>
            <select class="js-example-basic-multiple w-100" name="diperintah[]"
                id="diperintah">
                '@foreach($spt as $s) <option value="{{ $s->id }}">{{$s->name}}</option> @endforeach
            </select>
        </div>`

    addPejabatButton.addEventListener('click', () => {
        const lastChild = wrapperFields.querySelector('.form-group:last-child')
        const currentLength =  wrapperFields.children.length;
        console.log(wrapperFields)
        lastChild.insertAdjacentHTML('afterend', template(currentLength + 1));    
    })

    removePengikutButton.addEventListener('click', () => {
        const lastChild = wrapperFields.querySelector('.form-group:last-child')
        const currentLength =  wrapperFields.children.length;
        console.log(wrapperFields)
        if (currentLength != 1) {
            lastChild.remove(template); 
        }
    })
</script>

@endsection