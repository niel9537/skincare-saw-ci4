<!doctype html>
<html lang="en">

<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

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

        <style>
                body {
                        font-family: 'monserat', sans-serif;
                }
        </style>
</head>

<body>
        <div class="m-3">
                <div class="text-center mb-3" style="text-align: center;">
                        <h3>Hasil Perangkingan Produk Skincare</h3>
                        <p>Berikut nilai preferensi dan hasil perankingan yang di dapat setelah dilakukan perhitungan di dalam Sistem Pendukung Keputusan Menggunakan Metode Simple Aditive Weight (SAW).</p>
                        <hr>
                </div>
                <div class="table-responsive d-flex justify-content-center mt-5">
                        <table id="#" class="table table-striped">
                                <thead>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Nilai Preferensi</th>
                                        <th><i>Ranking</i></th>
                                        <!-- <th>Status</th> -->
                                </thead>
                                <tbody>
                                        <?php $no = 1 ?>
                                        <?php $peringkat = 1 ?>
                                        <?php foreach ($hasil as $row) : ?>
                                                <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['nama_produk'] ?></td>
                                                        <td><?= $row['nilai'] ?></td>
                                                        <td class="fw-bold"><?= "(" . $peringkat++ . ")" ?></td>
                                                        <td class="fw-bold text-danger"><?= $row['status'] ?></td>
                                                </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                </div>
        </div>
        <!-- Vendor JS Files -->
        <script src="<?= base_url() ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/chart.js/chart.umd.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/echarts/echarts.min.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/quill/quill.min.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>

        <!-- ajax atau jQuery -->
        <script src="<?= base_url() ?>/assets/js/jquery-3.7.0.js"></script>

        <!-- Template Main JS File -->
        <script src="<?= base_url() ?>/assets/js/main.js"></script>

        <script>
                window.onload = function() {
                        window.print(); // Memanggil dialog print
                        window.onafterprint = function() {
                                window.history.back(); // Kembali ke halaman sebelumnya setelah print
                        }
                }
        </script>
</body>

</html>