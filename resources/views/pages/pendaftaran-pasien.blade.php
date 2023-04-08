@extends('../layout')
@section('content')
  <!-- ALERT -->
  <?php 
function showError($error)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <label class="text-danger"><i class="bi bi-square-fill"></i></label>
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
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <label class="text-success"><i class="bi bi-square-fill"></i></label>
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
@if(session()->has('error'))
<p><?php echo showError(Session::get('error')); ?></p>
@elseif(session()->has('success'))
<p><?php echo showSuccess(Session::get('success')); ?></p>
@endif 
<!-- END OF ALERT -->
<!-- Tabs -->
<nav class="mt-4">
  <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pasien Lama</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Pasien Baru</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
  <section class="sign-in mt-4 mb-4">
      <div class="container-signup" style="width:100%">
          <div class="signin-content">
              <div class="signin-image">
                  <figure><img src="{{asset('assets/login/images/doctor.jpg')}}" alt="sing up image"></figure>
              </div>

              <div class="signin-form mt-5">
                  <form method="GET" action="{{url('pilih-poli')}}" class="register-form" id="login-form">
                    @csrf
                      <div class="form-group">
                          <label class="label-form" for="no_rekam_medis"><i class="bi bi-file-earmark-medical"></i></label>
                          <input type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="No Rekam Medis"/>
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="tgl_lahir"><i class="bi bi-calendar"></i></label>
                          <input type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" autocomplete="off"/>
                      </div>
                      <div class="form-group form-button">
                          <input type="submit" name="signin" id="signin" class="form-submit" value="Next"/>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
    <div class="container">
    <div class="card border-0 rounded mt-4">
        <div class="card-body">
          <form action="{{url('pendaftaran-pasien/daftar')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
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
            <input type="hidden" name="id_user" value="{{Session::get('id_user')}}">
            <h4 class="mb-3 fw-semibold">Data Pasien</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="no_rekam_medis" class="form-label">No Rekam Medis</label>
                  <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" maxlength="16" value="{{ $no_rekam_medis }}" readonly>
                </div>
                <div class="mb-3">
                  <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                  <input type="text" class="form-control" name="nik" id="nik" maxlength="16" placeholder="----------------" required>
                </div>
                <div class="mb-3">
                  <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jk" id="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Kota Lahir" required>
              </div>
                <div class="mb-3">
                  <label for="tgl_lahir_p_baru" class="form-label">Tanggal Lahir</label>
                  <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir_p_baru" placeholder="Masukkan Tanggal Lengkap" required>
                </div>
                <div class="mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan" required>
                </div>
                <div class="mb-3">
                  <label for="gol_darah" class="form-label">Golongan Darah</label>
                  <select name="gol_darah" id="gol_darah" class="form-select" required>
                    <option value="">Pilih Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="no_telp" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" maxlength="13" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telepon" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                </div>
              </div>
            </div>

            <div class="row">
              <h4 class="fw-semibold mt-5 mb-4">Alamat Pasien</h4>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="provinsi" class="form-label">Provinsi</label>
                  <select name="id_provinsi" id="provinsi" class="form-select" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinces as $item)
                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="kota" class="form-label">Kabupaten/Kota</label>
                  <select name="id_kabupaten" id="kota" class="form-select" required>
                  <option value="">Pilih Kota</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="kecamatan" class="form-label">Kecamatan</label>
                  <select name="id_kecamatan" id="kecamatan" class="form-select" required>
                  <option value="">Pilih Kecamatan</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat Lengkap</label>
                  <div class="form-floating">
                    <textarea class="form-control" name="alamat" id="floatingTextarea2" style="height: 100px" required></textarea>
                  </div>
                </div>    
              </div>
            </div>
        </div>
      </div>  
      <!-- WALI -->
      <div class="card border-0 rounded mt-4">
        <div class="card-body">
        <h4 class="mb-4 fw-semibold">Data Wali</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nama_lengkap_wali" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_wali" id="nama_lengkap_wali" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jk_wali" id="jenis_kelamin" class="form-select">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan" placeholder="Masukkan Pekerjaan">
                </div>
                <div class="mb-3">
                  <label for="hubungan" class="form-label">Hubungan Keluarga</label>
                  <input type="text" class="form-control" name="hubungan" id="hubungan" placeholder="Masukkan Hubungan Keluarga">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="no_telp_wali" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control"  name="no_telp_wali" id="no_telp_wali" maxlength="13" placeholder="Masukkan Nomor Telepon">
                </div>
                <div class="mb-3">
                  <label for="email_wlai" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email_wali" id="email_wlai" placeholder="Masukkan Email">
                </div>
              </div>
            </div>

            <div class="row">
              <h4 class="fw-semibold mt-5 mb-4">Alamat Wali</h4>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="provinsi_wali" class="form-label">Provinsi</label>
                  <select name="id_provinsi_wali" id="provinsi_wali" class="form-select">
                    <option value="">Pilih Provinsi</option>                    
                    @foreach ($provinces as $item)
                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="kabupaten_kota_wali" class="form-label">Kabupaten/Kota</label>
                  <select name="id_kabupaten_wali" id="kota_wali" class="form-select">
                    <option value="">Pilih Kota</option>   
                  </select>
                </div>
                <div class="mb-3">
                  <label for="kecamatan_wali" class="form-label">Kecamatan</label>
                  <select name="id_kecamatan_wali" id="kecamatan_wali" class="form-select">
                    <option value="">Pilih Kecamatan</option>   
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat Lengkap</label>
                  <div class="form-floating">
                    <textarea class="form-control" name="alamat_wali" id="floatingTextarea2" style="height: 100px"></textarea>
                  </div>
                </div>    
              </div>
            </div>
        </div>
      </div>
      <!-- END WALI -->
      <div class="card border-0 mt-4">
        <div class="card-body">
          <div class="mb-3">
            <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
            <select name="metode_bayar" id="metode_bayar" class="form-select" required>
              <option value="">Pilih Metode Pembayaran</option>
              <option value="bpjs">BPJS/JKN</option>
              <option value="umum">Umum</option>
            </select>
          </div>
          <h4 class="fw-semibold mb-4">Unggah Berkas Pasien (KTP)</h4>
          <input type="file" name="foto_ktp" class="form-control">
        </div>
      </div>
      <button type="button" onclick="konfirmasiSimpan()" class="btn btn-lg btn-primary mt-4 w-100" style="background:#45A75B;border:none">Next</button>
      </form>
    </div>
  </div>
