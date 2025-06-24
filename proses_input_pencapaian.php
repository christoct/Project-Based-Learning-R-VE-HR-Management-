<?php
include("config.php");
$id_karyawan=$_POST["id_karyawan"];
$nama_pencapaian=$_POST["nama_pencapaian"];
$tanggal_mulai=$_POST["tanggal_mulai"];
$tanggal_selesai=$_POST["tanggal_selesai"];
$status_pencapaian=$_POST["status_pencapaian"];

$kata = explode(" ", $nama_pencapaian);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_pencapaian FROM pencapaian_karyawan ORDER BY id_pencapaian DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_pencapaian'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_pencapaian = "GOAL-".$inisial. "-" . $nomor_format;

$sql_input = "INSERT INTO pencapaian_karyawan
(id_pencapaian, nama_pencapaian, id_karyawan , tanggal_mulai,
tanggal_selesai, status_pencapaian)
VALUES ('$id_pencapaian', '$nama_pencapaian', '$id_karyawan', '$tanggal_mulai',
'$tanggal_selesai', '$status_pencapaian')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: pencapaian_karyawan.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>