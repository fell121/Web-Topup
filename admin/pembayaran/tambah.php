<?php require '../template/headher.php' ?>
<?php
$result = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user DESC");

if (isset($_POST['submit'])) {

    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role']; // ambil dari form
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kwh      = $_POST['kwh'];
    $harga    = $_POST['harga'] ?? 0;
    $tanggal  = date('Y-m-d');

    // UPLOAD GAMBAR
    if ($_FILES['foto']['error'] == 4) {
        $_SESSION['gagal'] = 'Data Gagal Ditambahkan, foto wajib diupload';
        redirectTo('admin/user/tambah.php');
        exit;
    } else {
        $foto = upload(
            'foto',
            ['jpg', 'png', 'jpeg'],
            5000,
            '../../assets/uploads/user/'
        );
    }

    // INSERT USER (PERBAIKAN DI SINI)
    $query = "INSERT INTO user 
        (email, password, role, username, foto, alamat, kwh, harga, tanggal)
        VALUES
        ('$email', '$password', '$role', '$username', '$foto', '$alamat', '$kwh', '$harga', '$tanggal')";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Ditambahkan';
        redirectTo('admin/pembayaran');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Ditambahkan';
        redirectTo('admin/pembayaran/tambah.php');
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
            <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="" id="preview" class="rounded w-100 ">
        </div>

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
    <input type="password" class="form-control" name="password" required>
</div>

<div class="mb-3">
<select class="form-select" id="role" name="role" required>
    <option value="0" <?= $user['role'] == 0 ? 'selected' : ''; ?>>User</option>
    <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
</select>

</div>
<div class="mb-3">
    <label class="form-label">Alamat *</label>
    <textarea class="form-control" name="alamat" required></textarea>
</div>

<div class="mb-3">
    <label class="form-label">KWH Rumah *</label>
    <select class="form-control" name="kwh" id="kwh" required onchange="setHarga()">
        <option value="" disabled selected>-- Pilih KWH Rumah --</option>
        <option value="450">450 VA</option>
        <option value="900">900 VA</option>
        <option value="1300">1300 VA</option>
        <option value="2200">2200 VA</option>
        <option value="3500">3500 VA</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Harga / KWH (Rp) </label>
    <input type="number" class="form-control" name="harga" id="harga" value="0" readonly>

</div>
</div>

<a class="btn btn-warning" href="<?= $base_url; ?>admin/slideGame">Cancel</a>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
</div>

<?php require '../template/foother.php' ?>
