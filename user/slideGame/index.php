<?php require '../template/headher.php' ?>

<?php $slide = get("SELECT * FROM slide_game ORDER BY id_game DESC"); ?>

<div class="card shadow p-3">
    <h5>Slide Game</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/slideGame/tambah.php" role="button">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Game</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tombol</th>
                    <th class="text-center">Urutan</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($slide as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $row['nama_game']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td class="text-center"><?= $row['tombol']; ?></td>
                        <td class="text-center"><?= $row['urutan']; ?></td>
                        <td class="text-center">
                            <img src="<?= $base_url; ?>/assets/uploads/slideGame/<?= $row['gambar']; ?>" alt="<?= $row['nama_game']; ?>" width="70">
                        </td>
                        <td class="text-center text-nowrap">

                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/slideGame/ubah.php?id=<?= $row['id_game']; ?>" role="button"><i class='bx bx-edit-alt'></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/slideGame/hapus.php?id=<?= $row['id_game']; ?>" role="button"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

</div>

<?php require '../template/foother.php' ?>