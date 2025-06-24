<?php
include("config.php");
$id_karyawan_hapus = $_POST["id_karyawan_hapus"];

$sql = "DELETE FROM akun_pengguna
WHERE id_karyawan = '$id_karyawan_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data User Karyawan Berhasil dihapus!";
    header("Location: proses_logout.php");
} else {
    echo "Error : " . $conn->error;
}

?>