<?php

require '../template/headher.php';
$id = $_GET['id'];

$vidio = getWhere("SELECT * FROM vidio WHERE id_vidio = $id ");

mysqli_query($koneksi, "DELETE FROM vidio WHERE  id_vidio = $id");

if ($vidio['link']) {
    unlink('../../assets/img/vidiogaleri/' . $vidio['link']);
}

if (mysqli_affected_rows($koneksi) > 0) {
    $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
    redirectTo('admin/vidio');
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus';
    redirectTo('admin/vidio');
}