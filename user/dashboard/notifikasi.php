<?php require '../template/headher.php'; ?>
<?php cekLogin(); ?>

<?php
$id_user = (int) $_SESSION['id_user'];

// Ambil semua notifikasi user
$notifikasi = get("
    SELECT * FROM notifikasi
    WHERE id_user = $id_user
    ORDER BY tanggal DESC
");

// Tandai semua sebagai dibaca
if ($notifikasi) {
    mysqli_query($koneksi, "
        UPDATE notifikasi
        SET status = 'dibaca'
        WHERE id_user = $id_user
    ");
}
?>

<div class="card shadow p-3 mb-3">
    <h5>Notifikasi Saya</h5>
</div>

<div class="card shadow p-3">

<?php if ($notifikasi) : ?>
    <ul class="list-group list-group-flush">

        <?php foreach ($notifikasi as $n) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">
                        <?= htmlspecialchars($n['pesan']); ?>
                    </div>
                    <small class="text-muted">
                        <?= date('d M Y', strtotime($n['tanggal'])); ?>
                    </small>
                </div>

                <?php if ($n['status'] == 'belum_dibaca') : ?>
                    <span class="badge bg-danger rounded-pill">Baru</span>
                <?php endif; ?>

            </li>
        <?php endforeach; ?>

    </ul>
<?php else : ?>
    <p class="text-center text-muted mb-0">
        Tidak ada notifikasi
    </p>
<?php endif; ?>

</div>

<a href="<?= $base_url; ?>user/dashboard" class="btn btn-secondary mt-3">
    Kembali ke Dashboard
</a>

<?php require '../template/foother.php'; ?>
