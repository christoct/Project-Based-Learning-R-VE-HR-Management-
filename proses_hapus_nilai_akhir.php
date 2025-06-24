<?php
include("config.php");
$id_nilai_akhir_hapus = $_POST["id_nilai_akhir_hapus"];

$sql = "DELETE FROM nilai_akhir
WHERE id_nilai_akhir  = '$id_nilai_akhir_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Nilai Akhir Berhasil dihapus!";
    header("Location: nilai_akhir.php");
} else {
    echo "Error : " . $conn->error;
}


?>