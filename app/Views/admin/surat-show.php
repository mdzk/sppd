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
                        <li class="breadcrumb-item active" aria-current="page">
                            SPT
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

        <?php if ($jumlah_pegawai == 0) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <p>Penting! Harap Tambahkan Pegawai yang akan Melaksanakan SPT agar Data Dapat Diverifikasi</p>
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
                                    if ($surat['status'] !== 'diajukan') :
                                    ?>
                                        <button class="disabled btn btn-outline btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#setujispt">
                                            SPT <?= $surat['status']; ?>
                                        </button>
                                    <?php endif; ?>
                                    <?php if (empty($kwitansi[0])) : ?>
                                        <?php if (get_user('role') == 'user' || get_user('role') == 'admin') : ?>
                                            <button class="btn btn-light-warning btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#kwitansi">
                                                <span class="fonticon-wrap">
                                                    <i class="bi bi-receipt me-1"></i>
                                                </span> Ajukan Kwitansi
                                            </button>

                                            <!-- Ajukan Kwitansi Modal -->
                                            <div class="modal fade text-left modal-borderless" id="kwitansi">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                    <form action="<?= route_to('kwitansi-save'); ?>" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Buat Kwitansi</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="jabatan">Nominal</label>
                                                                    <input required type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal" id="jabatan">
                                                                </div>

                                                                <input name="id_surat_tugas" value="<?= $surat['id_surat_tugas']; ?>" hidden>
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
                                            <!-- Ajukan Kwitansi Modal End -->
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($kwitansi[0])) : ?>


                                        <button class="btn btn-light-warning btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#lihatkwitansi">
                                            <span class="fonticon-wrap">
                                                <i class="bi bi-receipt me-1"></i>
                                            </span> Lihat Kwitansi
                                        </button>

                                        <!-- Lihat Kwitansi Modal -->
                                        <div class="modal fade text-left modal-borderless" id="lihatkwitansi">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Kwitansi</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="jabatan">Diterima dari</label>
                                                            <input required disabled value="<?= $kwitansi[0]['sumber']; ?>" type="text" name="sumber" class="form-control" placeholder="Masukkan Data" id="jabatan">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan">Nominal</label>
                                                            <input required disabled value="<?= $kwitansi[0]['nominal']; ?>" type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal" id="jabatan">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan">Terbilang</label>
                                                            <input required disabled value="<?= terbilang($kwitansi[0]['nominal']); ?>" type="text" class="form-control text-capitalize" placeholder="Masukkan Nominal" id="jabatan">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan">Kode Rekening</label>
                                                            <input required disabled value="<?= $kwitansi[0]['kode_rekening']; ?>" type="text" class="form-control text-capitalize" placeholder="Masukkan Nominal" id="jabatan">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan">Uraian</label>
                                                            <input required disabled value="<?= $kwitansi[0]['uraian']; ?>" type="text" class="form-control text-capitalize" placeholder="Masukkan Nominal" id="jabatan">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jabatan">Status Kwintasi</label>
                                                            <p class="badge bg-<?= $kwitansi[0]['status_kwitansi'] == 'diajukan' ? 'danger' : 'success'; ?>"> <?= $kwitansi[0]['status_kwitansi']; ?></p>
                                                        </div>

                                                        <input name="id_surat_tugas" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                    </div>
                                                    <?php if ($kwitansi[0]['status_kwitansi'] == 'diterima') : ?>
                                                        <div class="modal-footer">
                                                            <form action="<?= route_to('pdf-kwitansi'); ?>" method="post">
                                                                <input name="id_surat_tugas" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                                <button name="submit" type="submit" class="btn btn-primary btn-icon action-icon fw-bold h-auto">
                                                                    <span class="fonticon-wrap">
                                                                        <i class="bi bi-printer-fill me-1"></i>
                                                                    </span> Cetak Kwitansi
                                                                </button>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Lihat Kwitansi Modal End -->

                                        <?php if ($surat['status'] == "diajukan") : ?>
                                            <?php if (get_user('role') == 'user') : ?>
                                                <button class="btn btn-light-warning btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#editkwitansi">
                                                    <span class="fonticon-wrap">
                                                        <i class="bi bi-pencil-fill me-1"></i>
                                                    </span> Edit Kwitansi
                                                </button>

                                                <!-- Edit Kwitansi Modal -->
                                                <div class="modal fade text-left modal-borderless" id="editkwitansi">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                        <form action="<?= route_to('kwitansi-update'); ?>" method="POST">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Detail Kwitansi</h5>
                                                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="jabatan">Diterima dari</label>
                                                                        <input required value="<?= $kwitansi[0]['sumber']; ?>" type="text" name="sumber" class="form-control" placeholder="Masukkan Data" id="jabatan">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="jabatan">Nominal</label>
                                                                        <input required value="<?= $kwitansi[0]['nominal']; ?>" type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal" id="jabatan">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="jabatan">Kode Rekening</label>
                                                                        <input required value="<?= $kwitansi[0]['kode_rekening']; ?>" type="text" name="kode_rekening" class="form-control" placeholder="Masukkan Kode Rekening" id="jabatan">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="jabatan">Uraian</label>
                                                                        <input required value="<?= $kwitansi[0]['uraian']; ?>" type="text" name="uraian" class="form-control" placeholder="Masukkan Uraian" id="jabatan">
                                                                    </div>

                                                                    <input name="id_kwitansi" value="<?= $kwitansi[0]['id_kwitansi']; ?>" hidden>
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
                                                <!-- Edit Kwitansi Modal End -->
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php
                                        if (!empty($kwitansi[0])) :
                                            if ($kwitansi[0]['status_kwitansi'] == "diajukan" && $surat['status'] == 'diajukan' && get_user('role') == 'admin' && $jumlah_pegawai > 0) :
                                        ?>

                                                <button class="btn btn-light-success btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#setujispt">
                                                    <span class="fonticon-wrap">
                                                        <i class="bi bi-check me-1"></i>
                                                    </span> Proses SPT
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

                                                            <form action="<?= route_to('diajukan-process'); ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <p>
                                                                        Apakah anda yakin ingin proses SPT ini?
                                                                    </p>
                                                                </div>
                                                                <input type="number" name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                                <input type="number" name="id_kwitansi" value="<?= $kwitansi[0]['id_kwitansi'] ?>" hidden>
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
                                        <?php endif;
                                        endif; ?>

                                        <?php
                                        if (!empty($kwitansi[0])) :
                                            if ($kwitansi[0]['status_kwitansi'] == "diajukan" && $surat['status'] == 'diproses' && get_user('role') == 'pimpinan' && $jumlah_pegawai > 0) :
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
                                                                        Apakah anda yakin ingin terima SPT ini?
                                                                    </p>
                                                                </div>
                                                                <input type="number" name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                                <input type="number" name="id_kwitansi" value="<?= $kwitansi[0]['id_kwitansi'] ?>" hidden>
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
                                        <?php endif;
                                        endif; ?>

                                        <?php
                                        if ($surat['status'] == 'diterima') :
                                        ?>

                                            <form method="POST" class="d-inline" action="<?= route_to('pdf-spt'); ?>">
                                                <input hidden name="id_surat" value="<?= $surat['id_surat_tugas']; ?>">

                                                <button name="submit" type="submit" class="btn btn-light-primary btn-icon action-icon fw-bold h-auto">
                                                    <span class="fonticon-wrap">
                                                        <i class="bi bi-printer-fill me-1"></i>
                                                    </span> Cetak SPT
                                                </button>
                                            </form>




                                            <?php if ($surat['bukti'] == NULL && $kwitansi[0]['status_kwitansi'] == 'diterima') : ?>
                                                <?php if (get_user('role') == 'user' || get_user('role') == 'admin') : ?>
                                                    <button class="btn btn-light-success btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#bukti">
                                                        <span class="fonticon-wrap">
                                                            <i class="bi bi-upload me-1"></i>
                                                        </span> Upload Bukti
                                                    </button>

                                                    <!-- Bukti Modal -->
                                                    <div class="modal fade text-left modal-borderless" id="bukti">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                            <?= form_open_multipart('diterima/finish'); ?>

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Bukti SPT</h5>
                                                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="file">Pilih Gambar</label>
                                                                        <input required type="file" name="bukti" class="form-control" id="file" accept="image/png, image/jpeg">
                                                                    </div>
                                                                    <input name="id_surat" value="<?= $surat['id_surat_tugas']; ?>" hidden>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                                        <span class="d-sm-block">Submit</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <?php echo form_close() ?>

                                                        </div>
                                                    </div>
                                                    <!-- Bukti Modal End -->
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if ($surat['bukti'] !== NULL) : ?>
                                            <button class="btn btn-light-success btn-icon action-icon fw-bold h-auto" data-bs-toggle="modal" data-bs-target="#bukti">
                                                <span class="fonticon-wrap">
                                                    <i class="bi bi-card-image me-1"></i>
                                                </span> Lihat Bukti
                                            </button>

                                            <!-- Bukti Modal -->
                                            <div class="modal fade text-left modal-borderless" id="bukti">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bukti SPT</h5>
                                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <img src="<?= base_url('bukti/' . $surat['bukti']); ?>" width="100%" alt="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Bukti Modal End -->
                                        <?php endif; ?>



                                    <?php endif; ?>
                                </div>
                            </div>

                            <h6>Tipe Surat</h6>
                            <p class="fs-6 fw-bold">
                                <?php if ($surat['tipe'] == "sekda") : ?>
                                    Sekretaris Daerah
                                <?php endif; ?>
                                <?php if ($surat['tipe'] == "bupati") : ?>
                                    Bupati
                                <?php endif; ?>
                            </p>

                            <h6>Nama Kegiatan</h6>
                            <div class="alert bg-light-primary">
                                <p class="fs-6"><?= $surat['nama']; ?></p>
                            </div>

                            <h6>Dasar Surat</h6>
                            <p class="fs-6"><?= $surat['dasar']; ?></p>
                            <div class="row">
                                <div class=" col-lg-3 col-md-3 col-sm-12">
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
                                <div class=" col-lg-3 col-md-3 col-sm-12">
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
                                <div class=" col-lg-3 col-md-3 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row d-flex flex-row">
                                                <div class="col-md-auto">
                                                    <div class="stats-icon purple mb-2 float-none">
                                                        <i class="iconly-boldTime-Circle"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto">
                                                    <h6 class="text-muted font-semibold">Waktu Pelaksanaan</h6>
                                                    <h6 class="font-extrabold mb-0">Pukul <?= $surat['waktu']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-sm-12">
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
                        <h4 class="card-title">Yang Bertanda Tangan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-12">
                                    <h6>Jabatan</h6>
                                    <p class="fs-5 fw-bold"><?= $surat['ttd_jabatan']; ?></p>
                                </div>
                                <div class="col-12">
                                    <h6>Nama</h6>
                                    <p class="fs-5 fw-bold"><?= $surat['ttd_nama']; ?></p>
                                </div>
                                <div class="col-12">
                                    <h6>Golongan</h6>
                                    <p class="fs-5 fw-bold"><?= $surat['ttd_golongan']; ?></p>
                                </div>
                                <div class="col-12">
                                    <h6>NIP</h6>
                                    <p class="fs-5 fw-bold"><?= $surat['ttd_nip']; ?></p>
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
                        <h4>Memerintahkan</h4>
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
                                <?php
                                if ($surat['status'] == 'diajukan' && get_user('role') == 'user') :
                                ?>
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
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php
                    if ($surat['status'] == 'diajukan') :
                    ?>
                        <?php if (get_user('role') == 'user') : ?>
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
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

</div>
<?= $this->endSection(); ?>