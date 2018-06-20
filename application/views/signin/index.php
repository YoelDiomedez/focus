<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    
    <?= form_open('signin/login', array('class'=>'login-form')); ?>
        <h3 class="form-title font-dark">Iniciar sesión</h3>
        <div class="alert alert-danger display-hide text-center">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password </span>
        </div>
        <?php if($res != "ok"): ?>
        <div class="alert alert-danger text-center">
            <button class="close" data-close="alert"></button>
            <span> Incorrect username or password </span>
        </div>
        <?php endif; ?>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="yoeldiomedez@gmail.com" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="admin" /> </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary uppercase btn-block">
                Ingresar <i class="icon-login"></i>
            </button>
        </div>
    <?= form_close(); ?>
    <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->