<?php require '../template/headher.php' ?>

<?php $foto = get("SELECT * FROM foto ORDER BY id_foto ASC"); ?>

<div class="card shadow p-3">
    <h5>Halaman foto</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/foto/tambah.php" role="button">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Foto</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">urutan</th>
                    <th class="text-center">gambar</th>
                    <th class="text-center">aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($foto as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $row['foto']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td class="text-center"><?= $row['urutan']; ?></td>
                        <td class="text-center">
                            <?php if ($row['gambar']) : ?>
                                <img src="<?= $base_url; ?>/assets/img/fotogaleri/<?= $row['gambar']; ?>" alt="<?= $row['deskripsi']; ?>" width="70">
                            <?php else : ?>
                                <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="<?= $row['deskripsi']; ?>" width="70">
                            <?php endif ?>
                        </td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/foto/ubah.php?id=<?= $row['id_foto']; ?>" role="button"><i class='bx bx-edit-alt'></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/foto/hapus.php?id=<?= $row['id_foto']; ?>" role="button"><i class='bx bx-trash'></i></a>
                        </td>

                <?php endforeach ?>

            </tbody>
        </table>
    </div>

</div>

<?php require '../template/foother.php' ?>