<?php require '../template/headher.php' ?>
<?php

if (isset($_POST['submit'])) {
    $foto = $_POST['foto'];

    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $urutan = $_POST['urutan'];

    if($_FILES['gambar']['error'] == 4) {
        $_SESSION['gagal'] = 'Data Gagal Ditambahkan, Gambar Wajib di Upload';
        redirectTo('admin/foto');
    } else {
        $gambar = upload('gambar', ['jpg', 'png', 'jpeg', 'pdf', 'webp'], 500, '../../assets/img/fotogaleri/');
    }

    $query = "INSERT INTO foto VALUES (null, '$foto', '$deskripsi', '$link', '$urutan', '$gambar')";

    mysqli_query($koneksi, $query);

        if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Foto Berhasil Ditambahkan';
        redirectTo('admin/foto');
    } else {
        $_SESSION['gagal'] = 'Foto Gagal Ditambahkan';
        redirectTo('admin/foto/');
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Tambah Foto</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar <span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="upload" name="gambar">
                </div>
                <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="" id="preview" class="rounded w-100 ">
            </div>

            <div class="col-md-8">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Nama Foto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="foto" name="foto" required>
                        </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                            <label for="link" class="form-label">urutan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="link" name="link" required>
                </div>
            </div>

        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/foto" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>