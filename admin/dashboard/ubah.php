<?php require '../template/headher.php' ?>

<?php

$user = $akun;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if ($email != $user['email']) {
        $user = getWhere("SELECT * FROM user WHERE email = '$email'");
        if ($user) {
            $_SESSION['gagal'] = 'Data Gagal Ditambahkan, email Sudah Digunakan';
            redirectTo('admin/dashboard');
        }
    }

    $password = $_POST['password'];

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $password = $user['password'];
    }

    $email = $_POST['email'];
    $role = $_POST['role'];

    if ($_FILES['foto']['error'] == 4) {
        $foto = $user['foto'];
    } else {
        $foto = upload('foto', ['jpg', 'png', 'jpeg'], 500, '../../assets/uploads/user/');
        if ($foto) {
            unlink('../../assets/uploads/user/' . $user['foto']);
        }
    }

    $query = "UPDATE user SET
            email    = '$email',
            password    = '$password',
            email    = '$email',
            role    = '$role',
            foto    = '$foto'
            WHERE id_user = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Diubah';
        redirectTo('admin/dashboard');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah';
        redirectTo('admin/dashboard');
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Tambah User</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="upload" name="foto">
                </div>

                <?php if ($user['foto']) : ?>
                    <img src="<?= $base_url; ?>/assets/uploads/user/<?= $user['foto']; ?>" alt="<?= $user['email']; ?>" id="preview" class="rounded w-100 ">
                <?php else : ?>
                    <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="<?= $user['email']; ?>" id="preview" class="rounded w-100 ">
                <?php endif ?>

            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="email" class="form-label">email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" required value="<?= $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password </label>
                    <input type="password" class="form-control" id="password" name="password" minlength="8">
                </div>
                <div class="mb-3">
                    <label for="passwordconfirm" class="form-label">Konfirmasi Password </label>
                    <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm minlength=" 8" data-parsley-equalto="#password">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" required value="<?= $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Superadmin</option>
                        <option value="2" <?= $user['role'] == 2 ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
            </div>

        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/dashboard" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>