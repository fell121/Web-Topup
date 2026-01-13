<?php require '../template/headher.php' ?>
<?php $user = get("SELECT * FROM user ORDER BY id_user DESC"); ?>
<?php cekSuperadmin() ?>

<div class="card shadow p-3">
    <h5>Halaman Daftar User</h5>
</div>

<div class="card shadow p-3">

    <div class="mb-3">
        <a class="btn btn-primary" href="<?= $base_url; ?>admin/user/tambah.php">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">KWH</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php $i = 1 ?>
            <?php foreach ($user as $row) : ?>
                <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td class="text-center"><?= $row['username']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td class="text-center"><?= $row['kwh']; ?></td>

                    <!-- PERBAIKAN ROLE -->
                <td class="text-center">
                    <?= $row['role'] == 1 ? 'Admin' : 'User'; ?>
                </td>


                    <!-- PERBAIKAN FOTO -->
                    <td class="text-center">
                        <?php if (!empty($row['foto'])) : ?>
                            <img src="<?= $base_url; ?>assets/uploads/user/<?= $row['foto']; ?>" width="70" class="rounded">
                        <?php else : ?>
                            <img src="<?= $base_url; ?>assets/img/noprofil.png" width="70" class="rounded">
                        <?php endif ?>
                    </td>

                    <td class="text-center"><?= number_format($row['harga'], 0, ',', '.'); ?></td>

                    <td class="text-center text-nowrap">
                        <a class="btn btn-warning me-1"
                           href="<?= $base_url; ?>admin/user/ubah.php?id=<?= $row['id_user']; ?>">
                           <i class="bi bi-pencil-square"></i>
                        </a>

                        <a class="btn btn-danger button-delete"
                           href="<?= $base_url; ?>admin/user/hapus.php?id=<?= $row['id_user']; ?>">
                           <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>

<?php require '../template/foother.php' ?>
