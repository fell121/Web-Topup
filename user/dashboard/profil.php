<?php require '../template/headher.php'; ?>

<div class="card shadow p-3">
    <h5>Profil</h5>
</div>

<div class="card shadow p-3">

<?php if (!empty($akun)) : ?>
    <div class="row g-3 mb-3">

        <!-- FOTO -->
        <div class="col-md-3 text-center">
            <img
                src="<?= $akun['foto']
                    ? $base_url . 'assets/uploads/user/' . $akun['foto']
                    : $base_url . 'assets/img/noimage-potrait.png'; ?>"
                alt="<?= htmlspecialchars($akun['email']); ?>"
                class="rounded w-100">
        </div>

        <!-- DATA -->
        <div class="col-md-9">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <td width="120">Username</td>
                        <td width="10">:</td>
                        <td class="fw-bold"><?= htmlspecialchars($akun['username']); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td class="fw-bold"><?= htmlspecialchars($akun['email']); ?></td>
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
<?php else : ?>
    <p class="text-center text-muted mb-0">
        Data profil tidak ditemukan.
    </p>
<?php endif; ?>

</div>

<?php require '../template/foother.php'; ?>
