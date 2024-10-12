<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <h6 class="text-muted">Data Kriteria</h6>
        <a href="<?= base_url('/admin/kriteria/tambah') ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
    </div>
    <div class="card-body m-2">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif ?>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped datatable">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Kriteria</th>
                    <th>Type</th>
                    <th>Bobot</th>
                    <th>Cara Penilaian</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($kriteria as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_kriteria'] ?></td>
                            <td><?= $row['kriteria'] ?></td>
                            <td><?= $row['type'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td><?= $row['ada_pilihan'] == 0 ? "Pilih Langsung" : "Input Sub Kriteria" ?></td>
                            <td>
                                <form action="/admin/kriteria/edit/<?= $row['id_kriteria'] ?>" method="get" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="GET">
                                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button>
                                </form>
                                <form action="/admin/kriteria/hapus/<?= $row['id_kriteria'] ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin?')"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>