@section('js')
<script>
$(document).ready(function(){
      $('.toast').toast('show');

      @if(session()->has('res_success'))
          Swal.fire({
              position: 'center',
              icon: 'success',
              title: "{{Session::get('res_success')}}",
              showConfirmButton: true,
              showDenyButton: true,
              confirmButtonText: 'Cek Reservasi',
              denyButtonText: `Keluar`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                window.location.href = "{{url('reservasi')}}";
              }
          })
      @endif

      $(function() {
        $("#tgl_lahir").datepicker();
        $("#tgl_lahir_p_baru").datepicker();
      });

      // INDONESIA
      function onChangeSelect(url, id, name, format) {
      // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            id: id,
          },
          dataType: "json",
          success: function (data) {
            $('#' + name).empty();
            // $('#' + name).append('<option>Pilih '+format+'</option>');
            $.each(data, function (key, value) {
              $('#' + name).append('<option value="' + value.id + '">' + value.name + '</option>');
            });
          }
        });
    }
    $(function () {
      $('#provinsi').on('change', function () {
        onChangeSelect('{{ url("getKota/") }}', $(this).val(), 'kota', 'Kota Pasien');
      });
      $('#kota').on('change', function () {
        onChangeSelect('{{ url("getKecamatan/") }}', $(this).val(), 'kecamatan', 'Kecamatan Pasien');
      })
      $('#provinsi_wali').on('change', function () {
        onChangeSelect('{{ url("getKota/") }}', $(this).val(), 'kota_wali', 'Kota Wali');
      });
      $('#kota_wali').on('change', function () {
        onChangeSelect('{{ url("getKecamatan/") }}', $(this).val(), 'kecamatan_wali', 'Kecamatan Wali');
      })
    });
      // -- INDONESIA
  })
</script>
@stop
@stop
