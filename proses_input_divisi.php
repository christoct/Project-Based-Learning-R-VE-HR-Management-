<?php
include("config.php");
$departemen_dipilih=$_POST["departemen_dipilih"];
$nama_divisi=$_POST["nama_divisi"];
$nama_manager=$_POST["nama_manager"];

$kata = explode(" ", $nama_divisi);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_divisi FROM divisi ORDER BY id_divisi DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_divisi'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_divisi = "DIV-" . $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO divisi
(id_divisi, id_departemen, nama_divisi, id_manager)
VALUES ('$id_divisi', '$departemen_dipilih', '$nama_divisi', '$nama_manager')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: divisi.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>