<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Perjalanan Tugas</h3>
                <p class="text-subtitle text-muted">
                    Daftar SPT yang telah diajukan.
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
    </div>

    <a class="btn btn-primary rounded-pill mb-4" href="<?= base_url('diajukan/add'); ?>">Ajukan SPT Baru</a>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tempat Pelaksanaan</th>
                            <th>Tanggal diajukan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Graiden</td>
                            <td>vehicula.aliquet@semconsequat.co.uk</td>
                            <td>076 4820 8838</td>
                            <td>Offenburg</td>
                            <td>
                                <a href="" class="btn btn-light-primary btn-icon action-icon">
                                    <span class="fonticon-wrap">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </a>

                                <a href="" class="btn btn-light-warning btn-icon action-icon">
                                    <span class="fonticon-wrap">
                                        <i class="bi bi-pencil-fill"></i>
                                    </span>
                                </a>

                                <a href="" class="btn btn-light-danger btn-icon action-icon">
                                    <span class="fonticon-wrap">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>