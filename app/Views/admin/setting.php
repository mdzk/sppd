<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Informasi Akun</h3>
                <p class="text-subtitle text-muted">Lihat informasi akun seperti nama dan email anda</p>
            </div>

            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account</li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php if ($errors = session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?php foreach ($errors as $key => $value) { ?>
                    <li><?= esc($value) ?></li>
                <?php } ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    </div>
    <section class="section">
        <div class="row">

            <form action="<?= route_to('setting-update'); ?>" method="POST" enctype="multipart/form-data">
                <input type="number" name="id_users" hidden value="<?= $user['id_users']; ?>">
                <div class="col-12">
                    <div class="card mx-2 my-2">
                        <div class="card-body py-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-1">
                                            <div class="stats-icon green">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>

                                        <div class="ms-3 name">
                                            <span class="text-muted">Nama</span>
                                            <h5 class="font-bold"><?= $user['name']; ?>
                                                <button type="button" class="btn btn-sm btn-light-secondary btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#editnama"> Edit
                                                </button>
                                            </h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mx-2 my-2">
                        <div class="card-body py-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-1">
                                            <div class="stats-icon red">
                                                <i class="iconly-boldShield-Done"></i>
                                            </div>
                                        </div>

                                        <div class="ms-3 name">
                                            <span class="text-muted">Email</span>
                                            <h5 class="font-bold"><?= $user['email']; ?>
                                                <button type="button" class="btn btn-sm btn-light-secondary btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#editemail"> Edit
                                                </button>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mx-2 my-2">
                        <div class="card-body py-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-1">
                                            <div class="stats-icon blue">
                                                <i class="iconly-boldImage-2"></i>
                                            </div>
                                        </div>

                                        <div class="ms-3 name">
                                            <h5 class="font-bold">Profile Picture
                                                <button type="button" class="btn btn-sm btn-light-secondary btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#editfoto"> Edit
                                                </button>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mx-2 my-2">
                        <div class="card-body py-4 px-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">

                                        <div class="avatar me-1">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldLock"></i>
                                            </div>
                                        </div>

                                        <div class="ms-3 name">
                                            <h5 class="font-bold">Password
                                                <button type="button" class="btn btn-sm btn-light-secondary btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#editpassword"> Edit
                                                </button>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Edit Nama Modal Content -->
                <div class="modal fade text-left modal-borderless" id="editnama">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit nama</h5>
                            </div>
                            <input type="hidden" wire:model="categoryId">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="basicInput">Masukkan Nama</label>
                                    <input type="text" value="<?= $user['name']; ?>" name="name" class="form-control" id="basicInput" placeholder="ketik disini">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Batal</span>
                                </button>
                                <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Edit Nama Modal Content End-->

                <!--Edit Email Modal Content -->
                <div class="modal fade text-left modal-borderless" id="editemail">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit email</h5>
                            </div>
                            <input type="hidden" wire:model="categoryId">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="basicInput">Masukkan Email</label>
                                    <input type="text" value="<?= $user['email']; ?>" name="email" class="form-control" id="basicInput" placeholder="ketik disini">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Batal</span>
                                </button>
                                <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Edit Email Modal Content End-->

                <!--Edit foto Modal Content -->
                <div class="modal fade text-left modal-borderless" id="editfoto">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Profile Picture</h5>
                            </div>
                            <input type="hidden" wire:model="categoryId">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="basicInput">Upload Foto</label>
                                    <input type="file" name="foto" class="form-control" id="basicInput" accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Batal</span>
                                </button>
                                <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Edit Email Modal Content End-->

                <!--Edit Password Modal Content -->
                <div class="modal fade text-left modal-borderless" id="editpassword">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Password</h5>
                            </div>
                            <input type="hidden" wire:model="userId">
                            <div class="modal-body">

                                <div class="form-group has-icon-left">
                                    <label for="password">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" id="password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Batal</span>
                                </button>
                                <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Edit Password Modal Content End-->
            </form>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>