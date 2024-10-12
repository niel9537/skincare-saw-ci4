<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <!-- /.card-header -->
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-dark">Pilih Data Produk Berdasarkan Tipe Kulit dan Kategori Produk</h6>
        <?php if ($tipe_kulit != null && $tipe_kulit != null) : ?>
            <a class="btn btn-sm btn-primary align-self-center" href="/admin/hasil/produk/<?= $tipe_kulit . '/' .  $id_kategori ?>">
                <i class="fa fa-eye" aria-hidden="true"></i> Lihat Hasil
            </a>
        <?php endif ?>
    </div>
    <form id="periodeForm">
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card-body">
                    <select class="form-select" name="tipe_kulit" id="tipe_kulitP">
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
                    <select class="form-select" name="kategori_produk" id="kategori_produkP">
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
<?php if (!empty($nilaiAlternatif)) : ?>
    <h5 class="mt-5">Perhitungan Metode SAW</h5>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            alert("<?= session()->getFlashdata('pesan'); ?>");
        </script>
    <?php endif; ?>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Bobot Preferensi (W)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?> (<?= $key['type'] ?>)</th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <?php foreach ($kriteria as $key) : ?>
                                <td>
                                    <?= $key['bobot']; ?>
                                </td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Matriks Keputusan (X)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th>Alternatif</th>
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($nilaiAlternatif as $nama_produk => $nilaiKriteria) : ?>
                            <tr align="center">
                                <td><?= $no; ?></td>
                                <td align="left"><?= $nama_produk ?></td>
                                <?php foreach ($kriteria as $key) : ?>
                                    <td><?= $nilaiKriteria[$key['id_kriteria']] ?? '-'; ?></td>
                                <?php endforeach ?>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Matriks Ternormalisasi (R)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th>Alternatif</th>
                            <?php foreach ($kriteria as $key) : ?>
                                <th><?= $key['kode_kriteria'] ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($nilaiAlternatif as $nama_produk => $nilaiKriteria) : ?>
                            <tr align="center">
                                <td><?= $no; ?></td>
                                <td align="left"><?= $nama_produk ?></td>
                                <?php foreach ($kriteria as $index => $key) : ?>
                                    <?php
                                    // $test = array_key_exists($key['id_kriteria'], $nilaiKriteria);
                                    // dd($test);
                                    $nilai = array_key_exists($key['id_kriteria'], $nilaiKriteria) ? $nilaiKriteria[$key['id_kriteria']] : 0;
                                    if ($nilai !== 0) {
                                        // Asumsikan bahwa indeks $nilaiMax sesuai dengan urutan kriteria berdasarkan id_kriteria
                                        // Karena $nilaiMax diindeks mulai dari 0, kita gunakan $index yang juga dimulai dari 0 dalam loop kriteria
                                        if ($key['type'] == "Benefit") {
                                            $nilaiDiBagi = $nilai / $nilaiMax[$index];
                                        } else {
                                            $nilaiDiBagi = $nilaiMin[$index] / $nilai;
                                        }
                                    } else {
                                        $nilaiDiBagi = $nilai; // Jika tidak ada nilai, tetapkan 0 sebagai output
                                    }
                                    ?>
                                    <td><?= round($nilaiDiBagi, 3) ?></td>
                                <?php endforeach ?>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h6 class="text-muted"># Perhitungan/Nilai Preferensi (V)</h6>
        </div>
        <div class="card-body m-2">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th>Nama Alternatif</th>
                            <th>Perhitungan</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <form id="formHasil" method="post" action="/admin/perhitungan/simpan">
                        <?= csrf_field() ?>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($nilaiAlternatif as $nama_produk => $nilaiKriteria) : ?>
                                <tr align="center">
                                    <td><?= $no; ?></td>
                                    <td align="left"><?= $nama_produk ?></td>
                                    <td align="left">
                                        SUM
                                        <?php $nilai_v = 0; ?>
                                        <?php foreach ($kriteria as $index => $key) : ?>
                                            <?php
                                            $nilai = array_key_exists($key['id_kriteria'], $nilaiKriteria) ? $nilaiKriteria[$key['id_kriteria']] : 0;
                                            if ($nilai !== 0) {
                                                // Asumsikan bahwa indeks $nilaiMax sesuai dengan urutan kriteria berdasarkan id_kriteria
                                                // Karena $nilaiMax diindeks mulai dari 0, kita gunakan $index yang juga dimulai dari 0 dalam loop kriteria
                                                if ($key['type'] == "Benefit") {
                                                    $nilaiDiBagi = $nilai / $nilaiMax[$index];
                                                } else {
                                                    $nilaiDiBagi = $nilaiMin[$index] / $nilai;
                                                }
                                            } else {
                                                $nilaiDiBagi = $nilai; // Jika tidak ada nilai, tetapkan '-' sebagai output
                                            }
                                            $perkalianBobot = $key['bobot'] * $nilaiDiBagi;
                                            $nilai_v += $perkalianBobot;
                                            echo "(" . $key['bobot'] . " x " . round($nilaiDiBagi, 3) . ") ";
                                            ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= round($nilai_v, 3) ?></td>
                                </tr>
                                <input type="hidden" name="produk[]" value="<?= $nama_produk ?>">
                                <input type="hidden" name="tipe_kulit[]" value="<?= $tipe_kulit ?>">
                                <input type="hidden" name="id_kategori[]" value="<?= $id_kategori ?>">
                                <input type="hidden" name="nilai[]" value="<?= $nilai_v ?>">
                                <?php $no++; ?>
                            <?php endforeach ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <button id="simpanHasilPerhitungan" class="btn btn-primary mt-3 <?= $_SESSION['role'] == 1 ? '' : 'd-none' ?>" type="submit">Simpan Hasil Perhitungan</button>
    </form>

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