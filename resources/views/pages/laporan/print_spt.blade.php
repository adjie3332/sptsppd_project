<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data SPT</title>
</head>
<body>
    <h1 style="text-align: center;">Laporan Data SPT</h1>

    <table border="1" cellspacing="0" cellpadding="10" style="margin: auto;">
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
            </tr>
        </thead>
        <tbody>
            @foreach($lap_spt as $spt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $spt->tgl_ditetapkan }}</td>
                <td>{{ $spt->nomor_surat }}</td>
                <td>
                    @foreach ($spt->diperintah as $pegawai)
                    {{ $pegawai->name }} - {{ $pegawai->nip }}<br>
                    @endforeach
                </td>
                <td>{{ $spt->maksud_tugas }}</td>
                <td>{{ $spt->tgl_pergi }}</td>
                <td>{{ $spt->tgl_kembali }}</td>
                <td>{{ $spt->tempat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
