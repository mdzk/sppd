<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Laporan Hasil Perjalanan Baru</h3>
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

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <form action="<?= base_url('hasil/update'); ?>" method="POST" class="form form-horizontal">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Laporan Hasil Perjalanan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="first-name-horizontal">Nama Kegiatan</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <select class="choices form-select" name="surat_tugas_id">
                                                <option selected disabled>-- Pilih SPT --</option>
                                                <?php foreach ($surat as $data) : ?>
                                                    <option value="<?= $data['id_surat_tugas']; ?>" <?= $hasil['surat_tugas_id'] == $data['id_surat_tugas'] ? 'selected' : ''; ?>><?= $data['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email-horizontal">Notulis</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input required value="<?= $hasil['notulis']; ?>" type="text" id="email-horizontal" class="form-control" name="notulis" placeholder="Fungsional Analis Data Ilmiah Ahli Muda Bappelitbang Kabupaten Tanggamus." />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dasar-surat">Hasil Perjalanan Dinas</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <textarea required name="deskripsi" id="dasar-surat" class="form-control" cols="30" rows="5" placeholder="Pukul 09.30 WIB Sambutan FGD oleh Bpk. Suparman Arif. M.Pd menyampaikan terimakasih ..."><?= $hasil['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email-horizontal">Notulen</label>
                                        </div>
                                        <div class="col-md-9 form-group">
                                            <input required value="<?= $hasil['notulen']; ?>" type="text" id="email-horizontal" class="form-control" name="notulen" placeholder="Dimas Pamungkas" />
                                        </div>
                                        <input required value="<?= $hasil['id_hasil']; ?>" name="id_hasil" hidden />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->

</div>
<?= $this->endSection(); ?>