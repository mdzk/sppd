<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kwitansi</h3>
                <p class="text-subtitle text-muted">
                    Daftar Kwitansi pada SPT
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
                            Diterima
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No Kwitansi</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kwitansi as $data) :
                        ?>
                            <tr>
                                <td><?= $data['no_kwitansi']; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td><?= tanggal($data['tanggal_pelaksanaan']); ?></td>
                                <td><?= $data['status']; ?></td>
                                <td>
                                    <a href="<?= base_url('diajukan/detail/' . $data['id_kwitansi']); ?>" class="btn btn-light-primary btn-icon action-icon">
                                        <span class="fonticon-wrap">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </a>
                                    <a href="<?= base_url('diajukan/detail/' . $data['id_kwitansi']); ?>" class="btn btn-light-primary btn-icon action-icon">
                                        <span class="fonticon-wrap">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </a>

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