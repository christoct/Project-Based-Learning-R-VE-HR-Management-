<?php
include("config.php");
$id_departemen_hapus = $_POST["id_departemen_hapus"];

$sql = "DELETE FROM departemen
WHERE id_departemen = '$id_departemen_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Departemen Berhasil dihapus!";
    header("Location: departemen.php");
} else {
    echo "Error : " . $conn->error;
}


?>