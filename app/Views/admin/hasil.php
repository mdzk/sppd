<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Hasil Perjalanan</h3>
                <p class="text-subtitle text-muted">
                    Daftar Perjalanan yang telah selesai.
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
    </div>
    <?php if (get_user('role') == 'user') : ?>
        <a class="btn btn-primary rounded-pill mb-4" href="<?= base_url('hasil/add'); ?>">+ Tambah Laporan Baru</a>
    <?php endif; ?>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tempat Pelaksanaan</th>
                            <th>Notulen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($hasil as $data) :
                        ?>
                            <tr>
                                <td><?= $data['nama']; ?></td>
                                <td><?= tanggal($data['tanggal_pelaksanaan']); ?></td>
                                <td><?= $data['tempat']; ?></td>
                                <td><?= $data['notulen'] ?></td>
                                <td>
                                    <a href="<?= base_url('hasil/detail/' . $data['id_hasil']); ?>" class="btn btn-light-primary btn-icon action-icon">
                                        <span class="fonticon-wrap">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </a>
                                    <?php if (get_user('role') == 'user') : ?>
                                        <a href="<?= base_url(''); ?>hasil/edit/<?= $data['id_hasil']; ?>" class="btn btn-light-warning btn-icon action-icon">
                                            <span class="fonticon-wrap">
                                                <i class="bi bi-pencil-fill"></i>
                                            </span>
                                        </a>

                                        <button class="btn btn-light-danger btn-icon action-icon" data-bs-toggle="modal" data-bs-target="#hapussurat<?= $data['id_hasil']; ?>">
                                            <span class=" fonticon-wrap">
                                                <i class="bi bi-trash-fill"></i>
                                            </span>
                                        </button>

                                        <!--Hapus Surat Modal Content -->
                                        <div class="modal fade text-left modal-borderless" id="hapussurat<?= $data['id_hasil']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Peringatan</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>

                                                    <form action="<?= route_to('hasil-delete'); ?>" method="POST">

                                                        <div class="modal-body">
                                                            <p>
                                                                Apakah anda yakin ingin menghapus Laporan Perjalanan ini?
                                                            </p>
                                                        </div>
                                                        <input type="number" name="id_hasil" value="<?= $data['id_hasil']; ?>" hidden>
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
                                        <!--Hapus Surat Modal Content End-->
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>