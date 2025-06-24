<?php
include("config.php");
$id_karyawan=$_POST["id_karyawan"];
$id_penilai=$_POST["id_penilai"];
$tanggal_penilaian=$_POST["tanggal_penilaian"];
$nilai_akhir=$_POST["nilai_akhir"];
$status_penilaian=$_POST["status_penilaian"];
$nama_penilai=$_POST["nama_penilai"];
$nama_karyawan=$_POST["nama_karyawan"];

$kata = explode(" ", $nama_karyawan);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}
$kata2 = explode(" ", $nama_penilai);
$inisial2 = "";
foreach ($kata2 as $k2) {
    $inisial2 .= strtoupper(substr($k2, 0, 1));
}

$sql = "SELECT id_penilaian FROM penilaian_karyawan ORDER BY id_penilaian DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_penilaian'];
    $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_penilaian = $inisial. "/" . $inisial2 . "/" . $nomor_format;

$sql_input = "INSERT INTO penilaian_karyawan
(id_penilaian, id_karyawan, id_penilai, tanggal_penilaian,
id_akhir, status_penilaian)
VALUES ('$id_penilaian', '$id_karyawan', '$id_penilai', '$tanggal_penilaian',
'$nilai_akhir', '$status_penilaian')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: pbl_penilaian_karyawan.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>