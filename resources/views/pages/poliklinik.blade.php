@extends('../layout')
@section('content')
<div class="container mt-4">
    <h4 class="text-center">Jadwal Dokter dan Poli</h4>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No.</th>
                <th>Hari</th>
                <th>Jadwal (Jam)</th>
                <th>Nama Dokter</th>
                <th>Poliklinik</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $i = 1;
            @endphp
            @forelse($dokter as $row)
            @php 
            $hari = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->jadwal_mulai)->format('N')
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                    @if($hari == 1)
                        Senin
                    @elseif($hari == 2)
                        Selasa
                    @elseif($hari == 3)
                        Rabu
                    @elseif($hari == 4)
                        Kamis
                    @elseif($hari == 5)
                        Jumat 
                    @elseif($hari == 6)
                        Sabtu
                    @elseif($hari == 7)
                        Minggu
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->jadwal_mulai)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->jadwal_selesai)->format('H:i') }}</td>           
                <td>{{ $row->nama_dokter }}</td>
                <td>{{ $row->nama_poli }}</td>          
            </tr>
            @empty
            <td colspan="5">Data tidak tersedia</td>
            @endforelse
        </tbody>
    </table>
</div>
@stop