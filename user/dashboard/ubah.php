<?php require '../template/headher.php'; ?>

<?php
// Ambil user login
$id = (int) ($_SESSION['id_user'] ?? 0);
$user = getWhere("SELECT * FROM user WHERE id_user = $id");

if (!$user) {
    redirectTo('admin/dashboard');
    exit;
}

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $role  = (int) $_POST['role'];

    // CEK EMAIL JIKA DIUBAH
    if ($email !== $user['email']) {
        $cekEmail = getWhere("SELECT id_user FROM user WHERE email = '$email'");
        if ($cekEmail) {
            $_SESSION['gagal'] = 'Email sudah digunakan';
            redirectTo('user/dashboard');
            exit;
        }
    }

    // PASSWORD
    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) < 8) {
            $_SESSION['gagal'] = 'Password minimal 8 karakter';
            redirectTo('user/dashboard');
            exit;
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $password = $user['password'];
    }

    // FOTO
    if ($_FILES['foto']['error'] == 4) {
        $foto = $user['foto'];
    } else {
        $fotoBaru = upload('foto', ['jpg','png','jpeg'], 500, '../../assets/uploads/user/');
        if ($fotoBaru) {
            if (!empty($user['foto']) && file_exists('../../assets/uploads/user/' . $user['foto'])) {
                unlink('../../assets/uploads/user/' . $user['foto']);
            }
            $foto = $fotoBaru;
        } else {
            $foto = $user['foto'];
        }
    }

    // UPDATE USER
    $query = "
        UPDATE user SET
            email    = '$email',
            username    = '$username',
            password = '$password',
            foto     = '$foto'
        WHERE id_user = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) >= 0) {
        $_SESSION['berhasil'] = 'Data berhasil diubah';
    } else {
        $_SESSION['gagal'] = 'Data gagal diubah';
    }

    redirectTo('user/dashboard');
    exit;
}
?>

<div class="card shadow p-3">
    <h5>Edit Profil User</h5>
</div>

<div class="card shadow p-3">

<form method="post" enctype="multipart/form-data">

<div class="row mb-3">

<!-- FOTO -->
<div class="row mb-3">

        <div class="col-md-4">
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input class="form-control" type="file" id="upload" name="foto">
            </div>
            <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="" id="preview" class="rounded w-100 ">
        </div>

<div class="col-md-8">

<!-- FORM -->
<div class="col-md-8">

<div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" class="form-control" name="email" required value="<?= htmlspecialchars($user['email']); ?>">
</div>
<div class="mb-3">
    <label class="form-label">Username *</label>
    <input type="text" class="form-control" name="username" required value="<?= htmlspecialchars($user['username']); ?>">
</div>

<div class="mb-3">
    <label class="form-label">Password (opsional)</label>
    <input type="password" class="form-control" name="password" minlength="8">
</div>

</div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a class="btn btn-secondary px-4" href="<?= $base_url; ?>user/user">
        <i class="bi bi-arrow-left"></i> Cancel
    </a>
    <button type="submit" name="submit" class="btn btn-primary px-4">
        <i class="bi bi-save"></i> Submit
    </button>
</div>

</form>
</div>

<?php require '../template/foother.php'; ?>
