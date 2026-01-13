<?php require 'helper.php'; ?>
<?php $pengaturan = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1 "); ?>

<!DOCTYPE html>
<html lang="en">

<head>
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
  <link href="<?= $base_url; ?>front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>front/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= $base_url; ?>front/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Updated: Jun 23 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="<?= $base_url; ?>admin/dashboard/ " class="logo d-flex align-items-center me-auto">
        <h1 class="sitename"><span>Web </span><?= $pengaturan['appname']; ?></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="<?= $base_url; ?>" >Beranda</a></li>
                        <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="<?= $base_url; ?>tentang.php">Tentang Kami</a></li>
                                <li><a href="<?= $base_url; ?>visimisi.php">Visi Dan Misi</a></li>
                                <li><a href="<?= $base_url; ?>stuktur.php">Struktur</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#"><span>Galeri</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="<?= $base_url; ?>foto.php">Foto</a></li>
                                <li><a href="<?= $base_url; ?>galeri.php">Vidio</a></li>
                            </ul>
                        </li>
          <li><a href="<?= $base_url; ?>tentang.php">Tentang</a></li>
          <li><a href="<?= $base_url; ?>berita.php">Berita</a></li>
          </li>
          <li><a href="<?= $base_url; ?>kontak.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">