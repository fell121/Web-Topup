<?php require '../template/headher.php' ?>

<div class="card shadow p-3">
    <h5>Profil </h5>
</div>

<div class="card shadow p-3">

    <div class="row g-3 mb-3">

        <div class="col-md-3">
            <?php if ($akun['foto']) : ?>
                <img src="<?= $base_url; ?>/assets/uploads/user/<?= $akun['foto']; ?>" alt="<?= $akun['email']; ?>" class="rounded w-100">
            <?php else : ?>
                <img src="<?= $base_url; ?>assets/img/noimage-potrait.png" alt="<?= $akun['email']; ?>" class="rounded w-100">
            <?php endif ?>
        </div>

        <div class="col-md-9">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="100">username</td>
                        <td width="5">:</td>
                        <td class="fw-bold"><?= $akun['username']; ?></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>:</td>
                        <td class="fw-bold"><?= $akun['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td class="fw-bold"><?= getRole($akun['role']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?php require '../template/foother.php' ?>