<?php
include("config.php");
$nama_status_lamaran=$_POST["nama_status_lamaran"];


$sql = "SELECT id_status_lamaran  FROM status_lamaran ORDER BY id_status_lamaran  DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_status_lamaran'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}
$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_status_lamaran =  "SL-" . $nomor_format;

$sql_input = "INSERT INTO status_lamaran
(id_status_lamaran, nama_status_lamaran)
VALUES ('$id_status_lamaran', '$nama_status_lamaran')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: status_lamaran.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>