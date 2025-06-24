<?php
include("config.php");

$id_penilaian_update = $_POST['id_penilaian_update'];
$id_karyawan_update = $_POST['id_karyawan_update'];
$id_penilai_update = $_POST['id_penilai_update'];
$tanggal_penilaian_update = $_POST['tanggal_penilaian_update']; 
$id_akhir_update = $_POST['id_akhir_update'];
$status_penilaian_update = $_POST['status_penilaian_update']; 

$sql = "UPDATE penilaian_karyawan SET 
    id_karyawan = '$id_karyawan_update',
    id_penilai  = '$id_penilai_update',
    tanggal_penilaian = '$tanggal_penilaian_update',
    id_akhir = '$id_akhir_update',
    status_penilaian = '$status_penilaian_update'
    WHERE id_penilaian = '$id_penilaian_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: pbl_penilaian_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>