<?php
include("config.php");
$id_pelamar_hapus = $_POST["id_pelamar_hapus"];

$sql = "DELETE FROM pelamar
WHERE id_pelamar = '$id_pelamar_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Pelamar Berhasil dihapus!";
    header("Location: pelamar.php");
} else {
    echo "Error : " . $conn->error;
}


?>