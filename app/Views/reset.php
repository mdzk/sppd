<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset password - SPPD</title>

    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/compiled/png/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/auth.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/extensions/sweetalert2/sweetalert2.min.css" />

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
                    <h1 class="auth-title">Reset Password</h1>
                    <p class="auth-subtitle mb-5">
                        Lengkapi form berikut, untuk membuat password baru
                    </p>

                    <?php if ($errors = session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= route_to('update-password'); ?>" method="POST">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password2" placeholder="Konfirmasi Password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Submit</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Sudah memilik akun?
                            <a href="<?= route_to('login'); ?>" class="font-bold">login</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>/assets/extensions/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extensions/sweetalert2/sweetalert2.min.js"></script>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?= session()->getFlashdata('pesan'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
</body>

</html>