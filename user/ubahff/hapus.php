<?php

require '../template/headher.php';
$id = $_GET['id'];

$foto = getWhere("SELECT * FROM foto WHERE id_foto = $id ");

mysqli_query($koneksi, "DELETE FROM foto WHERE  id_foto = $id");

if ($foto['gambar']) {
    unlink('../../assets/img/fotogaleri/' . $foto['gambar']);
}

if (mysqli_affected_rows($koneksi) > 0) {
    $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
    redirectTo('admin/foto');
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus';
    redirectTo('admin/foto');
}