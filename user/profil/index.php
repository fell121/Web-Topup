<?php require '../template/headher.php' ?>

<?php

$profil = getWhere("SELECT * FROM profil WHERE id_profil = 1 ");

if (isset($_POST['submit'])) {
    $tentang = $_POST['tentang'];
    $tentang = str_replace("'", "", $tentang);

    $visimisi = $_POST['visimisi'];
    $visimisi = str_replace("'", "", $visimisi);

    if ($_FILES['struktur']['error'] == 4) {
        $struktur = $profil['struktur'];
    } else {
        $struktur = upload('struktur', ['jpg', 'png', 'jpeg'], 500, '../../assets/img/');
        if ($struktur) {
            unlink('../../assets/img/' . $profil['struktur']);
        }
    }

    $query = "UPDATE profil SET
            tentang    = '$tentang',
            visimisi    = '$visimisi',
            struktur    = '$struktur'
            WHERE id_profil = 1
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Diubah';
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah';
    }
    redirectTo('admin/profil');
}

?>

<div class="card shadow p-3">
    <h5>Profil</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3">

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="struktur" class="form-label">Struktur Organisasi</label>
                    <input class="form-control" type="file" id="upload" name="struktur">
                </div>

                <img src="<?= $base_url; ?>assets/img/<?= $profil['struktur'] ? $profil['struktur'] : 'noimage-landscape.png'; ?>" alt="struktur" id="preview" class="rounded w-100 ">

            </div>

            <div class="col-md-9">

                <div class="mb-3">
                    <label for="tentang" class="form-label">Tentang Kami <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce-editor" id="tentang" name="tentang"><?= $profil['tentang']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="visimisi" class="form-label">Visi Dan Misi <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce-editor" id="visimisi" name="visimisi"><?= $profil['visimisi']; ?></textarea>
                </div>

            </div>


        </div>


        <a class="btn btn-warning" href="<?= $base_url; ?>admin/profil" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>