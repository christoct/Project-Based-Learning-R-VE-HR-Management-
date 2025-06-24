<?php
include("config.php");
$nama_karyawan=$_POST["nama_karyawan"];
$bank=$_POST["bank"];
$nomor_rekening=$_POST["nomor_rekening"];


$sql = "SELECT id_rekening  FROM rekening_karyawan ORDER BY id_rekening  DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_rekening'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_rekening = "REK-" . $nomor_format;

$sql_input = "INSERT INTO rekening_karyawan
(id_rekening, id_karyawan, nama_bank, nomor_rekening)
VALUES ('$id_rekening', '$nama_karyawan', '$bank', '$nomor_rekening')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: rekening_karyawan.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>