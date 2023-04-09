@extends('../layout')
@section('content')
<!-- ALERT -->
            <div class="signup-form">
                <h2 class="form-title">Registrasi</h2>
                <form method="POST" action="doRegister" class="register-form" id="register-form">
                    @csrf
                    @if(session()->has('error'))
                    <p><?php echo showError(Session::get('error')); ?></p>
                    @endif 
                    @error('nama')
                    <p>{{ showError($message) }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="label-form" for="nama_lengkap"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="nama" id="nama_lengkap" placeholder="Nama Lengkap"/>
                    </div>
                    @error('email')
                    <p>{{ showError($message) }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="label-form" for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Email"/>
                    </div>
                    @error('password')
                    <p>{{ showError($message) }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="label-form" for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="pass" placeholder="Kata Sandi (Minimal 8 karakter)"/>
                    </div>
                    @error('konfirmasi_password')
                    <p>{{ showError($message) }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="label-form" for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="konfirmasi_password" id="re_pass" placeholder="Ulangi Kata Sandi"/>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Registrasi"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{asset('assets/login/images/signup-image.jpg')}}" alt="sing up image"></figure>
                <span>Sudah memiliki akun? <a href="login" class="signup-image-link">Log in</a></span>
            </div>
        </div>
    </div>
</section>
</div>
@section('js')

@stop
@stop