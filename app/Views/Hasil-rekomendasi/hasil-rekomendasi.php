<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .bg {
            height: 650px;
            background-image: url('../assets/img/bg.png');
            background-size: cover;
            /* Membuat gambar menutupi seluruh area tanpa mengubah rasio aspek */
            background-position: center;
            /* Pusatkan gambar background */
            background-repeat: no-repeat;
            /* Hindari gambar berulang */
        }
    </style>
</head>

<body background="">
    <div class="bg">
        <div class="container">
            <div class="row mt-2 text-center">
                <div class="card shadow-lg" style="margin-top: 30px;">
                    <div class="col-12 mb-3">
                        <h3 class="card-title fw-bold fs-4">Hasil Rekomendasi Produk Skincare</h3>
                        <hr>
                        <?php foreach ($hasilRekomendasi as $data) : ?>
                            <h6 class="mt-3">Nama Produk : </h6>
                            <div class="col-md-12">
                                <h5 class="fw-bold fs-5 mt-n5"><?= $data['nama_produk'] ?></h5>
                                <?php
                                if ($data['foto_produk'] == "") : ?>
                                    <img src="/foto-produk/no-image.jpg" width="250" alt="no-image">
                                <?php else : ?>
                                    <img src="/foto-produk/<?= $data['foto_produk'] ?>" width="250" alt="foto produk">
                                <?php endif ?>
                            </div>

                            <h3 class="fw-bold fs-5 mt-3">
                                <a href="<?= $data['link_produk'] ?>">Link Pembelian Produk</a>
                            </h3>
                        <?php endforeach ?>
                        <a href="/" class="btn btn-outline-success mt-4">Kembali</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>
    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/assets/js/main.js"></script>
    <script>
        // $(document).ready(function(){
        //     $('#myForm').submit(function(e){
        //         e.preventDefault(); // Mencegah reload halaman dan pengiriman form secara tradisional
        //         // Debug data yang akan dikirim
        //         console.log($(this).serialize());
        //         $.ajax({
        //             type: "POST",
        //             url: $(this).attr('action'), // Menggunakan atribut action dari form
        //             data: $(this).serialize(), // Mengambil semua data dari form
        //             success: function(response){
        //                 // Asumsi response berisi pesan yang ingin ditampilkan
        //                 $('#modalContent').html(response);
        //                 $('#resultModal').modal('show'); // Menampilkan modal
        //             }
        //         });
        //     });
        // });
    </script>

</body>

</html>