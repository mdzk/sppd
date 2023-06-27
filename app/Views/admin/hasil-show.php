<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Laporan Perjalanan</h3>
                <p class="text-subtitle text-muted">
                    Berisi informasi Laporan Perjalanan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Laporan Perjalanan
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
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="d-inline" action="<?= route_to('pdf-hasil'); ?>">
                                <input hidden name="id_hasil" value="<?= $surat['id_hasil']; ?>">

                                <button name="submit" type="submit" class="mb-3 btn btn-light-primary btn-icon action-icon fw-bold h-auto">
                                    <span class="fonticon-wrap">
                                        <i class="bi bi-printer-fill me-1"></i>
                                    </span> Cetak
                                </button>
                            </form>

                            <h6>Notulis</h6>
                            <div class="alert bg-light-primary">
                                <p class="fs-6"><?= $surat['notulis']; ?></p>
                            </div>
                            <h6>Notulen</h6>
                            <p class="fs-6"><?= $surat['notulen']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="description">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h6>Nama Kegiatan</h6>
                            <p class="fs-6"><?= $surat['nama']; ?></p>
                            <h6>Dasar</h6>
                            <p class="fs-6"><?= $surat['dasar']; ?></p>
                            <div class="row">
                                <div class=" col-lg-6 col-md-6 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-0">
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
                                <div class=" col-lg-6 col-md-6 col-sm-12">
                                    <div class="card mb-0">
                                        <div class="card-body px-0">
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
                    <div class="card-content">
                        <div class="card-body">
                            <h6>Hasil Perjalanan Dinas</h6>
                            <p class="fs-6"><?= $surat['deskripsi']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

</div>
<?= $this->endSection(); ?>