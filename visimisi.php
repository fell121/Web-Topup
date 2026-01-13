<?php require 'headher.php' ?>

<div class="page-title mb-5" data-aos="fade">
    <div class="container py-5">
        <h1>VISI DAN MISI</h1>
    </div>
</div>

<?php $profil = getWhere("SELECT * FROM profil WHERE id_profil = 1 "); ?>
<div class="container mb-2">
    <div class="card shadow p-3">
        <?= $profil['visimisi']; ?>
    </div>
</div>

<?php require 'foother.php' ?>