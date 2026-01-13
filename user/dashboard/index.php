<?php require '../template/headher.php'; ?>
<?php cekLogin(); ?>

<?php
$id_user = (int) $_SESSION['id_user'];

$bank = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1 ");
// ================= DATA USER =================
$user = getWhere("SELECT * FROM user WHERE id_user = $id_user");
if (!$user) {
    redirectTo('login');
    exit;
}

// ================= PEMBAYARAN TERAKHIR =================
$pembayaranTerakhir = getWhere("
    SELECT * FROM pembayaran 
    WHERE id_user = $id_user 
    ORDER BY tanggal DESC 
    LIMIT 1
");

// ================= CEK KETERLAMBATAN =================
$jatuhTempo = 1; // hari

if ($pembayaranTerakhir) {
    $selisihHari = floor(
        (strtotime(date('Y-m-d')) - strtotime($pembayaranTerakhir['tanggal'])) / 86400
    );

    if ($pembayaranTerakhir['status'] != 'lunas' && $selisihHari > $jatuhTempo) {

        $cekNotif = getWhere("
            SELECT id_notifikasi FROM notifikasi 
            WHERE id_user = $id_user 
            AND pesan LIKE '%terlambat%'
        ");

        if (!$cekNotif) {
            mysqli_query($koneksi, "
                INSERT INTO notifikasi (id_user, pesan, tanggal, status)
                VALUES (
                    $id_user,
                    '⚠️ Anda terlambat membayar tagihan. Segera lakukan pembayaran.',
                    CURDATE(),
                    'belum_dibaca'
                )
            ");
        }
    }
}

// ================= AMBIL NOTIFIKASI =================
$notifikasi = get("
    SELECT * FROM notifikasi 
    WHERE id_user = $id_user 
    AND status = 'belum_dibaca'
    ORDER BY tanggal DESC
");

// Tandai notifikasi dibaca
if ($notifikasi) {
    mysqli_query($koneksi, "
        UPDATE notifikasi 
        SET status = 'dibaca'
        WHERE id_user = $id_user
    ");
}

// ================= RIWAYAT PEMBAYARAN =================
$pembayaran = get("
    SELECT * FROM pembayaran 
    WHERE id_user = $id_user 
    ORDER BY tanggal DESC
");
?>

<!-- ================= INFORMASI TAGIHAN ================= -->
<div class="card shadow p-3">
    <h5>Halaman Bayar Tagihan</h5>
</div>

<!-- ================= NOTIFIKASI ================= -->
<?php if ($notifikasi) : ?>
<div class="alert alert-danger shadow-sm">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>Peringatan!</strong>
    <ul class="mb-0 mt-2">
        <?php foreach ($notifikasi as $n) : ?>
            <li><?= htmlspecialchars($n['pesan']); ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<?php
$tahun = date('Y');

// Index pembayaran berdasarkan bulan
$pembayaranPerBulan = [];
foreach ($pembayaran as $p) {
    $bulan = date('n', strtotime($p['tanggal'])); // 1–12
    $pembayaranPerBulan[$bulan] = $p;
}
?>

<?php
// ================= TANGGAL =================
$tahunSekarang = date('Y');
$bulanSekarang = date('n');

// ================= RIWAYAT PEMBAYARAN (TAHUN INI) =================
$pembayaran = get("
    SELECT * FROM pembayaran
    WHERE id_user = $id_user
    AND YEAR(tanggal) = $tahunSekarang
");


?>

<div class="card shadow p-3 mb-3">
    <h6>Informasi Tagihan</h6>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td><?= htmlspecialchars($user['username']); ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= htmlspecialchars($user['alamat']); ?></td>
        </tr>
        <tr>
            <th>KWH Rumah</th>
            <td><?= $user['kwh']; ?> VA</td>
        </tr>
        <tr>
            <th>Total Tagihan</th>
            <td><strong>Rp <?= number_format($user['harga'], 0, ',', '.'); ?></strong></td>
        </tr>
    </table>
</div>

<div class="card shadow p-3">
    <h5>Riwayat Pembayaran Bulanan (<?= $tahunSekarang; ?>)</h5>
</div>

<div class="card shadow p-3">

<table class="table table-bordered table-striped">
<thead class="text-center">
<tr>
    <th>Bulan</th>
    <th>Status</th>
    <th>Tanggal Bayar</th>
    <th>Bukti</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
<?php
    $namaBulan = date('F', mktime(0,0,0,$bulan,1));
    $data = $pembayaranPerBulan[$bulan] ?? null;
    $isLewat = $bulan < $bulanSekarang;
?>
<tr class="text-center">

<td><strong><?= $namaBulan; ?></strong></td>

<td>
<?php if ($data): ?>
    <?php if ($data['status'] === 'lunas'): ?>
        <span class="badge bg-success">Sudah Dibayar</span>
    <?php elseif ($data['status'] === 'pending'): ?>
        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
    <?php else: ?>
        <span class="badge bg-danger">Ditolak</span>
    <?php endif; ?>
<?php else: ?>
    <?= $isLewat
        ? '<span class="badge bg-danger">Tunggak</span>'
        : '<span class="badge bg-secondary">Belum Jatuh Tempo</span>'; ?>
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
<?php if (!$data || $data['status'] === 'ditolak'): ?>
    <a href="<?= $base_url; ?>user/pembayaranUser?bulan=<?= $bulan; ?>&tahun=<?= $tahunSekarang; ?>"
        class="btn btn-sm btn-success">
        <i class="bi bi-credit-card"></i> Bayar
    </a>
<?php elseif ($data['status'] === 'pending'): ?>
    <span class="text-muted">Menunggu</span>
<?php else: ?>
    <span class="text-success">Selesai</span>
<?php endif; ?>
</td>

</tr>
<?php endfor; ?>
</tbody>
</table>

</div>







<?php require '../template/foother.php'; ?>
