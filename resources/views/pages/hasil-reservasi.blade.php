@extends('../layout')
@section('content')
<div class="container mt-4">
    <h3 class="text-center mb-4">Cek Reservasi Pasien</h3>
    <table class="table table-bordered">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>Kode Reservasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @forelse($res as $row)
            <tr align="center">
                <td>{{$i++}}</td>
                <td>{{$row->kode_reservasi}}</td>
                <td width="300"><a href="{{ url('tampil-hasil-reservasi/'.$row->kode_reservasi) }}" class="btn btn-outline-success">Lihat Status Reservasi</a></td>
            </tr>
            @empty
            <tr align="center">
                <td><td colspan="3">Tidak ada data reservasi</td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@stop