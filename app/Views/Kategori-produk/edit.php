<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Edit <?= $title ?></h6>
    </div>

    <form action="/admin/kategori-produk/update/<?= $kategori['id_kategori'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <input type="hidden" name="id" value="<?= $kategori['id_kategori'] ?>">
            <div class="form-group col-md-6 mt-2">
                <label class="form-label">Nama Kategori Produk</label>
                <input autocomplete="off" type="text" name="nama_kategori" class="form-control <?= ($validation->hasError('nama_kategori-produk')) ? 'is-invalid' : ''; ?>" value="<?= $kategori['nama_kategori_produk'] ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_kategori_produk'); ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/kategori-produk') ?>" class="btn btn-secondary btn-sm">
                <i class="bi bi-backspace"></i> <span class="text">Kembali</span>
            </a>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>