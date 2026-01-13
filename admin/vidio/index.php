<?php require '../template/headher.php' ?>

<?php $vidio = get("SELECT * FROM vidio ORDER BY id_vidio ASC"); ?>

<div class="card shadow p-3">
    <h5>Halaman Video</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/vidio/tambah.php" role="button">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Video</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Link</th>
                    <th class="text-center">Urutan</th>
                    <th class="text-center">aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($vidio as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $row['vidio']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td class="text-center"><?= $row['link']; ?></td>
                        <td class="text-center"><?= $row['urutan']; ?></td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/vidio/ubah.php?id=<?= $row['id_vidio']; ?>" role="button"><i class='bx bx-edit-alt'></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/vidio/hapus.php?id=<?= $row['id_vidio']; ?>" role="button"><i class='bx bx-trash'></i></a>
                        </td>

                <?php endforeach ?>

            </tbody>
        </table>
    </div>

</div>

<?php require '../template/foother.php' ?>