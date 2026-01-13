<?php require '../template/headher.php'; ?>
<?php cekSuperadmin(); ?>

<?php
$id_user = (int) ($_GET['id'] ?? 0);
$tahunSekarang = date('Y');

// ================= DATA USER =================
$user = getWhere("SELECT * FROM user WHERE id_user = $id_user");
if (!$user) {
    redirectTo('admin/user');
    exit;
}

// ================= RIWAYAT PEMBAYARAN (TAHUN INI) =================
$pembayaran = get("
    SELECT * FROM pembayaran
    WHERE id_user = $id_user
    AND YEAR(tanggal) = $tahunSekarang
");

// INDEX PEMBAYARAN PER BULAN
$pembayaranPerBulan = [];
foreach ($pembayaran as $p) {
    $bulan = date('n', strtotime($p['tanggal']));
    $pembayaranPerBulan[$bulan] = $p;
}

// ================= PROSES VERIFIKASI =================
if (isset($_POST['verifikasi'])) {
    $id_pembayaran = (int) $_POST['id_pembayaran'];

    mysqli_query($koneksi, "
        UPDATE pembayaran SET status = 'lunas'
        WHERE id_pembayaran = $id_pembayaran
    ");

    $_SESSION['berhasil'] = 'Pembayaran berhasil diverifikasi';
    redirectTo('admin/pembayaran/bukti.php?id=' . $id_user);
    exit;
}

// ================= PROSES TOLAK =================
if (isset($_POST['tolak'])) {
    $id_pembayaran = (int) $_POST['id_pembayaran'];

    mysqli_query($koneksi, "
        UPDATE pembayaran SET status = 'ditolak'
        WHERE id_pembayaran = $id_pembayaran
    ");

    $_SESSION['gagal'] = 'Pembayaran ditolak';
    redirectTo('admin/pembayaran/bukti.php?id=' . $id_user);
    exit;
}
?>

<!-- ================= DATA USER ================= -->
<div class="card shadow p-3 mb-3">
    <h5>Verifikasi Pembayaran Bulanan</h5>
    <table class="table table-bordered mt-3">
        <tr><th>Nama</th><td><?= htmlspecialchars($user['username']); ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($user['email']); ?></td></tr>
        <tr><th>Alamat</th><td><?= htmlspecialchars($user['alamat']); ?></td></tr>
        <tr><th>KWH</th><td><?= $user['kwh']; ?> VA</td></tr>
        <tr><th>Tagihan</th><td><strong>Rp <?= number_format($user['harga'],0,',','.'); ?></strong></td></tr>
    </table>
</div>

<!-- ================= TABEL BULANAN ================= -->
<div class="card shadow p-3">
<h6>Riwayat Pembayaran Bulanan (<?= $tahunSekarang; ?>)</h6>

<table class="table table-bordered table-striped mt-3">
<thead class="text-center">
<tr>
    <th>Bulan</th>
    <th>Status</th>
    <th>Tanggal</th>
    <th>Bukti</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
<?php
    $namaBulan = date('F', mktime(0,0,0,$bulan,1));
    $data = $pembayaranPerBulan[$bulan] ?? null;
?>
<tr class="text-center">

<td><strong><?= $namaBulan; ?></strong></td>

<td>
<?php if ($data): ?>
    <?php if ($data['status'] === 'lunas'): ?>
        <span class="badge bg-success">✔ Lunas</span>
    <?php elseif ($data['status'] === 'pending'): ?>
        <span class="badge bg-warning text-dark">⏳ Pending</span>
    <?php else: ?>
        <span class="badge bg-danger">✖ Ditolak</span>
    <?php endif; ?>
<?php else: ?>
    <span class="badge bg-secondary">Belum Bayar</span>
<?php endif; ?>
</td>

<td><?= $data ? date('d-m-Y', strtotime($data['tanggal'])) : '-'; ?></td>

<td>
<?php if ($data && $data['bukti_foto']): ?>
<a href="<?= $base_url; ?>assets/uploads/pembayaran/<?= $data['bukti_foto']; ?>" target="_blank">
<img src="<?= $base_url; ?>assets/uploads/pembayaran/<?= $data['bukti_foto']; ?>"
    width="60" class="rounded shadow-sm">
</a>
<?php else: ?> - <?php endif; ?>
</td>

<td>
<?php if ($data && $data['status'] === 'pending'): ?>
<form method="post" class="d-inline">
    <input type="hidden" name="id_pembayaran" value="<?= $data['id_pembayaran']; ?>">
    <button type="submit" name="verifikasi" class="btn btn-success btn-sm">
        <i class="bi bi-check-circle"></i>
    </button>
</form>

<form method="post" class="d-inline">
    <input type="hidden" name="id_pembayaran" value="<?= $data['id_pembayaran']; ?>">
    <button type="submit" name="tolak" class="btn btn-danger btn-sm">
        <i class="bi bi-x-circle"></i>
    </button>
</form>
<?php else: ?>
<span class="text-muted">-</span>
<?php endif; ?>
</td>

</tr>
<?php endfor; ?>
</tbody>
</table>

<a href="<?= $base_url; ?>admin/user" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

</div>

<?php require '../template/foother.php'; ?>
