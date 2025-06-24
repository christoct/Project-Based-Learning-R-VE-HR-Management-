<?php
include("config.php");
$nama_lowongan=$_POST["nama_lowongan"];
$departemen=$_POST["departemen"];
$divisi=$_POST["divisi"];
$spec=$_POST["spec"];
$pekerjaan=$_POST["pekerjaan"];
$tenggat=$_POST["tenggat"];
$status_lowongan=$_POST["status_lowongan"];

$kata = explode(" ", $nama_lowongan);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_lowongan FROM lowongan ORDER BY id_lowongan DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_lowongan'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_lowongan = $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO lowongan
(id_lowongan, nama_lowongan, id_pekerjaan, tenggat_akhir, status_lowongan)
VALUES ('$id_lowongan', '$nama_lowongan', '$pekerjaan', '$tenggat', '$status_lowongan')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: pbl_lowongan_kerja.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>