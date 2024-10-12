<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="text-muted">Edit Sub Kriteria Untuk Kriteria "<b><?= ucwords($kriteria[0]['kriteria']) ?></b>"</h6>
        <a href="<?= base_url('/admin/sub-kriteria') ?>" class="btn btn-secondary btn-sm"></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <form action="/admin/sub-kriteria/update/<?= $subKriteria['id_sub_kriteria'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body px-5 py-4 mb-4">
            <div class="row">
                <input type="hidden" value="<?= $subKriteria['id_kriteria'] ?>" name="idKriteria">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nama Sub Kriteria</label>
                    <input type="text" name="subKriteria" class="form-control <?= ($validation->hasError('subKriteria')) ? 'is-invalid' : ''; ?>" value="<?= $subKriteria['sub_kriteria'] ?>" />
                    <div class="invalid-feedback">
                        <?= $validation->getError('subKriteria'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 mt-2">
                    <label class="form-label">Nilai</label>
                    <input type="number" name="nilai" value="<?= $subKriteria['nilai'] ?>" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button name="submit" value="submit" type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
            <a href="<?= base_url('/admin/sub-kriteria') ?>" class="btn btn-info btn-sm"></span>
                <i class="bi bi-backspace"></i> Kembali
            </a>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>