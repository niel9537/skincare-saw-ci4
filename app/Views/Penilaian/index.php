<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <!-- /.card-header -->
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-cogs" aria-hidden="true"></i> Pilih Data Produk Berdasarkan Tipe Kulit dan Kategori Produk</h6>
    </div>
    <form id="periodeForm">
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card-body">
                    <select class="form-select" name="tipe_kulit" id="tipe_kulit">
                        <option value="#" disabled selected>-- Pilih Tipe Kulit --</option>
                        <option value="a1" <?= $tipe_kulit == 'a1' ? 'selected' : '' ?>>Semua Jenis Kulit</option>
                        <option value="a2" <?= $tipe_kulit == 'a2' ? 'selected' : '' ?>>Normal</option>
                        <option value="a3" <?= $tipe_kulit == 'a3' ? 'selected' : '' ?>>Kering</option>
                        <option value="a4" <?= $tipe_kulit == 'a4' ? 'selected' : '' ?>>Berminyak, Berjerawat</option>
                        <option value="a5" <?= $tipe_kulit == 'a5' ? 'selected' : '' ?>>Sensitif</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <select class="form-select" name="kategori_produk" id="kategori_produk">
                        <option value="#" disabled selected>-- Pilih Kategori Produk --</option>
                        <?php foreach ($kategoriProduk as $data) : ?>
                            <option value="<?= $data['id_kategori'] ?>" <?= $data['id_kategori'] == $id_kategori ? 'selected' : '' ?>><?= $data['nama_kategori_produk'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- notifikasi pesan -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
<?php endif ?>

<!-- cek apakah ada data alternatif -->
<?php if (!empty($produkList)) : ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Data Penilaian</h5>
            <!-- <a href="#tambah-kriteria" class="btn btn-sm btn-primary">Tambah Kriteria</a> -->
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($produkList as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td>
                                    <?php if (!empty(($row['isPenilaianExists']))) : ?>
                                        <!-- Tombol Edit -->
                                        <form action="/admin/penilaian/edit/<?= $row['id_produk'] ?>" method="get" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="tipe_kulit" value="<?= $tipe_kulit ?>">
                                            <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
                                            <input type="hidden" name="_method" value="GET">
                                            <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Edit</button>
                                        </form>
                                    <?php else : ?>
                                        <!-- Tombol Input -->
                                        <form action="/admin/penilaian/tambah/<?= $row['id_produk'] ?>" method="get" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="tipe_kulit" value="<?= $tipe_kulit ?>">
                                            <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
                                            <input type="hidden" name="_method" value="GET">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i> Input</button>
                                        </form>
                                    <?php endif; ?>
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
        Data produk tidak ada atau Silakan pilih yang lain untuk menampilkan data!
    </div>
<?php endif ?>
<?= $this->endSection('content') ?>