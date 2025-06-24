<?php
include("config.php");

$id = $_POST['id_struktur_gaji_update'];
$nama = $_POST['nama_struktur_update'];
$jam = $_POST['jam_kerja_update'];
$gaji = $_POST['jumlah_gaji_raw_update']; // gunakan raw
$interval = $_POST['interval_gaji_update'];

$sql = "UPDATE struktur_gaji SET 
    nama_struktur = '$nama',
    jam_kerja = '$jam',
    jumlah_gaji = '$gaji',
    interval_gaji = '$interval'
    WHERE id_struktur_gaji = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: pbl_struktur_gaji.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>