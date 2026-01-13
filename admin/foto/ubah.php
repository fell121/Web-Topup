<?php require '../template/headher.php' ?>
<?php

$id = $_GET['id'];

$foto = getWhere("SELECT * FROM foto WHERE id_foto = $id ");

if (isset($_POST['submit'])) {
    $foto = $_POST['foto'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $urutan = $_POST['urutan'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $foto['gambar'];
    } else {
        $gambar = upload('gambar', ['jpg', 'png', 'jpeg', 'webp'], 500, '../../assets/img/fotogaleri/');
    }

    $query = "UPDATE foto SET
            foto  = '$foto',
            deskripsi  = '$deskripsi',
            link  = '$link',
            urutan    = '$urutan',
            gambar    = '$gambar'
            WHERE id_foto = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil diubah';
        redirectTo('admin/foto');
    } else {
        $_SESSION['gagal'] = 'Data Gagal diubah';
        redirectTo('admin/foto/ubah.php?id=' . $id);
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Ubah Slide</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar <span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="upload" name="gambar">
                </div>
                <img src="<?= $base_url; ?>/assets/img/fotogaleri/<?= $foto['gambar']; ?>" alt="" id="preview" class="rounded w-100 ">
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="foto" class="form-label">Nama Foto <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="foto" name="foto" required value="<?= $foto['foto']; ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $foto['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">link <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="link" name="link" required><?= $foto['link']; ?></textarea>
                </div>


                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="urutan" name="urutan" required value="<?= $foto['urutan']; ?>">
                </div>

            </div>

        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/foto" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>