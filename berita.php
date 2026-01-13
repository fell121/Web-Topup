<?php require 'headher.php'; ?>

<div class="page-title mb-5" data-aos="fade">
    <div class="container py-5">
        <h1>Berita</h1>
    </div>
</div>

<?php $berita = get("SELECT * FROM berita ORDER BY urutan ASC"); ?>
<div class="container mb-5">
    <div class="row g-4">
        <?php foreach ($berita as $row) : ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $base_url; ?>assets/img/beritagaleri/<?= $row['gambar'] ?? 'noimage-landscape.jpg'; ?>" 
                        alt="<?= $row['nama_berita']; ?>" 
                        class="card-img-top" 
                        style="object-fit: cover; height: 200px;">

                    <div class="card-body">
                        <h5 class="card-title mt-2"><?= $row['nama_berita']; ?></h5>
                        <p class="card-text"><strong><?= $row['deskripsi']; ?></strong></p>
                        <p class="card-text"><?=$row['teks']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require 'foother.php'; ?>
