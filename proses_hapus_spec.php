<?php
include("config.php");
$id_spesifikasi_kerja_hapus = $_POST["id_spesifikasi_kerja_hapus"];

$sql = "DELETE FROM spesifikasi_kerja
WHERE id_spesifikasi_kerja = '$id_spesifikasi_kerja_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Spesifikasi Berhasil dihapus!";
    header("Location: spesifikasi.php");
} else {
    echo "Error : " . $conn->error;
}


?>