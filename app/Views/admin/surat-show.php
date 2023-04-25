<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail SPT</h3>
                <p class="text-subtitle text-muted">
                    Berisi informasi SPT
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.html">SPT</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Diajukan
                        </li>
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

    <!-- Responsive tables start -->
    <section class="section">
        <div class="row" id="description">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col">
                                    <h6>Nomor Surat</h6>
                                    <p class="fs-5 fw-bold"><?= $surat['nomor']; ?></p>
                                </div>
                                <div class="col-auto">
                                    <?php
                                    if ($surat['status'] == 'diajukan') :
                                    ?>
                                        <button class="btn btn-light-success btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#setujispt">
                                            <span class="fonticon-wrap">
                                                <i class="bi bi-check me-1"></i>
                                            </span> Terima SPT
                                        </button>

                                        <!-- Start Modal -->
                                        <div class="modal fade text-left modal-borderless" id="setujispt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Peringatan</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>

                                                    <form action="<?= route_to('diajukan-accept'); ?>" method="POST">

                                                        <div class="modal-body">
                                                            <p>
                                                                Apakah anda yakin ingin menerima SPT ini?
                                                            </p>
                                                        </div>
                                                        <input type="number" name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-primary ml-1" data-bs-dismiss="modal">

                                                                <span class="d-sm-block">Tidak</span>
                                                            </button>
                                                            <button name="submit" type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                                                <span class="d-sm-block">Ya</span>
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    <?php endif; ?>
                                    <?php
                                    if ($surat['status'] == 'diterima') :
                                    ?>
                                        <button class="disabled btn btn-outline btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#setujispt">
                                            SPT Diterima
                                        </button>
                                        <button class="btn btn-light-primary btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#setujispt">
                                            <span class="fonticon-wrap">
                                                <i class="bi bi-printer-fill me-1"></i>
                                            </span> Cetak SPT
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h6>Nama Kegiatan</h6>
                            <div class="alert bg-light-primary">
                                <p class="fs-6"><?= $surat['nama']; ?></p>
                            </div>
                            <div class="row">
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row d-flex flex-row">
                                                <div class="col-md-auto">
                                                    <div class="stats-icon blue mb-2 float-none">
                                                        <i class="iconly-boldDocument"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto">
                                                    <h6 class="text-muted font-semibold">Tanggal Diajukan</h6>
                                                    <h6 class="font-extrabold mb-0"><?= tanggal($surat['created_at']); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row d-flex flex-row">
                                                <div class="col-md-auto">
                                                    <div class="stats-icon green mb-2 float-none">
                                                        <i class="iconly-boldCalendar"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto">
                                                    <h6 class="text-muted font-semibold">Tanggal Pelaksanaan</h6>
                                                    <h6 class="font-extrabold mb-0"><?= tanggal($surat['tanggal_pelaksanaan']); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row d-flex flex-row">
                                                <div class="col-md-auto">
                                                    <div class="stats-icon red mb-2 float-none">
                                                        <i class="iconly-boldLocation"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto">
                                                    <h6 class="text-muted font-semibold">Tempat Pelaksanaan</h6>
                                                    <h6 class="font-extrabold mb-0"><?= $surat['tempat']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pegawai</h4>
                    </div>
                    <div class="card-content pb-4">
                        <?php foreach ($pegawai as $data) : ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="avatar avatar-lg">
                                            <img src="<?= base_url(); ?>/assets/compiled/jpg/<?= rand(1, 8) ?>.jpg" />
                                        </div>
                                        <div class="name ms-4">
                                            <h5 class="mb-1"><?= $data['nama']; ?></h5>
                                            <h6 class="text-muted mb-0"><?= $data['nip']; ?></h6>
                                            <h6 class="text-muted mb-0"><?= $data['pangkat']; ?></h6>
                                            <h6 class="text-muted mb-0"><?= $data['jabatan']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <ul class="list-inline m-0 d-flex">
                                                <li class="list-inline-item mail-delete">
                                                    <button type="button" class="btn btn-light-primary btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#editpegawai<?= $data['id_pegawai']; ?>">
                                                        <span class="fonticon-wrap d-inline">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </span>
                                                    </button>
                                                </li>
                                                <li class="list-inline-item mail-unread">
                                                    <button type="button" class="btn btn-light-danger btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#border-less<?= $data['id_pegawai']; ?>">
                                                        <span class="fonticon-wrap d-inline">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </span>
                                                    </button>
                                                </li>
                                            </ul>

                                            <!-- Edit Modal -->
                                            <div class="modal fade text-left modal-borderless" id="editpegawai<?= $data['id_pegawai']; ?>">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                    <form action="<?= route_to('pegawai-update'); ?>" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Pegawai</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Nama</label>
                                                                    <input required value="<?= $data['nama']; ?>" type="text" name="nama" class="form-control" placeholder="Masukkan Nama" id="name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <input required value="<?= $data['jabatan']; ?>" type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" id="jabatan">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nip">NIP</label>
                                                                    <input type="text" value="<?= $data['nip']; ?>" name="nip" class="form-control" placeholder="Masukkan NIP" id="nip">
                                                                    <p>
                                                                        <small class="text-muted">*Kosongkan jika tidak memiliki NIP</small>
                                                                    </p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="pangkat">Pangkat/Gol</label>
                                                                    <input type="text" value="<?= $data['pangkat']; ?>" name="pangkat" class="form-control" placeholder="Masukkan Pangkat" id="pangkat">
                                                                    <p>
                                                                        <small class="text-muted">*Kosongkan jika tidak memiliki Pangkat</small>
                                                                    </p>
                                                                </div>
                                                                <input name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                                <input name="id_pegawai" value="<?= $data['id_pegawai']; ?>" hidden>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                                    <span class="d-sm-block">Submit</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Edit Modal End -->

                                            <!--BorderLess Modal Content -->
                                            <div class="modal fade text-left modal-borderless" id="border-less<?= $data['id_pegawai']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Peringatan</h5>
                                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="<?= route_to('pegawai-delete'); ?>" method="POST">
                                                            <div class="modal-body">
                                                                <p>
                                                                    Apakah anda yakin ingin menghapus pegawai ini?
                                                                </p>
                                                            </div>

                                                            <input type="number" hidden value="<?= $data['id_pegawai']; ?>" name="id_pegawai">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                                                    <span class="d-sm-block">Tidak</span>
                                                                </button>

                                                                <button name="submit" type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                                                    <span class="d-sm-block">Ya</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="px-4">
                            <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3" data-bs-toggle="modal" data-bs-target="#tambahpegawai">
                                Tambah Pegawai
                            </button>
                            <div class="modal fade text-left modal-borderless" id="tambahpegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form action="<?= route_to('pegawai-save'); ?>" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Pegawai</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input required type="text" name="nama" class="form-control" placeholder="Masukkan Nama" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="jabatan">Jabatan</label>
                                                    <input required type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" id="jabatan">
                                                </div>

                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" id="nip">
                                                    <p>
                                                        <small class="text-muted">*Kosongkan jika tidak memiliki NIP</small>
                                                    </p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="pangkat">Pangkat/Gol</label>
                                                    <input type="text" name="pangkat" class="form-control" placeholder="Masukkan Pangkat" id="pangkat">
                                                    <p>
                                                        <small class="text-muted">*Kosongkan jika tidak memiliki Pangkat</small>
                                                    </p>
                                                </div>
                                                <input name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <span class="d-sm-block">Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

</div>
<?= $this->endSection(); ?>