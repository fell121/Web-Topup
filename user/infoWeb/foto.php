<?php require '../template/headher.php'; ?>

<div class="page-title mb-5" data-aos="fade">
    <div class="container py-5">
        <h1>Galeri Foto</h1>
    </div>
</div>

<?php $foto = get("SELECT * FROM foto ORDER BY id_foto DESC"); ?>
<div class="container mb-5">
    <div class="row g-4">
        <?php foreach ($foto as $row) : ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $base_url; ?>assets/img/fotogaleri/<?= $row['gambar'] ? $row['gambar'] : 'noimage-landscape.jpg'; ?>" 
                        alt="<?= $row['deskripsi']; ?>"
                        style="object-fit: cover; height: 200px;">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require '../template/foother.php' ?>
