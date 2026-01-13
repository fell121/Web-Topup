<?php require '../../helper.php'; ?>
<?php $pengaturan = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1 "); ?>
<?php cekLogin() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $pengaturan['appname']; ?></title>
  <meta name="description" content="<?= $pengaturan['description']; ?>">
  <meta name="keyword" content="<?= $pengaturan['keyword']; ?>">
  <meta name="author" content="<?= $pengaturan['author']; ?>">

  <!-- Favicons -->
  <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="icon">
  <link href="<?= $base_url; ?>assets/img/<?= $pengaturan['logo']; ?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="<?= $base_url; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= $base_url; ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

  <!-- Main CSS File -->
<link href="<?= $base_url; ?>assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <div id="pesan-berhasil" data-pesan="<?= isset($_SESSION['berhasil']) ? $_SESSION['berhasil'] : ""; ?>"></div>
    <div id="pesan-gagal" data-pesan="<?= isset($_SESSION['gagal']) ? $_SESSION['gagal'] : ""; ?>"></div>

    <?php unset($_SESSION['berhasil']) ?>
    <?php unset($_SESSION['gagal']) ?>

    <header id="header" class="header d-flex align-items-center sticky-top">

    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="<?= $base_url; ?>admin/dashboard/ " class="logo d-flex align-items-center me-auto">
        <h1 class="sitename"><?= $pengaturan['appname']; ?></h1>
      </a>

    <nav id="navmenu" class="navmenu">
    <ul>
<li class="nav-item dropdown">
    <?php
    $id = $_SESSION['id_user'];
    $akun = getWhere("SELECT * FROM user WHERE id_user = $id ");
    ?>
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <?php if ($akun['foto']) : ?>
            <img src="<?= $base_url; ?>/assets/uploads/user/<?= $akun['foto']; ?>" 
                alt="<?= $akun['email']; ?>" 
                class="rounded-circle me-2" 
                width="32" height="32">
        <?php else : ?>
            <img src="<?= $base_url; ?>assets/img/noprofil.png" 
                alt="<?= $akun['email']; ?>" 
                class="rounded-circle me-2" 
                width="32" height="32">
        <?php endif ?>
        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $akun['email']; ?></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
            <h6><?= $akun['email']; ?></h6>
            <span><?= getRole($akun['role']); ?></span>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= $base_url; ?>/admin/dashboard/profil.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= $base_url; ?>admin/user/" >
                <i class="bi bi-house-door"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
        </li>
    </ul>
</li>


        <!-- Menu utama lainnya -->
        <li><a class="nav-link" href="<?= $base_url; ?>admin/user">User</a></li>
        <li><a class="nav-link" href="<?= $base_url; ?>admin/pengaturan">Pengaturan</a></li>
        <li><a class="nav-link" href="<?= $base_url; ?>admin/pembayaran">Pembayaran</a></li>
        <li class="dropdown"><a href="#"><span>Tambah Info Web</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a class="nav-link" href="<?= $base_url; ?>admin/profil">Profil</a></li>
                <li><a class="nav-link" href="<?= $base_url; ?>admin/foto">Foto</a></li>
                <li><a class="nav-link" href="<?= $base_url; ?>admin/vidio">Video</a></li>
                <li><a class="nav-link" href="<?= $base_url; ?>admin/berita">Berita</a></li>

            </ul>
        </li>
        </li>
    </ul>
    </ul>

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

    </header>

    <main class="main">
