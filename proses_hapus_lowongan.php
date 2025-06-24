<?php
include("config.php");
$id_lowongan_hapus = $_POST["id_lowongan_hapus"];

$sql = "DELETE FROM lowongan
WHERE id_lowongan = '$id_lowongan_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Lowongan Berhasil dihapus!";
    header("Location: pbl_lowongan_kerja.php");
} else {
    echo "Error : " . $conn->error;
}


?>