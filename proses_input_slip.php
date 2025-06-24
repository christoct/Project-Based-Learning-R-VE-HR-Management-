<?php
include("config.php");
$id_slip = $_POST["id_slip"];
$karyawan_slip = $_POST["karyawan_slip"];
$total_gaji = $_POST["total_gaji"];
$metode_bayar = $_POST["metode_bayar"];
$status_pembayaran = $_POST["status_pembayaran"];
$tanggal_sql = $_POST["tanggal_sql"];

print_r($_POST);

$sql_input = "INSERT INTO slip_gaji
(id_slip_gaji , id_karyawan , jumlah_gaji, metode_bayar, status_pembayaran, tanggal_cetak)
VALUES ('$id_slip', '$karyawan_slip', '$total_gaji', '$metode_bayar', '$status_pembayaran', '$tanggal_sql')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: slip_gaji.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>