@extends('../layout')
@section('content')
<section class="sign-in mt-4 mb-4">
    <div class="container-signup" style="width:100%">
        <div class="signin-content">
            <div class="signin-form">
            <h4>Reservasi Online</h4>
                <form method="post" action="{{url('doReservasi')}}" class="register-form mt-5" id="login-form">
                @csrf
                <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                    <div class="mb-3">
                        <label style="font-size:13px" for="no_rekam_medis" class="form-label">No Rekam Medis</label>
                        <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" value="{{ $cek->no_rekam_medis }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:13px" for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $cek->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:13px" for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ date('d/m/Y', strtotime($cek->tgl_lahir)) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:13px" for="dokter_poli" class="form-label">Dokter dan Poli<sup class="text-danger" style="font-size:12px">*</sup></label>  
                        <select name="id_dokter" id="dokter_poli" class="form-select">
                            <option value="">Pilih Dokter dan Poli yang dituju</option>
                            @foreach($dokter as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_dokter }} | <label clsas="fw-bold">{{ $row->nama_poli }}</label> </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="mb-3">
                        <label style="font-size:13px" for="tgl_periksa" class="form-label">Tanggal Periksa<sup class="text-danger" style="font-size:12px">*</sup></label>
                        <input type="text" class="form-control" name="tgl_periksa" id="tgl_periksa" placeholder="Masukkan Tanggal Periksa">
                    </div> -->
                    <div class="mb-3">
                        <label style="font-size:13px" for="tgl_periksa" class="form-label">Waktu Periksa<sup class="text-danger" style="font-size:12px">*</sup></label>  
                        <select name="id_jadwal" id="waktu_periksa" class="form-select">
                            <option value="">Pilih Waktu Periksa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:13px" for="keluhan" class="form-label">Keluhan yang dirasakan(opsional)</label>
                        <textarea name="keluhan" id="keluhan" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="button" onclick="konfirmasiSimpan()" class="btn btn-lg btn-primary mt-3 w-100" style="background:#45A75B;border:none">Submit</button>
                </form>
            </div>
            <div class="signin-image">
                <figure><img src="{{asset('assets/images/art2.png')}}" alt="sing up image" class="img-fluid" style="margin-top:50%;margin-right:70px"></figure>
            </div>
        </div>
    </div>
</section>
@section('js')
<script>
$(document).ready(function(){
    $(function() {
        $("#tgl_periksa").datepicker();
    });

    function onChangeSelect(url, id, name) {
      // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            id: id,
          },
          dataType: "json",
          success: function (data) {
            // console.log(id);
            $('#' + name).empty();
            // $('#' + name).append('<option>Pilih '+format+'</option>');
            $.each(data, function (key, value) {
              $('#' + name).append('<option value="' + value.id + '">' + value.jadwal_mulai + ' - '+ value.jadwal_selesai +'</option>');
            });
          }
        });
    }
    $(function () {
      $('#dokter_poli').on('change', function () {
        onChangeSelect('{{ url("getWaktuPeriksa") }}', $(this).val(), 'waktu_periksa');
      });
    });
})
</script>
@stop
@stop
