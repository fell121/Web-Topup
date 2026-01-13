<?php require '../template/headher.php' ?>
<?php

$id = $_GET['id'];

$vidio = getWhere("SELECT * FROM vidio WHERE id_vidio = $id ");

if (isset($_POST['submit'])) {
    $vidio = $_POST['vidio'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $urutan = $_POST['urutan'];

    $query = "UPDATE vidio SET
            vidio  = '$vidio',
            deskripsi  = '$deskripsi',
            link  = '$link',
            urutan    = '$urutan',
            WHERE id_vidio = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Video Berhasil diubah';
        redirectTo('admin/vidio');
    } else {
        $_SESSION['gagal'] = 'Video Gagal diubah';
        redirectTo('admin/vidio/ubah.php?id=' . $id);
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Ubah Slide</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="vidio" class="form-label">Nama Video <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="vidio" name="vidio" required value="<?= $vidio['vidio']; ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $vidio['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">link <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="link" name="link" required><?= $vidio['link']; ?></textarea>
                </div>


                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="urutan" name="urutan" required value="<?= $vidio['urutan']; ?>">
                </div>

            </div>

        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/vidio" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>