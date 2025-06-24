<?php
include("config.php");

$id_slip_gaji_update = $_POST['id_slip_gaji_update'];
$id_karyawan_update = $_POST['id_karyawan_update'];
$total_gaji_update = $_POST['total_gaji_update'];
$metode_bayar_update = $_POST['metode_bayar_update']; 
$status_pembayaran_update = $_POST['status_pembayaran_update'];
$tanggal_cetak_update = $_POST['tanggal_cetak_update']; 

$sql = "UPDATE slip_gaji SET 
    id_karyawan = '$id_karyawan_update',
    jumlah_gaji = '$total_gaji_update',
    metode_bayar = '$metode_bayar_update',
    status_pembayaran = '$status_pembayaran_update',
    tanggal_cetak = '$tanggal_cetak_update'
    WHERE id_slip_gaji   = '$id_slip_gaji_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: slip_gaji.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>