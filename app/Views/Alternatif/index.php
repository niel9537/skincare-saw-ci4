<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <!-- /.card-header -->
    <div class="card-header py-3 d-flex justify-content-end align-items-center">
        <!-- <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-cogs" aria-hidden="true"></i> Pilih Periode</h6> -->
        <a href="<?= base_url('/admin/produk/tambah') ?>" class="btn btn-sm btn-primary <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div>
</div>

<!-- notifikasi pesan -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
<?php endif ?>
<!-- cek apakah ada data alternatif -->
<?php if (!empty($alternatif)) : ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-body m-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped datatable">
                    <thead>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Image</th>
                        <th>Kategori</th>
                        <th>Brand</th>
                        <th>Tipe Kulit</th>
                        <th>Link Produk</th>
                        <th class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kode_produk'] ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td>
                                    <?php
                                    if ($row['foto_produk'] == '') : ?>
                                        <img src="/foto-produk/no-image.jpg" width="70" alt="no-image">
                                    <?php else : ?>
                                        <img src="/foto-produk/<?= $row['foto_produk'] ?>" width="70" alt="no-image">
                                    <?php endif ?>
                                </td>
                                <td><?= $row['nama_kategori_produk'] ?></td>
                                <td><?= $row['nama_brand'] ?></td>
                                <?php
                                if ($row['tipe_kulit'] == 'a1') {
                                    $tipeKulit = "Semua Jenis Kulit";
                                } elseif ($row['tipe_kulit'] == 'a2') {
                                    $tipeKulit = "Normal";
                                } elseif ($row['tipe_kulit'] == 'a3') {
                                    $tipeKulit = "Kering";
                                } elseif ($row['tipe_kulit'] == 'a4') {
                                    $tipeKulit = "Berminyak, Berjerawat";
                                } elseif ($row['tipe_kulit'] == 'a5') {
                                    $tipeKulit = "Sensitif"; 
                                } 
                                ?>
                                <td><?= $tipeKulit ?></td>
                                <td><a href="<?= $row['link_produk'] ?>" target="_blank">link produk</td>
                                <td class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
                                    <form action="/admin/produk/edit/<?= $row['id_produk'] ?>" method="get" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="GET">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                    <form action="/admin/produk/hapus/<?= $row['id_produk'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- jika tidak ada data tampilkan pesan -->
<?php else : ?>
    <div class="alert alert-info mt-5" role="alert">
        Data tidak ada, silahkan input data terlebih dahulu untuk menampilkan data!
    </div>
<?php endif ?>

<?= $this->endSection('content') ?>