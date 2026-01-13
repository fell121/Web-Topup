<?php require '../template/headher.php' ?>
<?php

$id = $_GET['id'];

$berita = getWhere("SELECT * FROM berita WHERE id_berita = $id ");

if (isset($_POST['submit'])) {
    $nama_berita = $_POST['nama_berita'];
    $deskripsi = $_POST['deskripsi'];
    $text = $_POST['text'];
    $urutan = $_POST['urutan'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $berita['gambar'];
    } else {
        $gambar = upload('gambar', ['jpg', 'png', 'jpeg', 'webp'], 500, '../../assets/img/beritagaleri/');
    }

    $query = "UPDATE berita SET
            nama_berita  = '$nama_berita',
            deskripsi  = '$deskripsi',
            teks  = '$teks',
            urutan    = '$urutan',
            gambar    = '$gambar'
            WHERE id_berita = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Berita Berhasil diubah';
        redirectTo('admin/berita');
    } else {
        $_SESSION['gagal'] = 'Berita Gagal diubah';
        redirectTo('admin/berita/ubah.php?id=' . $id);
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
                <img src="<?= $base_url; ?>assets/img/beritagaleri/<?= $berita['gambar']; ?>" alt="" id="preview" class="rounded w-100 ">
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nama_berita" class="form-label">Nama Berita <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_berita" name="nama_berita" required value="<?= $berita['nama_berita']; ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $berita['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="teks" class="form-label">teks <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="teks" name="teks" required><?= $berita['teks']; ?></textarea>
                </div>


                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="urutan" name="urutan" required value="<?= $berita['urutan']; ?>">
                </div>

            </div>

        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/berita" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>