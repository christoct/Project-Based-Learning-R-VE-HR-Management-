<?php
include("config.php");

$id_pencapaian_update = $_POST['id_pencapaian_update'];
$nama_pencapaian_update = $_POST['nama_pencapaian_update'];
$id_karyawan_update = $_POST['id_karyawan_update'];
$tanggal_mulai_update = $_POST['tanggal_mulai_update']; 
$tanggal_selesai_update = $_POST['tanggal_selesai_update'];
$status_pencapaian_update = $_POST['status_pencapaian_update']; 

$sql = "UPDATE pencapaian_karyawan SET 
    nama_pencapaian = '$nama_pencapaian_update',
    id_karyawan   = '$id_karyawan_update',
    tanggal_mulai = '$tanggal_mulai_update',
    tanggal_selesai = '$tanggal_selesai_update',
    status_pencapaian = '$status_pencapaian_update'
    WHERE id_pencapaian  = '$id_pencapaian_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: pencapaian_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>