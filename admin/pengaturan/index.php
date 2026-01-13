<?php require '../template/headher.php' ?>
<?php cekSuperadmin() ?>
<?php

$pengaturan = getWhere("SELECT * FROM pengaturan WHERE id_pengaturan = 1 ");

if (isset($_POST['submit'])) {
    $appname = $_POST['appname'];
    $copyright = $_POST['copyright'];
    $description = $_POST['description'];
    $keyword = $_POST['keyword'];
    $author = $_POST['author'];
    $rekening = $_POST['rekening'];
    $nama_bank = $_POST['nama_bank'];

    if ($_FILES['logo']['error'] == 4) {
        $logo = $pengaturan['logo'];
    } else {
        $logo = upload('logo', ['jpg', 'png', 'jpeg'], 500, '../../assets/img/');
        if ($logo) {
            unlink('../../assets/img/' . $pengaturan['logo']);
        }
    }

    $query = "UPDATE pengaturan SET
            appname    = '$appname',
            logo    = '$logo',
            copyright    = '$copyright',
            description    = '$description',
            keyword    = '$keyword',
            author    = '$author',
            rekening    = '$rekening',
            nama_bank    = '$nama_bank'
            WHERE id_pengaturan = 1
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Diubah';
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah';
    }
    redirectTo('admin/pengaturan');
}

?>

<div class="card shadow p-3">
    <h5>Pengaturan</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input class="form-control" type="file" id="upload" name="logo">
                </div>

                <img src="<?= $base_url; ?>assets/img/<?= $pengaturan['logo'] ? $pengaturan['logo'] : 'noimage-potrait.png'; ?>" alt="Logo" id="preview" class="rounded w-100 ">

            </div>

            <div class="col-md-9">
                <div class="mb-3">
                    <label for="nama_bank" class="form-label">Nama Bank <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_bank" name="nama_bank" required value="<?= $pengaturan['nama_bank']; ?>">
                </div>
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="rekening" class="form-label">Rekening <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="rekening" name="rekening" required value="<?= $pengaturan['rekening']; ?>">
                </div>

            <div class="col-md-9">
                <div class="mb-3">
                    <label for="appname" class="form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="appname" name="appname" required value="<?= $pengaturan['appname']; ?>">
                </div>

                <div class="mb-3">
                    <label for="copyright" class="form-label">Copyright <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="copyright" name="copyright" required value="<?= $pengaturan['copyright']; ?>">
                </div>

                <div class="mb-3">
                    <label for="keyword" class="form-label">Keyword <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="keyword" name="keyword" required value="<?= $pengaturan['keyword']; ?>">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="author" name="author" required value="<?= $pengaturan['author']; ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" required><?= $pengaturan['description']; ?></textarea>
                </div>

            </div>

        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/pengaturan" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>