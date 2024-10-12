<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted"><?= $title ?></h6>

    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <?= session()->getFlashdata('pesan') ?>
    <?php endif ?>
    <form action="/admin/produk/simpan" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <div class="row mt-4">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Kode Produk</label>
                    <input id="kodeProduk" type="text" name="kode_produk" class="form-control" readonly />
                    <div class="invalid-feedback">
                        <?= $validation->getError('kode_produk'); ?>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nama Produk</label>
                    <input autocomplete="off" type="text" name="nama_produk" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" placeholder="Masukan Nama Produk" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_produk'); ?>
                    </div>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="foto_produk" class="form-control" />
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Kategori Produk</label>
                    <select class="form-control" name="id_kategori">
                        <option value="#" disabled selected>-- Pilih Jenis Produk --</option>
                        <?php foreach ($kategoriProduk as $data) : ?>
                            <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori_produk'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Brand</label>
                    <select class="form-control" name="id_brand">
                        <option value="#" disabled selected>-- Pilih Brand --</option>
                        <?php foreach ($brand as $data) : ?>
                            <option value="<?= $data['id_brand'] ?>"><?= $data['nama_brand'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Tipe Kulit</label>
                    <select class="form-control" name="tipe_kulit">
                        <option value="#" disabled selected>-- Pilih Tipe Kulit --</option>
                        <option value="a1">Semua Jenis Kulit</option>
                        <option value="a2">Normal</option>
                        <option value="a3">Kering</option>
                        <option value="a4">Berminyak, Berjerawat</option>
                        <option value="a5">Sensitif</option>
                    </select>
                </div>
                <div class="form-group col-md-12 mt-2">
                    <label class="form-label">Link Produk</label>
                    <input type="text" name="link_produk" class="form-control" placeholder="Masukan link produk" />
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/produk') ?>" class="btn btn-info btn-sm">
                <i class="bi bi-backspace"></i> Kembali
            </a>
            <!-- <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-sync-alt"></i> Reset</button> -->
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>