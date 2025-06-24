<?php
include("config.php");
$id_penilaian_hapus = $_POST["id_penilaian_hapus"];

$sql = "DELETE FROM penilaian_karyawan
WHERE id_penilaian  = '$id_penilaian_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Penilaian Karyawan Berhasil dihapus!";
    header("Location: pbl_penilaian_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}


?>