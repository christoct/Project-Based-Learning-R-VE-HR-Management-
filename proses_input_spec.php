<?php
include("config.php");
$departemen_dipilih=$_POST["departemen_dipilih"];
$divisi_dipilih=$_POST["divisi_dipilih"];
$nama_spec=$_POST["nama_spec"];
$nama_spv=$_POST["nama_spv"];

$kata = explode(" ", $nama_spec);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_spesifikasi_kerja	 FROM spesifikasi_kerja ORDER BY id_spesifikasi_kerja DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_spesifikasi_kerja'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_spec = "SP-" . $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO spesifikasi_kerja
(id_spesifikasi_kerja, id_divisi, nama_spesifikasi, id_supervisor)
VALUES ('$id_spec', '$divisi_dipilih', '$nama_spec', '$nama_spv')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: spesifikasi.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>