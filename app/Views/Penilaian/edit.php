<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Edit Penilaian Untuk Alternatif <b><?= $id_produk['nama_produk'] ?></b></h6>
        <a href="<?= base_url('/admin/penilaian/produk/') . $tipe_kulit . '/' . $id_kategori ?>" class="btn btn-secondary btn-sm"></span>
            <i class="bi bi-backspace"></i> Kembali
        </a>
    </div>
    <form action="/admin/penilaian/update/<?= $id_produk['id_produk'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="tipe_kulit" value="<?= $tipe_kulit ?>">
        <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
        <div class="card-body px-5 py-4 mb-2">
            <div class="row">
                <?php foreach ($penilaianData as $key => $data) : ?>
                    <div class="form-group col-md-6 mt-2 mb-2">
                        <input type="hidden" name="idKriteria[]" value="<?= $data['kriteria']['id_kriteria'] ?>">
                        <label class="form-label"><?= $data['kriteria']['kriteria'] ?></label>
                        <!-- Cek apakah 'penilaian' ada dan memiliki setidaknya satu elemen -->
                        <?php $nilai = isset($data['penilaian'][0]['nilai']) ? $data['penilaian'][0]['nilai'] : ''; ?>
                        <?php if ($data['kriteria']['ada_pilihan'] == 1) { ?>
                            <select name="nilai[]" class="form-control" required>
                                <?php foreach ($data['subkriteria'] as $key => $subItem) : ?>
                                    <!-- lakukan pengkondisian -->
                                    <option value="<?= $subItem['nilai'] ?>" <?= $subItem['nilai'] == $nilai ? "selected" : "" ?>><?= $subItem['sub_kriteria'] ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php } else {  ?>
                            <input type="number" name="nilai[]" class="form-control" step="0.001" value="<?= $nilai ?>" required autocomplete="off">
                        <?php } ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <!-- <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-sync-alt"></i> Reset</button> -->
        </div>
    </form>
</div>

<?= $this->endSection('content') ?>