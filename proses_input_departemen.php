<?php
include("config.php");
$nama_departemen=$_POST["nama_departemen"];
$direktur=$_POST["direktur"];

$kata = explode(" ", $nama_departemen);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_departemen FROM departemen ORDER BY id_departemen DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_departemen'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_departemen = "D-" . $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO departemen
(id_departemen, nama_departemen, id_direktur)
VALUES ('$id_departemen', '$nama_departemen', '$direktur')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: departemen.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>