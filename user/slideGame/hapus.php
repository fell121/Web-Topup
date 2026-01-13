<?php

require '../template/headher.php';
$id = $_GET['id'];

$slideGame = getWhere("SELECT * FROM slide_game WHERE id_game = $id ");

mysqli_query($koneksi, "DELETE FROM slide_game WHERE  id_game = $id");

if ($slideGame['gambar']) {
    unlink('../../assets/uploads/slideGame/' . $slideGame['gambar']);
}

if (mysqli_affected_rows($koneksi) > 0) {
    $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
    redirectTo('admin/slideGame');
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus';
    redirectTo('admin/slideGame');
}