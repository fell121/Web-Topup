<?php require '../template/headher.php'; ?>

<div class="page-title mb-5" data-aos="fade">
    <div class="container py-5 text-center">
        <h1>STRUKTUR ORGANISASI</h1>
    </div>
</div>

<?php
$profil = getWhere("SELECT * FROM profil WHERE id_profil = 1");
$gambar = $profil && !empty($profil['struktur'])
    ? $profil['struktur']
    : 'noimage-landscape.jpg';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow p-3 text-center">
                <img
                    src="<?= $base_url; ?>assets/img/<?= $gambar; ?>"
                    alt="Struktur Organisasi"
                    class="img-fluid rounded mx-auto d-block">
            </div>
        </div>
    </div>
</div>

<?php require '../template/foother.php'; ?>
