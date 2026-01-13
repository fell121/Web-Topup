<?php require '../template/headher.php'; ?>

<?php 
if (isset($_POST['submit'])) {
    $deskripsi = $_POST['deskripsi'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $tanggal_beli = date('Y-m-d');
    $nama_player = $_POST['nama_player']; 

    $query = "INSERT INTO topup_ff VALUES (null, '$deskripsi', '$jumlah', '$harga', '$tanggal_beli', '$nama_player')";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Diamond Berhasil Ditambahkan';
        redirectTo('admin/topupgame');
    } else {
        $_SESSION['gagal'] = 'Diamond Gagal Ditambahkan';
        redirectTo('admin/topupgame/ff.php');
    }
}
?>

<div class="card shadow p-3">
    <h5>Top Up FF</h5>
</div>

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nama_player" class="form-label">Nama Player <span class="text-danger">*</span></label>  
                    <input type="text" class="form-control" id="nama_player" name="nama_player" required>            
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Pilih Jumlah Diamond <span class="text-danger">*</span></label>
                    <select name="jumlah" id="jumlah" onchange="updateHarga()">
                        <option value="">-- Pilih Diamond --</option>
                        <option value="70">70 Diamond</option>
                        <option value="140">140 Diamond</option>
                        <option value="355">355 Diamond</option>
                        <option value="720">720 Diamond</option>
                    </select><br><br>
                </div>


                <div class="mb-3">
                    <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="harga" name="harga" readonly required>
                </div>


            </div>

        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/topupgame/ff.php" role="button">Cancel</a>
        <button type="submit" href="<?= $base_url; ?>admin/topupgame/ff.php" name="submit" class="btn btn-primary">Submit</button>

</form>
</div>

<?php require '../template/foother.php'; ?>

