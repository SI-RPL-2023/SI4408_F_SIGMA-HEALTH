@extends('../../layout')
@section('content')
<!-- ALERT -->
<?php 
function showError($error)
{   
    ?>
    <div class="toast position-fixed top-0 start-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-danger"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $error ?>
        </div>
    </div>
    
<?php
}
function showSuccess($success)
{   
    ?>
    <div class="toast position-fixed top-0 start-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-success"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $success ?>
        </div>
    </div>
    
<?php
}
?>
<!-- END OF ALERT -->
@if(session()->has('error'))
<p><?php echo showError(Session::get('error')); ?></p>
@elseif(session()->has('success'))
<p><?php echo showSuccess(Session::get('success')); ?></p>
@endif 
<div class="container mt-4">
    <h3 class="text-center mb-4">Cek Reservasi Pasien</h3>
    <table class="table table-bordered">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>Kode Reservasi</th>
                <th>No Rekam Medis</th>
                <th>Pasien</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Tgl Periksa</th>
                <th>Jam Periksa</th>
                <th>Antrian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @forelse($reservasi as $row)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$row->kode_reservasi}}</td>
                <td>{{$row->no_rekam_medis}}</td>
                <td>{{$row->nama_pasien}}</td>
                <td>{{$row->nama_poli}}</td>
                <td>{{$row->nama_dokter}}</td>
                <td>{{date('d-m-Y', strtotime($row->jadwal_mulai))}}</td>
                <td>{{date('H.i', strtotime($row->jadwal_mulai))}} - {{date('H.i', strtotime($row->jadwal_selesai))}} WIB</td>
                <td>{{$row->no_antrian}}</td>
                <td>
                    @if($row->status == '0')
                    <form action="{{url('ubah-status-reservasi', $row->kode_reservasi)}}" method="post">
                        @csrf
                        <button type="button" class="badge bg-danger" style="border:none" onclick="konfirmasiUbah()">Belum Verifikasi</button>
                    </form>
                    @elseif($row->status == '1')
                    <span class="badge bg-success">Sudah Verifikasi</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@stop