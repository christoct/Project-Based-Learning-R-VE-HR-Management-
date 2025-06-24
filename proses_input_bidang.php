<?php
include("config.php");
$nama_bidang=$_POST["nama_bidang"];

$kata = explode(" ", $nama_bidang);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_bidang_kemampuan FROM bidang_kemampuan ORDER BY id_bidang_kemampuan DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_bidang_kemampuan'];
    $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1;
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_bidang_kemampuan = "BK/" . $inisial . "/" . $nomor_format;

$sql_input = "INSERT INTO bidang_kemampuan
(id_bidang_kemampuan, nama_bidang_kemampuan)
VALUES ('$id_bidang_kemampuan', '$nama_bidang')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: kemampuan.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>