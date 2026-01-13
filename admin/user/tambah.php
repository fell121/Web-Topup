<?php require '../template/headher.php' ?>
<?php cekSuperadmin() ?>

<?php
if (isset($_POST['submit'])) {

    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $alamat   = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));
    $role     = (int) $_POST['role'];
    $kwh      = (int) $_POST['kwh'];
    $hargaInp = (int) ($_POST['harga'] ?? 0);

    // PASSWORD
    if (strlen($_POST['password']) < 8) {
        $_SESSION['gagal'] = 'Password minimal 8 karakter';
        redirectTo('admin/user/tambah.php');
        exit;
    }
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // HARGA (MANUAL ATAU OTOMATIS)
    if ($hargaInp > 0) {
        $harga = $hargaInp; // MANUAL
    } else {
        // OTOMATIS DARI KWH
        switch ($kwh) {
            case 450:  $harga = 10000; break;
            case 900:  $harga = 20000; break;
            case 1300: $harga = 30000; break;
            case 2200: $harga = 40000; break;
            case 3500: $harga = 50000; break;
            default:
                $_SESSION['gagal'] = 'KWH tidak valid';
                redirectTo('admin/user/tambah.php');
                exit;
        }
    }

    // VALIDASI FOTO
    if ($_FILES['foto']['error'] === 4) {
        $_SESSION['gagal'] = 'Foto wajib diupload';
        redirectTo('admin/user/tambah.php');
        exit;
    }

    $foto = upload(
        'foto',
        ['jpg','jpeg','png'],
        5000,
        '../../assets/uploads/user/'
    );

    if (!$foto) {
        redirectTo('admin/user/tambah.php');
        exit;
    }

    // INSERT USER
    mysqli_query($koneksi, "
        INSERT INTO user
        (email, password, role, username, foto, alamat, kwh, harga)
        VALUES
        ('$email', '$password', $role, '$username', '$foto', '$alamat', $kwh, $harga)
    ");

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'User berhasil ditambahkan';
        redirectTo('admin/user');
    } else {
        $_SESSION['gagal'] = 'User gagal ditambahkan';
        redirectTo('admin/user/tambah.php');
    }
}
?>

<div class="card shadow p-3">
    <h5>Halaman Tambah User</h5>
</div>

<div class="card shadow p-3">
<form method="post" enctype="multipart/form-data">

<div class="row mb-3">

<!-- FOTO -->
<div class="col-md-4">
    <label class="form-label">Foto *</label>
    <input class="form-control mb-2" type="file" name="foto" id="fotoInput" required>
    <img src="<?= $base_url; ?>assets/img/noprofil.png" id="preview" class="rounded w-100">
</div>

<!-- DATA -->
<div class="col-md-8">

<div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" class="form-control" name="email" required>
</div>

<div class="mb-3">
    <label class="form-label">Username *</label>
    <input type="text" class="form-control" name="username" required>
</div>

<div class="mb-3">
    <label class="form-label">Password *</label>
    <input type="password" class="form-control" name="password" minlength="8" required>
</div>

<div class="mb-3">
    <label class="form-label">Role *</label>
    <select class="form-select" name="role" required>
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Alamat *</label>
    <textarea class="form-control" name="alamat" required></textarea>
</div>

<div class="mb-3">
    <label class="form-label">KWH Rumah *</label>
    <select class="form-select" name="kwh" id="kwh" onchange="setHarga()" >
        <option value="">-- Pilih KWH --</option>
        <option value="450">450 VA</option>
        <option value="900">900 VA</option>
        <option value="1300">1300 VA</option>
        <option value="2200">2200 VA</option>
        <option value="3500">3500 VA</option>
    </select>
</div>

<!-- INPUT HARGA MANUAL -->
<div class="mb-3">
    <label class="form-label">Harga / Bulan (Rp)</label>
    <input type="number" class="form-control" name="harga" id="harga" placeholder="Kosongkan untuk otomatis">
    <small class="text-muted">
        Kosongkan jika ingin harga otomatis dari KWH
    </small>
</div>

</div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="<?= $base_url; ?>admin/user" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Cancel
    </a>
    <button type="submit" name="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Submit
    </button>
</div>

</form>
</div>



</form>
</div>

<?php require '../template/foother.php' ?>
