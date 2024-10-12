<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted"><?= $title ?></h6>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <?= session()->getFlashdata('pesan') ?>
    <?php endif ?>
    <form action="/admin/produk/update/<?= $produk['id_produk'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $produk['id_produk'] ?>">
        <div class="card-body px-5 py-4 mb-4">
            <div class="row mt-4">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" value="<?= $produk['kode_produk'] ?>" readonly />
                    <div class="invalid-feedback">
                        <?= $validation->getError('kode_produk'); ?>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nama Produk</label>
                    <input autocomplete="off" type="text" name="nama_produk" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" value="<?= $produk['nama_produk'] ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_produk'); ?>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Foto Produk</label>
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                            if ($produk['foto_produk'] == '') : ?>
                                <img src="/foto-produk/no-image.jpg" width="60" alt="no-image">
                            <?php else : ?>
                                <img src="/foto-produk/<?= $produk['foto_produk'] ?>" width="60" alt="no-image">
                            <?php endif ?>
                        </div>
                        <div class="col-md-10">
                            <input type="file" name="foto_produk" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Kategori Produk</label>
                    <select class="form-control" name="id_kategori">
                        <option value="#" disabled selected>-- Pilih Kategori Produk --</option>
                        <?php foreach ($kategoriProduk as $data) : ?>
                            <option value="<?= $data['id_kategori'] ?>" <?= $data['id_kategori'] == $produk['id_kategori'] ? 'selected' : '' ?>><?= $data['nama_kategori_produk'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Brand</label>
                    <select class="form-control" name="id_brand">
                        <option value="#" disabled selected>-- Pilih Brand --</option>
                        <?php foreach ($brand as $data) : ?>
                            <option value="<?= $data['id_brand'] ?>" <?= $data['id_brand'] == $produk['id_brand'] ? 'selected' : '' ?>><?= $data['nama_brand'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Tipe Kulit</label>
                    <select class="form-control" name="tipe_kulit">
                        <option value="#" disabled selected>-- Pilih Tipe Kulit --</option>
                        <option value="a1" <?= $produk['tipe_kulit'] == 'a1' ? 'selected' : '' ?>>Semua Jenis kulit</option>
                        <option value="a2" <?= $produk['tipe_kulit'] == 'a2' ? 'selected' : '' ?>>Normal</option>
                        <option value="a3" <?= $produk['tipe_kulit'] == 'a3' ? 'selected' : '' ?>>Kering</option>
                        <option value="a4" <?= $produk['tipe_kulit'] == 'a4' ? 'selected' : '' ?>>Berminyak, Berjerawat</option>
                        <option value="a5" <?= $produk['tipe_kulit'] == 'a5' ? 'selected' : '' ?>>Sensitif</option>
                    </select>
                </div>
                <div class="form-group col-md-12 mt-2">
                    <label class="form-label">Link Produk</label>
                    <input type="text" name="link_produk" class="form-control" value="<?= $produk['link_produk'] ?>" />
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/produk') ?>" class="btn btn-secondary btn-sm">
                <i class="bi bi-backspace"></i> <span class="text">Kembali</span>
            </a>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>