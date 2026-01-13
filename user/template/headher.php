<?php require '../../helper.php'; ?>
<?php cekLogin(); ?>
<?php $pengaturan = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= htmlspecialchars($pengaturan['appname']); ?></title>
  <meta name="description" content="<?= htmlspecialchars($pengaturan['description']); ?>">
  <meta name="keyword" content="<?= htmlspecialchars($pengaturan['keyword']); ?>">
  <meta name="author" content="<?= htmlspecialchars($pengaturan['author']); ?>">

  <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="icon">
  <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="apple-touch-icon">

  <link href="<?= $base_url; ?>front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<div id="pesan-berhasil" data-pesan="<?= $_SESSION['berhasil'] ?? ''; ?>"></div>
<div id="pesan-gagal" data-pesan="<?= $_SESSION['gagal'] ?? ''; ?>"></div>
<?php unset($_SESSION['berhasil'], $_SESSION['gagal']); ?>

<header id="header" class="header sticky-top">
<div class="container-fluid container-xl d-flex align-items-center">

<a href="<?= $base_url; ?>admin/dashboard" class="logo me-auto">
  <h1 class="sitename"><?= $pengaturan['appname']; ?></h1>
</a>

<?php
$id_user = (int) ($_SESSION['id_user'] ?? 0);
$akun = $id_user ? getWhere("SELECT * FROM user WHERE id_user = $id_user") : null;

$jumlah_notif = 0;
if ($id_user) {
    $jumlah_notif = mysqli_query(
        $koneksi,
        "SELECT id_notifikasi FROM notifikasi 
         WHERE id_user = $id_user AND status = 'belum_dibaca'"
    )->num_rows;
}
?>

<nav id="navmenu" class="navmenu">
<ul>

<!-- ================= AKUN ================= -->
<li class="dropdown">
<a href="#" data-bs-toggle="dropdown" class="d-flex align-items-center">
  <img src="<?= $akun && $akun['foto']
      ? $base_url . 'assets/uploads/user/' . $akun['foto']
      : $base_url . 'assets/img/noprofil.png'; ?>"
      class="rounded-circle" width="32">
  <span class="ms-2"><?= htmlspecialchars($akun['email'] ?? ''); ?></span>
</a>

<ul class="dropdown-menu dropdown-menu-end">
  <li class="dropdown-header">
    <h6><?= htmlspecialchars($akun['email'] ?? ''); ?></h6>
    <span><?= getRole($akun['role'] ?? 0); ?></span>
  </li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="<?= $base_url; ?>user/dashboard/profil.php">
    <i class="bi bi-person"></i> My Profile</a></li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
    <i class="bi bi-box-arrow-right"></i> Sign Out</a></li>
</ul>

<!-- ================= MENU UTAMA ================= -->
<li><a href="<?= $base_url; ?>user/dashboard/index.php">Beranda</a></li>


<li class="dropdown">
  <a href="#"><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
  <ul>
<li><a href="<?= $base_url; ?>user/infoWeb/tentang.php">Tentang Kami</a></li>

    <li><a href="<?= $base_url; ?>user/infoWeb/visimisi.php">Visi Dan Misi</a></li>
    <li><a href="<?= $base_url; ?>user/infoWeb/stuktur.php">Struktur</a></li>
  </ul>
</li>

<li class="dropdown">
  <a href="#"><span>Galeri</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
  <ul>
    <li><a href="<?= $base_url; ?>user/infoWeb/foto.php">Foto</a></li>
    <li><a href="<?= $base_url; ?>user/infoWeb/galeri.php">Video</a></li>
  </ul>
</li>

<li><a href="<?= $base_url; ?>user/infoWeb/berita.php">Berita</a></li>
<li><a href="<?= $base_url; ?>user/infoWeb/kontak.php">Kontak</a></li>

<!-- ================= NOTIFIKASI ================= -->
<li class="dropdown">
  <a href="#" class="nav-icon" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <?php if ($jumlah_notif > 0): ?>
      <span class="badge bg-danger"><?= $jumlah_notif; ?></span>
    <?php endif; ?>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li class="dropdown-header">
      Anda memiliki <?= $jumlah_notif; ?> notifikasi
    </li>
    <li><hr class="dropdown-divider"></li>
    <li class="dropdown-footer">
      <a href="<?= $base_url; ?>user/dashboard/notifikasi.php">Lihat Semua</a>
    </li>
  </ul>
</li>


</li>

</ul>
<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

</div>
</header>

<main class="main">
