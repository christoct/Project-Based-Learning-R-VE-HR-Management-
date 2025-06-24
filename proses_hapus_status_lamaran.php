<?php
include("config.php");
$id_status_lamaran_hapus = $_POST["id_status_lamaran_hapus"];

$sql = "DELETE FROM status_lamaran
WHERE id_status_lamaran  = '$id_status_lamaran_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Status Lamaran Berhasil dihapus!";
    header("Location: status_lamaran.php");
} else {
    echo "Error : " . $conn->error;
}


?>