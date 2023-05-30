@extends('../layout')
@section('content')
 <!-- ALERT -->
 <?php 
function showError($error)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
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
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
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
@if(session()->has('error'))
<p><?php echo showError(Session::get('error')); ?></p>
@elseif(session()->has('success'))
<p><?php echo showSuccess(Session::get('success')); ?></p>
@endif 
<!-- END OF ALERT -->
<section class="sign-in mt-4 mb-4">
      <div class="container-signup" style="width:100%">
          <div class="signin-content">
              <div class="signin-image">
                  <figure><img src="{{asset('assets/images/art3.png')}}" alt="sing up image"></figure>
              </div>

              <div class="signin-form mt-5">
                  <form method="GET" action="{{url('cek-reservasi')}}" class="register-form" id="login-form">
                    <h2 class="mb-4">Cek Reservasi</h2>
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
@section('js')
<script>
$(function() {
    $("#tgl_lahir").datepicker();
});
</script>
@stop
@stop