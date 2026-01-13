<?php require '../template/headher.php' ?>

<?php $user = mysqli_query($koneksi, 'SELECT * FROM user')->num_rows; ?>
<?php $slide_game = mysqli_query($koneksi, 'SELECT * FROM slide_game')->num_rows; ?>
<?php $game = mysqli_query($koneksi, 'SELECT * FROM game')->num_rows; ?>

<!-- <?php var_dump($user) ?> -->

<div class="card shadow p-3">
    <h5>Dashboard</h5>
</div>

<section class="section-dashboard">
    <div class="row g-3 justify-content-center">
    <!-- user -->
    <div class="col-md-3">
        <div class="stats-counters row gy-4 justify-content-center">
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <i class="bi bi-controller"></i><span data-purecounter-start="0" data-purecounter-end="<?= $game; ?>" data-purecounter-duration="1.5" class="purecounter"></span>
              </div>
              <small class="label">Jumlah game</small>
            </article>
          </div>
        </div>
    </div>
    <!-- end user -->
    <!-- user -->
    <div class="col-md-3">
        <div class="stats-counters row gy-4 justify-content-center">
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <i class="bi bi-people"></i> <span data-purecounter-start="0" data-purecounter-end="<?= $user; ?>" data-purecounter-duration="1.5" class="purecounter"></span>
              </div>
              <small class="label">Jumlah User</small>
            </article>
          </div>
        </div>
    </div>
    <!-- end user -->
    <div class="card shadow p-3 justify-content-center">
    <h5 class="">Topup</h5>
    </div>
     <div class="card shadow p-3">
       <div class="card shadow p-3">
      <a href="<?= $base_url; ?>admin/topupgame/ff.php" class="btn btn-outline-success w-100 py-3">
        <i class="bi bi-bullseye"></i> Free Fire
      </a>
    </div>

     <div class="card shadow p-3">
      <a href="<?= $base_url; ?>admin/topupgame/bintang.php" class="btn btn-outline-primary w-100 py-3">
        <i class="bi bi-star"></i> Bintang
      </a>
    </div>

     <div class="card shadow p-3">
      <a href="#" class="btn btn-outline-warning w-100 py-3">
        <i class="bi bi-hourglass"></i> Coming Soon
      </a>
    



    </div>

</section>

<?php require '../template/foother.php' ?>