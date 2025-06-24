<?php
include("config.php");

$id_nilai_akhir_update = $_POST['id_nilai_akhir_update'];
$nama_nilai_akhir_update = $_POST['nama_nilai_akhir_update'];

$sql = "UPDATE nilai_akhir SET 
    nama_nilai_akhir = '$nama_nilai_akhir_update'
    WHERE id_nilai_akhir  = '$id_nilai_akhir_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: nilai_akhir.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>