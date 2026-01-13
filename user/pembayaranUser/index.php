<?php require '../template/headher.php'; ?>
<?php cekLogin(); ?>

<?php
$id_user = (int) $_SESSION['id_user'];

// ================= AMBIL BULAN & TAHUN =================
$bulan = isset($_GET['bulan']) ? (int) $_GET['bulan'] : date('n');
$tahun = isset($_GET['tahun']) ? (int) $_GET['tahun'] : date('Y');

if ($bulan < 1 || $bulan > 12) {
    $_SESSION['gagal'] = 'Bulan tidak valid';
    redirectTo('user/dashboard');
    exit;
}

$namaBulan = date('F', mktime(0,0,0,$bulan,1));

// ================= DATA USER & BANK =================
$user = getWhere("SELECT * FROM user WHERE id_user = $id_user");
$bank = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1");

// ================= CEK PEMBAYARAN BULAN INI =================
$cek = getWhere("
    SELECT id_pembayaran, status 
    FROM pembayaran
    WHERE id_user = $id_user
    AND MONTH(tanggal) = $bulan
    AND YEAR(tanggal) = $tahun
");
?>

<!-- INFO -->
<div class="card shadow p-3 mb-3">
    <h5>Bayar Tagihan Bulan <?= $namaBulan . ' ' . $tahun; ?></h5>
    <hr>
    <h6>Bank <?= htmlspecialchars($bank['nama_bank']); ?></h6>
    <h6>No. Rekening <?= htmlspecialchars($bank['rekening']); ?></h6>
</div>

<!-- FORM -->
<div class="card shadow p-3 mb-3">
<form method="post" enctype="multipart/form-data">

<input type="hidden" name="bulan" value="<?= $bulan; ?>">
<input type="hidden" name="tahun" value="<?= $tahun; ?>">

<div class="mb-3">
    <label class="form-label">Bukti Pembayaran</label>
    <input type="file" name="bukti_foto" class="form-control" required>
</div>

<button type="submit" name="bayar" class="btn btn-success">
    <i class="bi bi-credit-card"></i> Kirim Bukti
</button>

</form>
</div>

<?php
// ================= PROSES BAYAR =================
if (isset($_POST['bayar'])) {

    $bulan = (int) $_POST['bulan'];
    $tahun = (int) $_POST['tahun'];
    $tanggal = date("$tahun-$bulan-01");

    if ($_FILES['bukti_foto']['error'] === 4) {
        $_SESSION['gagal'] = 'Bukti pembayaran wajib diupload';
        redirectTo("user/pembayaranUser?bulan=$bulan&tahun=$tahun");
        exit;
    }

    $bukti = upload(
        'bukti_foto',
        ['jpg','png','jpeg'],
        5000,
        '../../assets/uploads/pembayaran/'
    );

    if (!$bukti) {
        redirectTo("user/pembayaranUser?bulan=$bulan&tahun=$tahun");
        exit;
    }

    // ================= JIKA DITOLAK → UPDATE =================
    if ($cek && $cek['status'] === 'ditolak') {

        mysqli_query($koneksi, "
            UPDATE pembayaran SET
                bukti_foto = '$bukti',
                tanggal = '$tanggal',
                status = 'pending'
            WHERE id_pembayaran = {$cek['id_pembayaran']}
        ");

        $_SESSION['berhasil'] = 'Bukti pembayaran dikirim ulang, menunggu verifikasi';
    }
    // ================= JIKA BELUM ADA → INSERT =================
    elseif (!$cek) {

        mysqli_query($koneksi, "
            INSERT INTO pembayaran (id_user, tanggal, bukti_foto, status)
            VALUES ($id_user, '$tanggal', '$bukti', 'pending')
        ");

        $_SESSION['berhasil'] = 'Bukti pembayaran berhasil dikirim';
    }
    // ================= JIKA PENDING / LUNAS =================
    else {
        $_SESSION['gagal'] = 'Pembayaran bulan ini sedang diproses atau sudah lunas';
    }

    redirectTo('user/dashboard');
    exit;
}
?>

<?php require '../template/foother.php'; ?>
