<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Edit <?= $title ?></h6>
    </div>

    <form action="/admin/brand/update/<?= $brand['id_brand'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <input type="hidden" name="id" value="<?= $brand['id_brand'] ?>">
            <div class="form-group col-md-6 mt-2">
                <label class="form-label">Kode Brand</label>
                <input type="text" name="kode" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : ''; ?>" value="<?= $brand['kode_brand'] ?>" readonly />
                <div class="invalid-feedback">
                    <?= $validation->getError('kode'); ?>
                </div>
            </div>
            <div class="form-group col-md-6 mt-2">
                <label class="form-label">Nama Brand</label>
                <input autocomplete="off" type="text" name="nama_brand" class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : ''; ?>" value="<?= $brand['nama_brand'] ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_brand'); ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/brand') ?>" class="btn btn-secondary btn-sm">
                <i class="bi bi-backspace"></i> <span class="text">Kembali</span>
            </a>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>