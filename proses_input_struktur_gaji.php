<?php
include("config.php");
$nama_struktur_gaji=$_POST["nama_struktur_gaji"];
$jam_kerja=$_POST["jam_kerja"];
$jumlah_gaji = $_POST["jumlah_gaji_raw"];
$interval_gaji=$_POST["interval_gaji"];

print_r($_POST);

$kata = explode(" ", $nama_struktur_gaji);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_struktur_gaji FROM struktur_gaji ORDER BY id_struktur_gaji DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_struktur_gaji'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_struktur_gaji = "SG-" . $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO struktur_gaji
(id_struktur_gaji, nama_struktur, jam_kerja, jumlah_gaji, interval_gaji)
VALUES ('$id_struktur_gaji', '$nama_struktur_gaji', '$jam_kerja', '$jumlah_gaji', '$interval_gaji')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: pbl_struktur_gaji.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>