<div id="loginPage">
    <div class="login-wrapper">
        <div class="container">
            <div class="login-inner-wrapper">
                <div class="logo">
                    <img src="assets/img/logo-ico.png"/>
                </div>
                <div class="title-area">
                    <h3 data-aos="fade-in">
                        Socioeconomic Dashboard
                    </h3>
                    <h4>
                        LOG IN
                    </h4>
                </div>
                <div class="form-area">
                    <form wire:submit.prevent="login">
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="bx bx-user"></i>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Your Email" wire:model="email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="bx bx-lock"></i>
                                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Your Password" wire:model="password" />
                            </div>
                        </div>
                        <div class="help-area">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" wire:model="remember">
                                <label class="form-check-label" for="remember">Remember</label>
                            </div>
                            <div class="default-link">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <button type="submit" class="button-primary-full">LOGIN</button>
                    </form>
                </div>

                <div class="footer-area">
                    <div class="top">
                        <img src="assets/img/a2i.png"/>
                        <img src="assets/img/cabinet.png"/>
                        <img src="assets/img/ict.png"/>
                        <img src="assets/img/undp.png"/>
                    </div>
                    <div class="bottom">
                        <img src="assets/img/powred-by.gif"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/design/resources/views/auth/login.blade.php ENDPATH**/ ?>