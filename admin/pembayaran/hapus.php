<?php

require '../template/headher.php';

$id = $_GET['id'];

$user = getWhere("SELECT * FROM user WHERE id_user = $id ");

mysqli_query($koneksi, "DELETE FROM user WHERE  id_user = $id");

if ($user['foto']) {
    unlink('../../assets/uploads/user/' . $user['foto']);
}

if (mysqli_affected_rows($koneksi) > 0) {
    $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
    redirectTo('admin/user');
} else {
    $_SESSION['gagal'] = 'Data Gagal Dihapus';
    redirectTo('admin/user');
}