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
    <h3>Master Obat</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Obat
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Form Tambah Obat</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('master-obat-simpan')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_reservasi" class="control-label">Kode Reservasi</label>
                    <select name="kode_reservasi" id="kode_reservasi" class="form-select">
                      <option value="">- Pilih Kode Reservasi -</option>
                      @foreach($pasien as $row)
                      <option value="{{$row->kode_reservasi}}" 
                      data-no_rekam_medis="{{$row->no_rekam_medis}}"
                      data-nama="{{$row->nama}}"
                      data-no_telp="{{$row->no_telp}}"
                      data-alamat="{{$row->alamat}}">{{$row->kode_reservasi}} | {{$row->no_rekam_medis}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="no_rekam_medis" class="control-label">No.Rekam Medis</label>
                  <input type="text" name="no_rekam_medis" id="no_rekam_medis" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_pasien" class="control-label">Nama Pasien</label>
                  <input type="text" id="nama_pasien" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="no_telp" class="control-label">No.Telp</label>
                  <input type="text" id="no_telp" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="alamat" class="control-label">Alamat</label>
                  <input type="text" id="alamat" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="obat" class="control-label">Resep Dokter/Obat</label>
                  <textarea name="obat" id="obat"></textarea>
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
                <th class="sorting" tabindex="0" aria-controls="example1">Kode Reservasi</th>
                <th class="sorting" tabindex="0" aria-controls="example1">No.Rekam Medis</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Nama pasien</th>
                <th class="sorting" tabindex="0" aria-controls="example1">No.Telp</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Alamat</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Obat</th>
                <th class="sorting" tabindex="0" aria-controls="example1" width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>  
            @php $i=1; @endphp
            @foreach($obat as $row)
            <tr align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $row->kode_reservasi }}</td>
                <td>{{ $row->no_rekam_medis }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->no_telp }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{!! $row->obat !!}</td>
                <td>
                    <form action="{{url('master-obat-delete', $row->id)}}" method="post">
                        <a onclick="edit_obat(this)" data-bs-target="#edit_obat" data-bs-toggle="modal" 
                        data-id="{{$row->id}}" 
                        data-kode_reservasi="{{$row->kode_reservasi}}"
                        data-no_rekam_medis_edit="{{$row->no_rekam_medis}}"
                        data-nama_edit="{{$row->nama}}"
                        data-no_telp_edit="{{$row->no_telp}}"
                        data-alamat_edit="{{$row->alamat}}" 
                        data-obat_edit="{!! $row->obat !!}"
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
    <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="edit_obat" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Form Ubah Obat</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                            <div class="form-group">
                              <label for="id" class="control-label">ID</label>
                              <input type="text" name="id" id="id_edit" class="form-control" readonly>
                            </div>
                              <label for="kode_reservasi" class="control-label">Kode Reservasi</label>
                              <select name="kode_reservasi" id="kode_reservasi_edit" class="form-select">
                                <option value="">- Pilih Kode Reservasi -</option>
                                @foreach($pasien as $row)
                                <option value="{{$row->kode_reservasi}}" 
                                data-kode_reservasi="{{$row->kode_reservasi}}"
                                data-no_rekam_medis="{{$row->no_rekam_medis}}"
                                data-nama="{{$row->nama}}"
                                data-no_telp="{{$row->no_telp}}"
                                data-alamat="{{$row->alamat}}">{{$row->kode_reservasi}} | {{$row->no_rekam_medis}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="no_rekam_medis" class="control-label">No.Rekam Medis</label>
                            <input type="text" name="no_rekam_medis" id="no_rekam_medis_edit" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="nama_pasien" class="control-label">Nama Pasien</label>
                            <input type="text" id="nama_pasien_edit" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="no_telp" class="control-label">No.Telp</label>
                            <input type="text" id="no_telp_edit" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="alamat" class="control-label">Alamat</label>
                            <input type="text" id="alamat_edit" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="obat" class="control-label">Resep Dokter/Obat</label>
                            <textarea name="obat" id="obat_edit" class="obat_edit"></textarea>
                          </div>  
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" onclick="konfirmasiUbah()" class="btn btn-primary">Ubah</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </form>
</div>
@section('js')
<script>
  $(document).ready(function(){
    $('#obat').summernote();
    $('#obat_edit').summernote();

    $('#kode_reservasi').on('change', function(){
      var no_rekam_medis = $(this).find(':selected').attr('data-no_rekam_medis');
      var nama = $(this).find(':selected').attr('data-nama');
      var no_telp = $(this).find(':selected').attr('data-no_telp');
      var alamat = $(this).find(':selected').attr('data-alamat');
      $('#no_rekam_medis').val(no_rekam_medis);
      $('#nama_pasien').val(nama);
      $('#no_telp').val(no_telp);
      $('#alamat').val(alamat);
    })
  })
    // EDIT ON MODAL
  function edit_obat(el) {
       var link = $(el) //refer `a` tag which is clicked
        var modal = $("#edit_obat") //your modal
        var kode_reservasi = link.data('kode_reservasi');
        var no_rekam_medis = link.data('no_rekam_medis_edit');
        var no_telp = link.data('no_telp_edit');
        var alamat = link.data('alamat_edit');
        var nama = link.data('nama_edit')
        var id = link.data('id')
        var obat = link.data('obat_edit')
        var url_update = "{{url('master-obat-update')}}/"+id+"";
    // alert(obat)
        // add attr action form
        $('#editForm').attr('action', url_update);
        // end add attr

        modal.find('#id_edit').val(id);
        $("#kode_reservasi_edit option[value='"+kode_reservasi+"']").attr("selected","selected");
        modal.find('#nama_pasien_edit').val(no_rekam_medis);
        modal.find('#no_rekam_medis_edit').val(nama);
        modal.find('#no_telp_edit').val(no_telp);
        modal.find('#alamat_edit').val(alamat);
        $('#obat_edit').summernote("code", obat);
      }
      // END EDIT
</script>
@stop
@stop