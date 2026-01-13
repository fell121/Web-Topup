<?php require '../template/headher.php' ?>
<?php

$id = $_GET['id'];
$game = getWhere("SELECT * FROM game WHERE id_game = $id");

if (isset($_POST['submit'])) {
    $game = $_POST['game'];
    $deskripsi = $_POST['deskripsi'];
    $deskripsi = str_replace("'", "", $deskripsi);
    $icon = $_POST['icon'];
    $urutan = $_POST['urutan'];
    $link = $_POST['link'];

    $query = "UPDATE game SET
        game = '$game',
        deskripsi = '$deskripsi',
        icon = '$icon',
        urutan = '$urutan',
        link = '$link'
        WHERE id_game = $id
    ";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['berhasil'] = 'Data Berhasil Diubah';
        redirectTo('admin/game');
    } else {
        $_SESSION['gagal'] = 'Data Gagal Diubah';
        redirectTo('admin/game/ubah.php?id=' . $id);
    }
}

?>

<div class="card shadow p-3">
    <h5>Halaman Ubah Game</h5>
</div>

<div class="card shadow p-3">

    <form action="" method="post" id="form" enctype="multipart/form-data">

        <div class="row mb-3 g-3">

            <div class="col-12">
                <label for="game" class="form-label">Game <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="game" name="game" required value="<?= $game['game']; ?>">
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $game['deskripsi']; ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="icon" name="icon" required value="<?= $game['icon']; ?>">
            </div>

            <div class="col-md-6">
                <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="urutan" name="urutan" required value="<?= $game['urutan']; ?>">
            </div>

            <div class="col-md-6">
                <label for="link" class="form-label">link <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="link" name="link" required value="<?= $game['link']; ?>">
            </div>


        </div>

        <a class="btn btn-warning" href="<?= $base_url; ?>admin/game" role="button">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require '../template/foother.php' ?>