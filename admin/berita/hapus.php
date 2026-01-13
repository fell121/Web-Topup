<?php

require '../template/headher.php';
$id = $_GET['id'];

$berita = getWhere("SELECT * FROM berita WHERE id_berita = $id ");

mysqli_query($koneksi, "DELETE FROM berita WHERE  id_berita = $id");

if ($berita['gambar']) {
    unlink('../../assets/img/fotoberita/' . $berita['gambar']);
}

if (mysqli_affected_rows($koneksi) > 0) {
    $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
    redirectTo('admin/berita');
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus';
    redirectTo('admin/berita');
}