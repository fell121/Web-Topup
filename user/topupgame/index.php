<?php require '../template/headher.php' ?> 
<?php cekSuperadmin() ?>

   <div class="card shadow p-3 justify-content-center">
    <h5 class="">Topup game</h5>
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
    
           <div class="card shadow p-3">
      <a href="<?= $base_url; ?>admin/topupgame/riwayat.php" class="btn btn-outline-primary w-100 py-3">
       <i class="bi bi-file-earmark-text"></i> Riwayat Pembelian
      </a>
    </div>

    </div>



    <?php require '../template/foother.php' ?>


