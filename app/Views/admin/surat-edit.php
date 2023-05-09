<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit SPT</h3>
                <p class="text-subtitle text-muted">
                    Silakan lengkapi form berikut.
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

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <form action="<?= base_url('diajukan/update'); ?>" method="POST" class="form form-horizontal">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form SPT</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <input value="<?= $surat['id_surat_tugas']; ?>" required name="id_surat" hidden />
                                        <div class="col-md-3">
                                            <label for="first-name-horizontal">Nama Kegiatan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['nama']; ?>" autofocus required type="text" id="first-name-horizontal" class="form-control" name="nama" placeholder="Masukkan Nama Kegiatan" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email-horizontal">Nomor Surat</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['nomor']; ?>" required type="text" id="email-horizontal" class="form-control" name="nomor" placeholder="Masukkan Nomor Surat" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dasar-surat">Dasar Surat</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <textarea required name="dasar" id="dasar-surat" class="form-control" cols="30" rows="5" placeholder="Masukkan Dasar Surat"><?= $surat['dasar']; ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tanggal-pelaksanaan">Tanggal Pelaksanaan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['tanggal_pelaksanaan']; ?>" required type="date" id="tanggal-pelaksanaan" class="form-control" name="tanggal_pelaksanaan" placeholder="Password" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="waktu-pelaksanaan">Waktu Pelaksanaan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['waktu']; ?>" required type="text" id="waktu-pelaksanaan" class="form-control" name="waktu" placeholder="Masukkan Waktu Pelaksanaan" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tempat-pelaksanaan">Tempat Pelaksanaan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['tempat']; ?>" required type="text" id="tempat-pelaksanaan" class="form-control" name="tempat" placeholder="Masukkan Tempat Pelaksanaan" />
                                        </div>

                                        <div class="col-md-3">
                                            <label for="first-name-horizontal">Tipe SPT</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <input <?= $surat['tipe'] == 'sekda' ? 'checked' : ''; ?> class="form-check-input" value="sekda" type="radio" name="tipe" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    SPT Sekretaris Daerah
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input <?= $surat['tipe'] == 'bupati' ? 'checked' : ''; ?> class="form-check-input" value="bupati" type="radio" name="tipe" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    SPT Bupati
                                                </label>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Yang Bertanda Tangan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="nominal-horizontal">Jabatan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['ttd_jabatan']; ?>" required type="text" id="nominal-horizontal" class="form-control" name="ttd_jabatan" placeholder="BUPATI TANGGAMUS SEKRETARIS DAERAH KABUPATEN" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nominal-horizontal">Nama Penjabat</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['ttd_nama']; ?>" required type="text" id="nominal-horizontal" class="form-control" name="ttd_nama" placeholder="Masukkan Nama Penjabat" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nominal-horizontal">Golongan Penjabat</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['ttd_golongan']; ?>" required type="text" id="nominal-horizontal" class="form-control" name="ttd_golongan" placeholder="Pembina Utama Madya" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nominal-horizontal">NIP Penjabat</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input value="<?= $surat['ttd_nip']; ?>" required type="text" id="nominal-horizontal" class="form-control" name="ttd_nip" placeholder="Masukkan NIP Penjabat" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                            Ajukan
                        </button>
                        <a href="<?= base_url('diajukan'); ?>" class="btn btn-light-secondary me-1 mb-1">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->

</div>
<?= $this->endSection(); ?>