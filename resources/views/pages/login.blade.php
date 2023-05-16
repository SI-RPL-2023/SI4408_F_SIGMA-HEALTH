@extends('../layout')
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

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
     <div class="carousel-item active">
      <img src="{{asset('assets/images/slide1.png')}}" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/slide2.png')}}" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/slide3.png')}}" class="d-block w-100">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> 
<div class="main">
<section class="sign-in">
    <div class="container-signup">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{asset('assets/login/images/signin-image.jpg')}}" alt="sing up image"></figure>
                <span>Apakah anda belum memiliki akun? <a href="register" class="register">Registrasi</a></span>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Log in</h2>
                <form action="{{url('doLogin')}}" method="POST" class="register-form" id="login-form">
                  @csrf
                  @if(session()->has('error'))
                  <p><?php echo showError(Session::get('error')); ?></p>
                  @elseif(session()->has('success'))
                  <p><?php echo showSuccess(Session::get('success')); ?></p>
                  @endif 
                  @error('email')
                    <p>{{ showError($message) }}</p>
                  @enderror
                    <div class="form-group">
                        <label class="label-form" for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="email" name="email" id="email" value="{{ (Cookie::get('remember') == 'remembered') ? Cookie::get('email') : '' }}" placeholder="Email"/>
                    </div>
                  @error('password')
                    <p>{{ showError($message) }}</p>
                  @enderror
                    <div class="form-group">
                        <label class="label-form" for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" value="{{ (Cookie::get('remember') == 'remembered') ? Cookie::get('password') : '' }}" placeholder="Kata Sandi"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember-me" class="agree-term" {{ (Cookie::get('remember') == 'remembered') ? 'checked' : '' }} />
                        <label for="remember-me" class="label-form label-agree-term"><span><span></span></span>Ingat saya</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>
@section('js')

@stop
@stop