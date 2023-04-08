@extends('../layout')
@section('content')
  <!-- ALERT -->
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