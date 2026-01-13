<?php require '../template/headher.php' ?>
<?php

if (isset($_POST['submit'])) {
    $kelebihan = $_POST['kelebihan'];

    $deskripsi = $_POST['deskripsi'];
    $icon = $_POST['icon'];
    $urutan = $_POST['urutan'];

    if($_FILES['gambar']['error'] == 4) {
        $_SESSION['gagal'] = 'Data Gagal Ditambahkan, Gambar Wajib di Upload';
        redirectTo('admin/kelebihan');
    } else {
        $gambar = upload('gambar', ['jpg', 'png', 'jpeg', 'pdf', 'webp'], 500, '../../assets/img/fotogaleri/');
    }

    $query = "INSERT INTO kelebihan VALUES (null, '$kelebihan', '$icon', '$deskripsi', '$urutan')";

    mysqli_query($koneksi, $query);

        if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Foto Berhasil Ditambahkan';
        redirectTo('admin/kelebihan');
    } else {
        $_SESSION['gagal'] = 'Foto Gagal Ditambahkan';
        redirectTo('admin/kelebihan/');
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Tambah Slide Game</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-8">
                        <div class="mb-3">
                            <label for="kelebihan" class="form-label">kelebihan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kelebihan" name="kelebihan" required>
                        </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                            <label for="icon" class="form-label">icon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="icon" name="icon" required>
                </div>
            </div>

        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/kelebihan" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>