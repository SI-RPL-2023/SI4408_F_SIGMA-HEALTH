<?php $__env->startSection('content'); ?>
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
?>
<!-- END OF ALERT -->
<div class="main">
<section class="signup">
    <div class="container-signup">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Registrasi</h2>
                <form method="POST" action="doRegister" class="register-form" id="register-form">
                    <?php echo csrf_field(); ?>
                    <?php if(session()->has('error')): ?>
                    <p><?php echo showError(Session::get('error')); ?></p>
                    <?php endif; ?> 
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p><?php echo e(showError($message)); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group">
                        <label class="label-form" for="nama_lengkap"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="nama" id="nama_lengkap" placeholder="Nama Lengkap"/>
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p><?php echo e(showError($message)); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group">
                        <label class="label-form" for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Email"/>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p><?php echo e(showError($message)); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group">
                        <label class="label-form" for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="pass" placeholder="Kata Sandi (Minimal 8 karakter)"/>
                    </div>
                    <?php $__errorArgs = ['konfirmasi_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p><?php echo e(showError($message)); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                <figure><img src="<?php echo e(asset('assets/login/images/signup-image.jpg')); ?>" alt="sing up image"></figure>
                <span>Sudah memiliki akun? <a href="login" class="signup-image-link">Log in</a></span>
            </div>
        </div>
    </div>
</section>
</div>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('../layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\owner\OneDrive\Dokumen\KULIAH\Semester 6\RPL\Sigma Health Git\resources\views/pages/register.blade.php ENDPATH**/ ?>