<?php require '../template/headher.php' ?>
<?php

$id = $_GET['id'];
$kelebihan = getWhere("SELECT * FROM kelebihan WHERE id_kelebihan = $id");

if (isset($_POST['submit'])) {
    $kelebihan = $_POST['kelebihan'];
    $deskripsi = $_POST['deskripsi'];
    $deskripsi = str_replace("'", "", $deskripsi);
    $icon = $_POST['icon'];
    $urutan = $_POST['urutan'];

    $query = "UPDATE kelebihan SET
        kelebihan = '$kelebihan',
        icon = '$icon',
        deskripsi = '$deskripsi',
        urutan = '$urutan'
        WHERE id_kelebihan = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Diubah';
        redirectTo('admin/kelebihan');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah';
        redirectTo('admin/kelebihan/ubah.php?id=' . $id);
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Ubah Kelebihan</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3 g-3">

            <div class="col-12">
                <label for="kelebihan" class="form-label">Kelebihan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kelebihan" name="kelebihan" required value="<?= $kelebihan['kelebihan']; ?>">
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $kelebihan['deskripsi']; ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="icon" name="icon" required value="<?= $kelebihan['icon']; ?>">
            </div>

            <div class="col-md-6">
                <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="urutan" name="urutan" required value="<?= $kelebihan['urutan']; ?>">
            </div>


        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/kelebihan" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/footer.php' ?>