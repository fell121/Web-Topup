<?php require '../template/headher.php'; ?>

<?php 
if (isset($_POST['submit'])) {
    $deskripsi = $_POST['deskripsi'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $tanggal_beli = date('d-m-y');
    $nama_player = $_POST['nama_player']; 

    $query = "INSERT INTO bintang_topup VALUES (null, '$deskripsi', '$jumlah', '$harga', '$tanggal_beli', '$nama_player')";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Diamond Berhasil Ditambahkan';
        redirectTo('admin/topupgame');
    } else {
        $_SESSION['gagal'] = 'Diamond Gagal Ditambahkan';
        redirectTo('admin/topupgame/bintang.php');
    }
}
?>

<div class="container mt-4">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Top Up Bintang</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_player" class="form-label">Nama Player</label>
                    <input type="text" class="form-control" name="nama_player" id="nama_player" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Pilih Jumlah Diamond</label>
                    <select class="form-select" name="jumlah" id="jumlah" onchange="updateHarga()" required>
                        <option value="">-- Pilih Diamond --</option>
                        <option value="70">70 Diamond</option>
                        <option value="140">140 Diamond</option>
                        <option value="355">355 Diamond</option>
                        <option value="720">720 Diamond</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" readonly required>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-warning" href="<?= $base_url; ?>admin/topupgame/bintang.php">Cancel</a>
                    <button type="submit" name="submit" href="<?= $base_url; ?>admin/topupgame/bintang.php" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php require '../template/foother.php'; ?>
