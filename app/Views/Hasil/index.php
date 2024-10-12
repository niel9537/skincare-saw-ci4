<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
        <!-- /.card-header -->
        <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-cogs" aria-hidden="true"></i> Pilih Periode</h6>
        </div>
        <form id="periodeForm">
                <div class="row mt-3">
                        <div class="col-md-3">
                                <div class="card-body">
                                        <select class="form-select" name="tipe_kulit" id="tipe_kulitH">
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
                                        <select class="form-select" name="kategori_produk" id="kategori_produkH">
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

<!-- cek apakah ada data alternatif -->
<?php if (!empty($hasil)) : ?>
        <div class="card mt-4 shadow-sm">
                <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark align-self-center"><i class="fa fa-table"></i> Data Hasil</h6>
                        <div class="<?= $tipe_kulit == null ? 'd-none' : '' ?>">
                                <a class="btn btn-sm btn-primary align-self-center" href="/admin/hasil/cetak/produk/<?= $tipe_kulit . '/' . $id_kategori ?>"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                                <a class="btn btn-sm btn-danger align-self-center <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>" href="/hasil/hapus/produk/<?= $tipe_kulit . '/' . $id_kategori ?>" onclick="return confirm('Apakah yakin?')"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                        </div>
                </div>
                <div class="card-body m-2">
                        <div class="table-responsive">
                                <table id="#" class="table table-striped">
                                        <thead>
                                                <th>No</th>
                                                <th>Tipe Kulit</th>
                                                <th>Kategori Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Nilai Preferensi</th>
                                        </thead>
                                        <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($hasil as $row) : ?>
                                                        <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td>
                                                                        <?= $row['kode_tipekulit'] == 'a1' ? 'Kering' : ($row['kode_tipekulit'] == 'a2' ? 'Berminyak' : 'Sensitif') ?>
                                                                </td>
                                                                <td>
                                                                        <?php foreach ($kategoriProduk as $data) : ?>
                                                                                <?= ($data['id_kategori'] == $row['id_kategori']) ? $data['nama_kategori_produk'] : '' ?>
                                                                        <?php endforeach ?>
                                                                </td>
                                                                <td><?= $row['nama_produk'] ?></td>
                                                                <td><?= $row['nilai'] ?></td>
                                                        </tr>
                                                <?php endforeach ?>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
        <!-- jika tidak ada data tampilkan pesan -->
<?php else : ?>
        <?php if ($tipe_kulit != null && $id_kategori != null) : ?>
                <div class="alert alert-info mt-5" role="alert">
                        Data yang dicari tidak ada, silahkan pilih produk dengan tipe kulit dan kategori yang lain!
                </div>
        <?php else : ?>
                <div class="alert alert-info mt-5" role="alert">
                        Silakan pilih tipe kulit dan ketegori produk terlebih dahulu untuk menampilkan data!
                </div>
        <?php endif ?>
<?php endif ?>

<?= $this->endSection('content') ?>