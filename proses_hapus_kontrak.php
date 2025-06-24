<?php
include("config.php");
$id_kontrak_hapus = $_POST["id_kontrak_hapus"];

$sql = "DELETE FROM kontrak_kerja
WHERE id_kontrak = '$id_kontrak_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Kontrak Kerja Berhasil dihapus!";
    header("Location: kontrak.php");
} else {
    echo "Error : " . $conn->error;
}


?>