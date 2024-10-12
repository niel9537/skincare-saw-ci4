<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted"><?= $title ?></h6>
    </div>

    <form action="/admin/brand/simpan" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <div class="form-group col-md-6 mt-2">
                <label class="form-label">Kode Brand</label>
                <input id="kodeBrand" type="text" name="kode" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6 mt-2">
                <label class="form-label">Nama Brand</label>
                <input autofocus type="text" name="nama_brand" class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : ''; ?>" />
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_brand'); ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/brand') ?>" class="btn btn-secondary btn-sm"></span>
                <i class="bi bi-backspace"></i> <span class="text">Kembali</span>
            </a>
        </div>
    </form>
</div>

<?= $this->endSection('content') ?>