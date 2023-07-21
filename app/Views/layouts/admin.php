<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - SPPD</title>

    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/compiled/png/favicon.png" type="image/x-icon" />

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/iconly.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/extensions/sweetalert2/sweetalert2.min.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/extensions/simple-datatables/style.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/compiled/css/table-datatable.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/extensions/choices.js/public/assets/styles/choices.css" />
</head>

<body>
    <script src="<?= base_url(); ?>/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="<?= base_url(); ?>/assets/compiled/png/logo.png" alt="Logo" srcset="" /></a>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?= get_url(2, '') ? 'active' : '' ?>">
                            <a href="<?= route_to('home'); ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= get_url(2, 'diajukan') ? 'active' : '' ?> <?= get_url(2, 'diterima') ? 'active' : '' ?> <?= get_url(2, 'selesai') ? 'active' : '' ?> <?= get_url(2, 'diproses') ? 'active' : '' ?> has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>SPT</span>
                            </a>

                            <ul class="submenu">
                                <li class="submenu-item <?= get_url(2, 'diajukan') ? 'active' : '' ?>">
                                    <a href="<?= base_url('diajukan'); ?>" class="submenu-link">Diajukan</a>
                                </li>

                                <li class="submenu-item <?= get_url(2, 'diproses') ? 'active' : '' ?>">
                                    <a href="<?= base_url('diproses'); ?>" class="submenu-link">Diproses</a>
                                </li>

                                <li class="submenu-item <?= get_url(2, 'diterima') ? 'active' : '' ?>">
                                    <a href="<?= base_url('diterima'); ?>" class="submenu-link">Diterima</a>
                                </li>

                                <li class="submenu-item <?= get_url(2, 'selesai') ? 'active' : '' ?>">
                                    <a href="<?= base_url('selesai'); ?>" class="submenu-link">Selesai</a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item <?= get_url(2, 'kwitansi') ? 'active' : '' ?>">
                            <a href="<?= route_to('kwitansi'); ?>" class="sidebar-link">
                                <i class="bi bi-receipt"></i>
                                <span>Kwitansi</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= get_url(2, 'hasil') ? 'active' : '' ?>">
                            <a href="<?= route_to('hasil'); ?>" class="sidebar-link">
                                <i class="bi bi-book"></i>
                                <span>Laporan Perjalanan</span>
                            </a>
                        </li>

                        <?php if (get_user('role') == 'admin') : ?>
                            <li class="sidebar-item <?= get_url(2, 'users') ? 'active' : '' ?>">
                                <a href="<?= route_to('users'); ?>" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Kelola Akun</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="sidebar-title">Lainnya</li>

                        <li class="sidebar-item <?= get_url(2, 'setting') ? 'active' : '' ?>">
                            <a href="<?= route_to('setting'); ?>" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= route_to('logout'); ?>" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <?= $this->renderSection('content'); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= date('Y'); ?> &copy; SPPD</p>
                    </div>
                    <!-- <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a>
                        </p>
                    </div> -->
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url(); ?>/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?= base_url(); ?>/assets/compiled/js/app.js"></script>
    <script src="<?= base_url(); ?>/assets/extensions/jquery/jquery.min.js"></script>

    <!-- Need: Apexcharts -->
    <script src="<?= base_url(); ?>/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>assets/extensions/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="<?= base_url(); ?>/assets/static/js/pages/simple-datatables.js"></script>

    <?php if (get_url(2, '')) : ?>
        <script>
            <?php foreach ($users as $user) : ?>
                $.ajax({
                    url: "<?= base_url() . '/api/terlaksana/' . $user['id_users']; ?>",
                    async: false,
                    dataType: 'json',
                    success: function(chartData) {
                        var optionsProfileVisit = {
                            annotations: {
                                position: "back",
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            chart: {
                                type: "bar",
                                height: 300,
                            },
                            fill: {
                                opacity: 1,
                            },
                            plotOptions: {},
                            series: [{
                                name: "SPT",
                                data: chartData,
                            }],
                            colors: "#435ebe",
                            xaxis: {
                                categories: [
                                    "Jan",
                                    "Feb",
                                    "Mar",
                                    "Apr",
                                    "May",
                                    "Jun",
                                    "Jul",
                                    "Aug",
                                    "Sep",
                                    "Oct",
                                    "Nov",
                                    "Dec",
                                ],
                            },
                        };
                        var chartProfileVisit = new ApexCharts(
                            document.querySelector(`#chart-profile-visit-<?= $user['id_users']; ?>`),
                            optionsProfileVisit
                        );
                        chartProfileVisit.render();
                    }
                });
            <?php endforeach; ?>
        </script>
    <?php endif; ?>

    <script>
        let choices = document.querySelectorAll(".choices")
        let initChoice
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ",",
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                })
            } else {
                initChoice = new Choices(choices[i])
            }
        }
    </script>

    <!-- Sweetalert -->
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