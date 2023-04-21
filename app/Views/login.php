<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SPPD</title>

    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/compiled/png/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/auth.css" />
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="<?= base_url(); ?>/assets/compiled/png/logo.png" alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">
                        Silakan masuk dengan akun yang sudah didaftarkan.
                    </p>

                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                    <form action="<?= route_to('auth'); ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Don't have an account?
                            <a href="auth-register.html" class="font-bold">Sign up</a>.
                        </p>
                        <p>
                            <a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.
                        </p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>