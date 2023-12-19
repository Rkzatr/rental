<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rental - Alat Fotografi</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>css/dropzone.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>css/datatables.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>js/dropzone.min.js"></script>
    <link href="<?= base_url() ?>css/main.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('Layout/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <?= $this->include('Layout/topbar') ?>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?= $this->renderSection('content') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?= $this->include('Layout/footer'); ?>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap mengakhirinya saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="slide-wrapper">
        <div class="slide">
            <div class="slide-close">
                <i class="fas fa-times"></i>
            </div>
            <div class="slide-image">
                <img src="http://rental.project/img/alat/1.jpg" alt="">
                <span class="kategori">kamera</span>
            </div>
            <div class="slide-content">
                <div class="slide-title text-center">
                    <h4>Alat Fotografi</h4>
                    <h6>
                        <span>stok :
                        </span>
                        <span class="stok">1</span>
                    </h6>
                </div>
                <div class="slide-text text-justify">
                    1. Sensor dan Resolusi:\r\n- Sensor CMOS DX-format 16.2 megapiksel.\r\n- Prosesor gambar EXPEED
                    2.\r\n2. Sistem Fokus:\r\n- 11 titik fokus otomatis (AF) dengan sensor AF tipe cross.\r\n3. ISO
                    Range:\r\n- Rentang ISO 100-6400 (dapat diperluas hingga 25,600).\r\n4. Layar LCD:\r\n- Layar sentuh
                    Vari-angle 3 inci dengan resolusi 921,000 titik.\r\n5. Perekaman Video:\r\n- Mampu merekam video
                    Full HD 1080p dengan autofocus kontinu.\r\n6. Fitur Tambahan:\r\n- Mode HDR (High Dynamic
                    Range).\r\n- Efek kreatif dan filter.\r\n- D-Movie mode untuk perekaman video.
                </div>
                <hr>
                <div class="slide-button d-flex justify-content-between">
                    <div class="harga">
                        <span class="currency">Rp.</span>
                        <span class="nominal">5000</span>
                    </div>
                    <a type="button" class="btn btn-success sewa" data-id="" href="#">
                        <i class="fas fa-shopping-cart"></i>
                        Masukkan
                        Keranjang</a>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>

        <script src="<?= base_url() ?>js/datatables.min.js"></script>
        <script src="<?= base_url() ?>js/sweetalert2@11.js"></script>
        <script src="<?= base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url() ?>js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url() ?>vendor/chart.js/Chart.min.js"></script>
        <script src="<?= base_url() ?>js/utils/puller.js"></script>

        <!-- Page level custom scripts -->

        <script>
        const cloud = new Puller();
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        const dt = new DataTable('.init-datatables', {
            responsive: true
        });
        const listMenu = <?= json_encode($menu) ?>;
        const menuContainer = $('.menu-container');
        const page = '<?= $page ?>';
        const baseUrl = '<?= base_url() ?>';
        </script>
        <script src="<?= base_url() ?>js/main.js"></script>
        <?= $this->renderSection('script') ?>
</body>

</html>