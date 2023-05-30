<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 100%;
    }

    th, td {
        padding-top: 10px;
        padding-bottom: 20px;
        padding-left: 30px;
        padding-right: 40px;
    }

</style>
<body>
<div class="center">
<table class="table table-striped" border="1" style="border-collapse:collapse;width:50%;margin:auto">
    <tr>
        <td>No Rekam Medis</td>
        <td>{{ $cek->no_rekam_medis }}</td>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td>{{ $cek->nama_pasien }}</td>
    </tr>
    <tr>
        <td>No Telp</td>
        <td>{{ $cek->no_telp }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>{{ $cek->alamat }}</td>
    </tr>
    <tr>
        <td>Kode Reservasi</td>
        <td>{{ $cek->kode_reservasi }}</td>
    </tr>
    <tr>
        <td>Tanggal Periksa</td>
        <td>{{ date('d - m - Y', strtotime($cek->jadwal_mulai)) }}</td>
    </tr>
    <tr>
        <td>Jam Periksa</td>
        <td>{{ date('H.i', strtotime($cek->jadwal_mulai)) }} - {{ date('H.i', strtotime($cek->jadwal_selesai)) }} WIB</td>
    </tr>
    <tr>
        <td>Nama Dokter</td>
        <td>{{ $cek->nama_dokter }}</td>
    </tr>
    <tr>
        <td>Instalasi/Poli</td>
        <td>{{ $cek->nama_poli }}</td>
    </tr>
    <tr>
        <td>Cara Reservasi</td>
        <td>{{ $cek->cara }}</td>
    </tr>
    <tr>
        <td>Nomor Antrian</td>
        <td>{{ $cek->no_antrian }}</td>
    </tr>
    <tr>
        <td>Status Reservasi</td>
        <td>
            @if($cek->status == 0)
            <span class="badge bg-danger">Belum Diverifikasi</span></a>
            @elseif($cek->status == 1)
            <span class="badge bg-success">Sudah Diverifikasi</span><br>
            @endif
        </td>
    </tr>
    </table>

</div>
<script>
window.print();
</script>
</body>
</html>