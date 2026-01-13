<?php require 'headher.php'; ?>

<div class="page-title mb-5" data-aos="fade">
    <div class="container py-5">
        <h1>Galeri Video</h1>
    </div>
</div>

<?php $vidio = get("SELECT * FROM vidio ORDER BY id_vidio DESC"); ?>
<div class="container mb-5">
    <div class="row g-4">
        <?php foreach ($vidio as $row) : ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="ratio ratio-16x9">
                < src="<?= $row['link']; ?>">
            </div>
            <div class="card-body text-center">
                <h5><?= htmlspecialchars($row['vidio']); ?></h5>
            </div>
        </div>
    </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require 'foother.php'; ?>
