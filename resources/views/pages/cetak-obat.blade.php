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
<table class="table table-striped" border="1" style="border-collapse:collapse;width:80%;margin:auto">
<tr>
            <td>ID Obat</td>
            <td>{{ $cek->id }}</td>
        </tr>
        <tr>
            <td>Kode Reservasi</td>
            <td>{{ $cek->kode_reservasi }}</td>
        </tr>
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
            <td>Nama Dokter</td>
            <td>{{ $cek->nama_dokter }}</td>
        </tr>
        <tr>
            <td>Instalasi/Poli</td>
            <td>{{ $cek->nama_poli }}</td>
        </tr>
        <tr>
            <td>Obat Yang Diberikan</td>
            <td>{!! $cek->obat !!}</td>
        </tr>
    </table>

</div>
<script>
window.print();
</script>
</body>
</html>