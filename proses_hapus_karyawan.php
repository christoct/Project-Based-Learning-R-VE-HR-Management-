<?php
session_start();
include("config.php");

$id_karyawan_hapus = $_POST["id_karyawan_hapus"];
$id_karyawan_login = $_SESSION['id_karyawan'];
$hapus_diri_sendiri = ($id_karyawan_hapus == $id_karyawan_login);

$sql4 = "DELETE FROM akun_pengguna WHERE id_karyawan = '$id_karyawan_hapus'";
if (!$conn->query($sql4)) {
    die("Gagal hapus akun pengguna: " . $conn->error);
}

if ($hapus_diri_sendiri) {
    session_unset();
    session_destroy();
    header("Location: pbl_login.php");
    exit();
}

$sql = "DELETE FROM profil_karyawan WHERE id_karyawan = '$id_karyawan_hapus'";
if (!$conn->query($sql)) {
    die("Gagal hapus data profil: " . $conn->error);
}

$sql2 = "DELETE FROM data_pribadi WHERE id_karyawan = '$id_karyawan_hapus'";
if (!$conn->query($sql2)) {
    die("Gagal hapus data pribadi: " . $conn->error);
}

$sql3 = "DELETE FROM kemampuan_karyawan WHERE id_karyawan = '$id_karyawan_hapus'";
if (!$conn->query($sql3)) {
    die("Gagal hapus kemampuan: " . $conn->error);
}

header("Location: pbl_profil_karyawan.php");
exit();
?>
