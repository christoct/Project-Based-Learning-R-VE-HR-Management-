<?php
include("config.php");

print_r($_POST);

$id_kontrak_update = $_POST['id_kontrak_update'];
$nama_kontrak_update = $_POST['nama_kontrak_update'];
$id_karyawan_update = $_POST['id_karyawan_update'];
$id_struktur_gaji_update = $_POST['id_struktur_gaji_update'];
$id_penanggung_jawab_update = $_POST['id_penanggung_jawab_update'];
$tanggal_mulai_kontrak_update = $_POST['tanggal_mulai_kontrak_update'];
$tanggal_akhir_kontrak_update = $_POST['tanggal_akhir_kontrak_update'];
$status_kontrak_update = $_POST['status_kontrak_update']; 

$sql = "UPDATE kontrak_kerja SET 
    nama_kontrak  = '$nama_kontrak_update',
    id_karyawan  = '$id_karyawan_update',
    id_struktur_gaji  = '$id_struktur_gaji_update',
    id_penanggung_jawab   = '$id_penanggung_jawab_update',
    tanggal_mulai_kontrak  = '$tanggal_mulai_kontrak_update',
    tanggal_akhir_kontrak  = '$tanggal_akhir_kontrak_update',
    status_kontrak  = '$status_kontrak_update'
    WHERE id_kontrak  = '$id_kontrak_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: kontrak.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>