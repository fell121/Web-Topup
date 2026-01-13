<?php require 'headher.php' ?>

<div class="page-title mb-3" data-aos="fade">
    <div class="container py-5">
        <h1>TENTANG KAMI</h1>
    </div>
</div>

<?php $profil = getWhere("SELECT * FROM profil WHERE id_profil = 1 "); ?>
<div class="container">
    <div class="card shadow p-3">
        <?= $profil['tentang']; ?>
    </div>
</div>

<?php require 'foother.php' ?>