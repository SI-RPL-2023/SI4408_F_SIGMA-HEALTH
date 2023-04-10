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
    <h3>Master Jadwal</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Jadwal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Form Tambah Jadwal</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('master-jadwal-simpan')}}" method="post">
            @csrf
            <div class="modal-body">
            <div class="form-group">
                <label for="id_dokter" class="control-label">Dokter</label>
                <select name="id_dokter" id="id_dokter" class="form-select">
                  <option value="">Pilih Dokter</option>
                  @foreach($dokter as $row)
                  <option value="{{$row->id}}">{{$row->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label for="jadwal_mulai">Jadwal Mulai</label>
                  <input id='jadwal_mulai' type='datetime-local' class="form-control" name="jadwal_mulai" placeholder="Masukkan Tanggal Periksa" />
              </div>
              <div class="form-group">
                  <label for="jadwal_selesai">Jadwal Selesai</label>
                  <input id='jadwal_selesai' type='datetime-local' class="form-control" name="jadwal_selesai" placeholder="Masukkan Tanggal Periksa" />
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

    @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
    <!-- CONTENT -->
    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
        <thead>
            <tr align="center">
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" aria-sort="ascending" width="50">No.</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Nama Dokter</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Hari</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Tanggal Periksa</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Jam Periksa</th>
                <th class="sorting" tabindex="0" aria-controls="example1" width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>  
            @php $i=1; @endphp
            @foreach($jadwal as $row)
            @php 
            $hari = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->jadwal_mulai)->format('N')
            @endphp
            <tr align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $row->nama_dokter }}</td>
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
                <td>{{ date('d-m-Y', strtotime($row->jadwal_mulai)) }}</td>
                <td>{{ date('H.i', strtotime($row->jadwal_mulai)) }} - {{ date('H.i', strtotime($row->jadwal_selesai)) }}</td>
                <td>
                    <form action="{{url('master-jadwal-delete', $row->id)}}" method="post">
                        <a onclick="edit_jadwal(this)" data-bs-target="#edit_jadwal" data-bs-toggle="modal" 
                        data-id="{{$row->id}}" 
                        data-id_dokter="{{$row->id_dokter}}" 
                        data-jadwal_mulai="{{$row->jadwal_mulai}}"
                        data-jadwal_selesai="{{$row->jadwal_selesai}}"
                        class="btn btn-outline-primary mt-2"><i class="bi bi-pen"></i></a>
                        @csrf 
                        <button type="button" class="btn btn-outline-danger mt-2" onclick="konfirmasiHapus()"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL EDIT -->
    <form action="#" id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="edit_jadwal" style="display: none;" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Form Ubah jadwal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="id_jadwal" class="control-label">ID jadwal</label>
                  <input type="text" name="id_jadwal" id="id_edit" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="id_dokter" class="control-label">Dokter</label>
                  <select name="id_dokter" id="id_dokter_edit" class="form-select">
                    <option value="">Pilih Dokter</option>
                    @foreach($dokter as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="jadwal_mulai_edit">Jadwal Mulai</label>
                  <input id='jadwal_mulai_edit' type='datetime-local' class="form-control" name="jadwal_mulai_edit" placeholder="Masukkan Tanggal Periksa" />
                </div>
                <div class="form-group">
                    <label for="jadwal_selesai_edit">Jadwal Selesai</label>
                    <input id='jadwal_selesai_edit' type='datetime-local' class="form-control" name="jadwal_selesai_edit" placeholder="Masukkan Tanggal Periksa" />
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="button" onclick="konfirmasiUbah()" class="btn btn-primary">Ubah</button>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</div>
      </form>
</div>
@section('js')
<script>
  $(document).ready(function(){
    // $('#tgl_periksa').datepicker();
    // $('#tgl_periksa_edit').datepicker();
  })
    // EDIT ON MODAL
  function edit_jadwal(el) {
       var link = $(el) //refer `a` tag which is clicked
        var modal = $("#edit_jadwal") //your modal
        var id = link.data('id')

        var id_dokter_edit = link.data('id_dokter')
        var jadwal_mulai_edit = link.data('jadwal_mulai')
        var jadwal_selesai_edit = link.data('jadwal_selesai')
        // alert(jadwal_mulai_edit)
        var url_update = "{{url('master-jadwal-update')}}/"+id+"";
        // add attr action form
        $('#editForm').attr('action', url_update);
        // end add attr
        modal.find('#id_edit').val(id);
        modal.find('#jadwal_mulai_edit').val(jadwal_mulai_edit);
        modal.find('#jadwal_selesai_edit').val(jadwal_selesai_edit);
        $("#id_dokter_edit option[value='"+id_dokter_edit+"']").attr('selected', 'selected');
         
      }
      // END EDIT
</script>
@stop
@stop