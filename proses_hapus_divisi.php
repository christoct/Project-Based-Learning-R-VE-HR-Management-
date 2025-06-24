<?php
include("config.php");
$id_divisi_hapus = $_POST["id_divisi_hapus"];

$sql = "DELETE FROM divisi
WHERE id_divisi = '$id_divisi_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Divisi Berhasil dihapus!";
    header("Location: divisi.php");
} else {
    echo "Error : " . $conn->error;
}


?>