<?php
include("config.php");

$id_rekening_update = $_POST['id_rekening_update'];
$id_karyawan_update = $_POST['id_karyawan_update'];
$nama_bank_update = $_POST['nama_bank_update'];
$nomor_rekening_update = $_POST['nomor_rekening_update']; 

$sql = "UPDATE rekening_karyawan SET 
    id_karyawan  = '$id_karyawan_update',
    nama_bank = '$nama_bank_update',
    nomor_rekening = '$nomor_rekening_update'
    WHERE id_rekening  = '$id_rekening_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: rekening_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>