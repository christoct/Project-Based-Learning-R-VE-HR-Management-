<?php
include("config.php");
$id_pencapaian_hapus = $_POST["id_pencapaian_hapus"];

print_r($_POST);

$sql = "DELETE FROM pencapaian_karyawan
WHERE id_pencapaian  = '$id_pencapaian_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Pencapaian Karyawan Berhasil dihapus!";
    header("Location: pencapaian_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}


?>