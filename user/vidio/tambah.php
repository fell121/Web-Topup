<?php require '../template/headher.php' ?>
<?php

if (isset($_POST['submit'])) {
    $vidio = $_POST['vidio'];

    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $urutan = $_POST['urutan'];

    $query = "INSERT INTO vidio VALUES (null, '$vidio', '$deskripsi', '$link', '$urutan')";

    mysqli_query($koneksi, $query);

        if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Video Berhasil Ditambahkan';
        redirectTo('admin/vidio');
    } else {
        $_SESSION['gagal'] = 'Video Gagal Ditambahkan';
        redirectTo('admin/vidio/');
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
                            <label for="vidio" class="form-label">Nama Video <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="vidio" name="vidio" required>
                        </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                            <label for="link" class="form-label">link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="link" name="link" required>
                </div>
                <div class="mb-3">
                            <label for="urutan" class="form-label">urutan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="urutan" name="urutan" required>
                </div>
            </div>

        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/vidio" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>