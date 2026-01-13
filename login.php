<?php require 'helper.php'; ?>
<?php $pengaturan = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1"); ?>

<?php
if (isset($_POST['submit'])) {

    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validasi input kosong
    if ($email == '' || $password == '') {
        $_SESSION['gagal'] = 'Email dan password wajib diisi';
        redirectTo('login.php');
        exit;
    }

    // Ambil data user
    $user = getWhere("SELECT * FROM user WHERE email = '$email'");

    if (!$user) {
        $_SESSION['gagal'] = 'Email tidak terdaftar';
        redirectTo('login.php');
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['gagal'] = 'Password salah';
        redirectTo('login.php');
        exit;
    }

    // SET SESSION
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['role']    = $user['role'];

    // PEMBEDA LOGIN
    if ($user['role'] == 1) {
        // ADMIN
        redirectTo('admin/user');
    } else {
        // USER
        redirectTo('user/dashboard');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= htmlspecialchars($pengaturan['appname']); ?></title>
    <meta content="<?= htmlspecialchars($pengaturan['description']); ?>" name="description">
    <meta content="<?= htmlspecialchars($pengaturan['keyword']); ?>" name="keywords">
    <meta content="<?= htmlspecialchars($pengaturan['author']); ?>" name="author">

    <!-- Favicons -->
    <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="icon">
    <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="<?= $base_url; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base_url; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $base_url; ?>assets/css/style.css" rel="stylesheet">
</head>

<body>

<main>
<div class="container">

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">

<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

<div class="d-flex justify-content-center py-4">
    <a href="index.html" class="logo d-flex flex-column align-items-center w-auto text-center">
        <img src="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" alt="" width="100">
        <span class="d-none d-lg-block"><?= $pengaturan['appname']; ?></span>
    </a>
</div>

<div class="card mb-3">
<div class="card-body">

<div class="pt-4 pb-2">
    <h5 class="card-title text-center fs-4">Login to Your Account</h5>
    <p class="text-center small">Enter your email & password</p>
</div>

<form class="row g-3 needs-validation" novalidate method="post">

<div class="col-12">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
</div>

<div class="col-12">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
</div>

<div class="col-12">
    <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
</div>

</form>

</div>
</div>

<div class="credits">
    <?= $pengaturan['copyright']; ?>
</div>

</div>
</section>

</div>
</main>

<script src="<?= $base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base_url; ?>assets/js/main.js"></script>

</body>
</html>
