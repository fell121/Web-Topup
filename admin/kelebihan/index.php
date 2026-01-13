<?php require '../template/headher.php' ?>

<?php $kelebihan = get("SELECT * FROM kelebihan ORDER BY id_kelebihan DESC"); ?>

<div class="card shadow p-3">
    <h5>Slide Game</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/kelebihan/tambah.php" role="button">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Kelebihan</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">icon</th>
                    <th class="text-center">Urutan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($kelebihan as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= $row['kelebihan']; ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td class="text-center"> <i class="<?= $row['icon']; ?>"></i> </td>
                        <td class="text-center"><?= $row['urutan']; ?></td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/kelebihan/ubah.php?id=<?= $row['id_kelebihan']; ?>" role="button"><i class='bx bx-edit-alt'></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/kelebihan/hapus.php?id=<?= $row['id_kelebihan']; ?>" role="button"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

</div>

<?php require '../template/foother.php' ?>