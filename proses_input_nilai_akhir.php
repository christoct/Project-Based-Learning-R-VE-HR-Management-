<?php
include("config.php");
$nama_nilai_akhir=$_POST["nama_nilai_akhir"];

$sql = "SELECT id_nilai_akhir FROM nilai_akhir ORDER BY id_nilai_akhir DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_nilai_akhir'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1;
}
$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);
$id_nilai_akhir = "NA-". $nomor_format;

$sql_input = "INSERT INTO nilai_akhir
(id_nilai_akhir, nama_nilai_akhir)
VALUES ('$id_nilai_akhir', '$nama_nilai_akhir')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: nilai_akhir.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>