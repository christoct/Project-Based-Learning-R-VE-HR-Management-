<?php
include("config.php");
$id_struktur_gaji_hapus = $_POST["id_struktur_gaji_hapus"];

print_r($_POST);

$sql = "DELETE FROM struktur_gaji
WHERE id_struktur_gaji  = '$id_struktur_gaji_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Struktur Gaji Berhasil dihapus!";
    header("Location: pbl_struktur_gaji.php");
} else {
    echo "Error : " . $conn->error;
}


?>