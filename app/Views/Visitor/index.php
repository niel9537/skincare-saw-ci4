<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- cek apakah ada data visitor -->
<?php if (!empty($visitor)) : ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-body m-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped datatable">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>E/</th>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($visitor as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_visitor'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_visitor'] ?>"><i class="bi bi-eye-fill"></i> Detail</button>
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

<!-- modal detail -->
<?php
// dd($detailVisitor);
?>
<?php foreach ($detailVisitor as $data) : ?>
    <div class="modal fade" id="edit<?= $data['id_visitor'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data Pengunjung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-5 my-2 mb-5">
                    <table class="table-responsive border-0">
                        <tr>
                            <th>Nama Pengunjung</th>
                            <td>: <?= ucfirst($data['nama_visitor']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= $data['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Kategori Produk</th>
                            <td>:
                                <?php foreach ($kategoriProduk as $row) : ?>
                                    <?= $data['id_kategori_produk'] == $row['id_kategori'] ? $row['nama_kategori_produk'] : '' ?>
                                <?php endforeach ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kulit</th>
                            <td>:
                                <?= $data['kode_tipekulit'] == 'a1' ? 'Kering' : ($data['kode_tipekulit'] == 'a2' ? 'Berminyak' : 'Sensitif') ?>
                            </td>
                        </tr>
                        <?php
                        $firstValid = true; // Variabel untuk menandai baris pertama yang valid
                        ?>
                        <?php foreach ($nilaiKriteria as $index => $value) : ?>
                            <?php if ($value['id_visitor'] == $data['id_visitor']) : // Tambahkan kondisi if di sini 
                            ?>
                                <tr>
                                    <th><?= $firstValid ? 'Kriteria Yang Dipilih' : '' ?></th>
                                    <td>:
                                        <?php foreach ($kriteria as $row) : ?>
                                            <?= $value['id_kriteria'] == $row['id_kriteria'] ? $row['kriteria'] : '' ?>
                                        <?php endforeach ?>
                                        (
                                        <?php foreach ($subKriteria as $row) : ?>
                                            <?= $value['id_sub_kriteria'] == $row['id_sub_kriteria'] ? $row['sub_kriteria'] : '' ?>
                                        <?php endforeach ?>
                                        )
                                    </td>
                                </tr>
                                <?php $firstValid = false; // Setelah baris pertama yang valid ditampilkan, ubah menjadi false 
                                ?>
                            <?php endif; ?>
                        <?php endforeach ?>
                        <tr>
                            <th>Produk Yang Direkomendasikan</th>
                            <th>:
                                <i>
                                    <?php foreach ($produk as $row) : ?>
                                        <?= $data['id_produk'] == $row['id_produk'] ? $row['nama_produk'] : '' ?>
                                    <?php endforeach ?>
                                </i>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <td> :
                                <?php foreach ($produk as $row) : ?>
                                    <img src="/foto-produk/<?= $data['id_produk'] == $row['id_produk'] ? $row['foto_produk'] : '' ?>" class="img-tdumbnail" width="350" alt="">
                                <?php endforeach ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Skor Produk</th>
                            <td>: <?= $data['skor_produk'] ?></td>
                        </tr>
                        <tr>
                            <th>Link Produk</th>
                            <td> :
                                <a href="
                                <?php foreach ($produk as $row) : ?>
                                    <?= $data['id_produk'] == $row['id_produk'] ? $row['link_produk'] : '' ?>
                                <?php endforeach ?>
                                " target="_link">Link pembelian produk</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Large Modal-->
<?php endforeach ?>

<?= $this->endSection('content') ?>