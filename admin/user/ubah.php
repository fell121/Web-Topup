<?php require '../template/headher.php'; ?>
<?php cekSuperadmin(); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$user = getWhere("SELECT * FROM user WHERE id_user = $id");

if (!$user) {
    redirectTo('admin/user');
    exit;
}

if (isset($_POST['submit'])) {

    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $alamat   = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));
    $kwh      = (int) $_POST['kwh'];
    $role     = (int) $_POST['role'];
    $hargaInp = (int) ($_POST['harga'] ?? 0);

    // ================= CEK EMAIL DUPLIKAT =================
    if ($email !== $user['email']) {
        $cek = getWhere("SELECT id_user FROM user WHERE email = '$email'");
        if ($cek) {
            $_SESSION['gagal'] = 'Email sudah digunakan';
            redirectTo('admin/user/ubah.php?id=' . $id);
            exit;
        }
    }

    // ================= PASSWORD =================
    if (!empty($_POST['password'])) {
        if ($_POST['password'] !== $_POST['passwordconfirm']) {
            $_SESSION['gagal'] = 'Konfirmasi password tidak sesuai';
            redirectTo('admin/user/ubah.php?id=' . $id);
            exit;
        }
        if (strlen($_POST['password']) < 8) {
            $_SESSION['gagal'] = 'Password minimal 8 karakter';
            redirectTo('admin/user/ubah.php?id=' . $id);
            exit;
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $password = $user['password'];
    }

    // ================= HARGA (MANUAL / OTOMATIS) =================
    if ($hargaInp > 0) {
        $harga = $hargaInp; // manual dari admin
    } else {
        switch ($kwh) {
            case 450:  $harga = 10000; break;
            case 900:  $harga = 20000; break;
            case 1300: $harga = 30000; break;
            case 2200: $harga = 40000; break;
            case 3500: $harga = 50000; break;
            default:
                $_SESSION['gagal'] = 'KWH tidak valid';
                redirectTo('admin/user/ubah.php?id=' . $id);
                exit;
        }
    }

    // ================= FOTO =================
    if ($_FILES['foto']['error'] === 4) {
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

    // ================= UPDATE USER =================
    mysqli_query($koneksi, "
        UPDATE user SET
            email    = '$email',
            password = '$password',
            role     = $role,
            username = '$username',
            foto     = '$foto',
            alamat   = '$alamat',
            kwh      = $kwh,
            harga    = $harga
        WHERE id_user = $id
    ");

    if (mysqli_affected_rows($koneksi) >= 0) {
        $_SESSION['berhasil'] = 'Data berhasil diubah';
        redirectTo('admin/user');
    } else {
        $_SESSION['gagal'] = 'Data gagal diubah';
        redirectTo('admin/user/ubah.php?id=' . $id);
    }
    exit;
}
?>

<div class="card shadow p-3">
    <h5>Halaman Ubah User</h5>
</div>

<div class="card shadow p-3">
<form method="post" enctype="multipart/form-data">

<div class="row mb-3">

<!-- FOTO -->
<div class="col-md-4">
    <label class="form-label">Foto</label>
    <input class="form-control mb-2" type="file" name="foto" id="fotoInput" accept="image/*">
    <img
        src="<?= $user['foto']
            ? $base_url . 'assets/uploads/user/' . $user['foto']
            : $base_url . 'assets/img/noprofil.png'; ?>"
        class="rounded w-100"
        id="preview">
</div>

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

<div class="mb-3">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password" class="form-control" name="passwordconfirm">
</div>

<div class="mb-3">
    <label class="form-label">Role *</label>
    <select class="form-select" name="role" required>
        <option value="0" <?= $user['role'] == 0 ? 'selected' : ''; ?>>User</option>
        <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Alamat *</label>
    <textarea class="form-control" name="alamat" required><?= htmlspecialchars($user['alamat']); ?></textarea>
</div>

<div class="mb-3">
    <label class="form-label">KWH Rumah *</label>
    <select class="form-select" name="kwh" id="kwh" required onchange="setHarga()">
        <option value="450" <?= $user['kwh'] == 450 ? 'selected' : ''; ?>>450 VA</option>
        <option value="900" <?= $user['kwh'] == 900 ? 'selected' : ''; ?>>900 VA</option>
        <option value="1300" <?= $user['kwh'] == 1300 ? 'selected' : ''; ?>>1300 VA</option>
        <option value="2200" <?= $user['kwh'] == 2200 ? 'selected' : ''; ?>>2200 VA</option>
        <option value="3500" <?= $user['kwh'] == 3500 ? 'selected' : ''; ?>>3500 VA</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Harga / Bulan (Rp)</label>
    <input type="number"
           class="form-control"
           name="harga"
           id="harga"
           value="<?= $user['harga']; ?>"
           placeholder="Kosongkan untuk otomatis">
    <small class="text-muted">Kosongkan jika ingin harga otomatis dari KWH</small>
</div>

</div>
</div>

<a href="<?= $base_url; ?>admin/user" class="btn btn-warning">Cancel</a>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
</div>

<script>
// Preview foto
document.getElementById('fotoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('preview').src = e.target.result;
    reader.readAsDataURL(file);
});

// Harga otomatis jika input kosong
function setHarga() {
    const hargaInput = document.getElementById('harga');
    if (hargaInput.value !== '') return;

    const kwh = document.getElementById('kwh').value;
    const hargaMap = {
        450: 10000,
        900: 20000,
        1300: 30000,
        2200: 40000,
        3500: 50000
    };
    hargaInput.value = hargaMap[kwh] || '';
}
</script>

<?php require '../template/foother.php'; ?>
