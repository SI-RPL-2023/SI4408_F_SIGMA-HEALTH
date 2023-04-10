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
    <h3>Master Dokter</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Dokter
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Form Tambah Dokter</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('master-dokter-simpan')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama" class="control-label">Nama Dokter</label>
                    <input type="text" name="nama" id="nama_edit" class="form-control" placeholder="Masukkan Nama Dokter">
                </div>
                <div class="form-group">
                  <label for="id_poli" class="control-label">Poli</label>
                  <select name="id_poli" id="id_poli" class="form-select">
                    <option value="">Pilih Poli</option>
                    @foreach($poli as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="jk" id="jk" value="L">
                  <label class="form-check-label" for="jk">
                    Laki-laki
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jk" id="jk" value="P">
                  <label class="form-check-label" for="jk">
                    Perempuan
                  </label>
                </div>
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
                <th class="sorting" tabindex="0" aria-controls="example1">Poli</th>
                <th class="sorting" tabindex="0" aria-controls="example1">Jenis Kelamin</th>
                <th class="sorting" tabindex="0" aria-controls="example1" width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>  
            @php $i=1; @endphp
            @foreach($dokter as $row)
            <tr align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nama_poli }}</td>
                <td>{{ ($row->jk == 'L' ? 'Laki-laki' : 'Perempuan') }}</td>
                <td>
                    <form action="{{url('master-dokter-delete', $row->id)}}" method="post">
                        <a onclick="edit_dokter(this)" data-bs-target="#edit_dokter" data-bs-toggle="modal" 
                        data-id="{{$row->id}}" 
                        data-nama="{{$row->nama}}" 
                        data-id_poli="{{$row->id_poli}}" 
                        data-jk="{{$row->jk}}" class="btn btn-outline-primary mt-2"><i class="bi bi-pen"></i></a>
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
      <div class="modal fade" id="edit_dokter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Ubah dokter</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="id_dokter" class="control-label">ID dokter</label>
                <input type="text" name="id_dokter" id="id_edit" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label for="nama" class="control-label">Nama dokter</label>
                <input type="text" name="nama" id="nama_edit" class="form-control" placeholder="Masukkan Nama dokter">
              </div>
              <div class="form-group">
                <label for="id_poli" class="control-label">Poli</label>
                <select name="id_poli" id="id_poli_edit" class="form-select">
                  <option value="">Pilih Poli</option>
                  @foreach($poli as $row)
                  <option value="{{$row->id}}">{{$row->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" id="jk_l" value="L">
                <label class="form-check-label" for="jk">
                  Laki-laki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" id="jk_p" value="P">
                <label class="form-check-label" for="jk">
                  Perempuan
                </label>
              </div>
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
    // EDIT ON MODAL
  function edit_dokter(el) {
       var link = $(el) //refer `a` tag which is clicked
        var modal = $("#edit_dokter") //your modal
        var nama = link.data('nama')
        var id = link.data('id')
        var id_poli_edit = link.data('id_poli')
        // alert(id_poli_edit)
        var jk = link.data('jk')
        // console.log(jk)
        var url = '{{asset("assets/uploads/produk-kategori")}}';
        var url_update = "{{url('master-dokter-update')}}/"+id+"";
        // add attr action form
        $('#editForm').attr('action', url_update);
        // end add attr
        modal.find('#id_edit').val(id);
        modal.find('#nama_edit').val(nama);
        $("#id_poli_edit option[value='"+id_poli_edit+"']").attr("selected","selected");
        
        if(jk == 'L')
        {
          $("#jk_l").prop('checked', true);
        } else if(jk == 'P')
        {
          $("#jk_p").prop('checked', true);
        }
 
        // console.log(link.data('poli'));
      }
      // END EDIT
</script>
@stop
@stop