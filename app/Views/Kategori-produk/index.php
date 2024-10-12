<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <!-- /.card-header -->
    <div class="card-header py-3 d-flex justify-content-end align-items-center">
        <!-- <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-cogs" aria-hidden="true"></i> <?= $title ?></h6> -->
        <a href="<?= base_url('/admin/kategori-produk/tambah/') ?>" class="btn btn-sm btn-primary <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div>
</div>

<!-- notifikasi pesan -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
<?php endif ?>
<!-- cek apakah ada data kategori -->
<?php if (!empty($kategoriProduk)) : ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-body m-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped datatable">
                    <thead>
                        <th>No</th>
                        <th>Kategori Produk</th>
                        <th class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($kategoriProduk as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_kategori_produk'] ?></td>
                                <td class="<?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>">
                                    <form action="/admin/kategori-produk/edit/<?= $row['id_kategori'] ?>" method="get" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="GET">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                    <form action="/admin/kategori-produk/hapus/<?= $row['id_kategori'] ?>" method="post" class="d-inline">
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