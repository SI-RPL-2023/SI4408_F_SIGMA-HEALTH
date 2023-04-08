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
    <h3>Master Poli</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Poli
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Form Tambah Poli</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('master-poli-simpan')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama" class="control-label">Nama Poli</label>
                    <input type="text" name="nama" id="nama_edit" class="form-control" placeholder="Masukkan Nama Poli">
                </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="konfirmasiSimpan()" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    </div>