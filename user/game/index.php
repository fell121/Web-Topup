<?php require '../template/headher.php' ?>

<?php $game = get("SELECT * FROM game ORDER BY id_game DESC"); ?>

<div class="card shadow p-3">
    <h5>Slide Game</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/game/tambah.php" role="button">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Game</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">icon</th>
                    <th class="text-center">Urutan</th>
                    <th class="text-center">link</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($game as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $row['game']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td class="text-center"> <i class="<?= $row['icon']; ?>"></i> </td>
                        <td class="text-center"><?= $row['urutan']; ?></td>
                        <td class="text-center"><?= $row['link']; ?></td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/game/ubah.php?id=<?= $row['id_game']; ?>" role="button"><i class='bx bx-edit-alt'></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/game/hapus.php?id=<?= $row['id_game']; ?>" role="button"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

</div>

<?php require '../template/foother.php' ?>