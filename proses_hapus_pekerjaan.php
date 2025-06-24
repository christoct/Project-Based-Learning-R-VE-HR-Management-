<?php
include("config.php");
$id_pekerjaan_hapus = $_POST["id_pekerjaan_hapus"];

$sql = "DELETE FROM pekerjaan
WHERE id_pekerjaan = '$id_pekerjaan_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Pekerjaan Berhasil dihapus!";
} else {
    echo "Error : " . $conn->error;
}

$sql2 = "DELETE FROM kemampuan_kerja
WHERE id_pekerjaan = '$id_pekerjaan_hapus'";
if ($conn->query($sql2) === TRUE) {
    echo "Data Kemampuan_Kerja Berhasil dihapus!";
    header("Location: deskripsi.php");
} else {
    echo "Error : " . $conn->error;
}


?>