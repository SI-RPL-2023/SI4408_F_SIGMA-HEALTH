@extends('../layout')
@section('content')
<div class="container mt-4">
    <h3 class="text-center mb-4">Cetak Resep Obat</h3>
    <table class="table table-striped" style="width:50%;margin:auto">
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
        <tr>
            <td>Resep Obat</td>
            <td>
                <a href="{{url('cetak-obat',$cek->id)}}" target="_blank">Cetak Resep</a>
            </td>
        </tr>
    </table>
</div>
@stop