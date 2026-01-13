<?php require '../template/headher.php'; ?>

<?php
$kontak = getWhere("SELECT * FROM kontak WHERE id_kontak = 1");
?>

<section id="contact" class="contact section light-background">

  <!-- Section Title -->
  <div class="container section-title text-center" data-aos="fade-up">
    <h2>KONTAK</h2>
    <p>Hubungi kami melalui informasi berikut</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100" justify-content="center">
    <div class="row g-4 g-lg-5 justify-content-center">

      <!-- INFO BOX TENGAH -->
        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
              <h3>Informasi Kontak</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

              <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="content">
                  <h4>Alamat Saya</h4>
                  <p href=""><?= $kontak['alamat']; ?></p>

                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="content">
                  <h4>Nomor Hp</h4>
                  <p>+<?= $kontak['no_telepon']; ?></p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Alamat Email</h4>
                  <p><?= $kontak['email']; ?></p>

                </div>
              </div>
            </div>
          </div>


        </div>

      <!-- END INFO BOX -->

    </div>
  </div>

</section>

<?php require '../template/foother.php'; ?>
