<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Tambah Sub Kriteria Untuk Kriteria "<b><?= ucwords($kriteria['kriteria']) ?></b>"</h6>
        <a href="<?= base_url('/admin/sub-kriteria') ?>" class="btn btn-secondary btn-sm"></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <form action="/admin/sub-kriteria/simpan/<?= $kriteria['id_kriteria'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <div class="row">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nama Sub Kriteria</label>
                    <input autocomplete="off" type="text" name="subKriteria" class="form-control <?= ($validation->hasError('subKriteria')) ? 'is-invalid' : ''; ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('subKriteria'); ?>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nilai</label>
                    <input type="number" name="nilai" value="<?= old('nilai') ?>" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/sub-kriteria') ?>" class="btn btn-info btn-sm"></span>
                <i class="bi bi-backspace"></i> Kembali
            </a>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>