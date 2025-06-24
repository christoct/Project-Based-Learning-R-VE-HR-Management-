<?php
include("config.php");
$nama_kontrak=$_POST["nama_kontrak"];
$id_karyawan=$_POST["id_karyawan"];
$nama_karyawan=$_POST["nama_karyawan"];
$struktur_gaji=$_POST["struktur_gaji"];
$penanggung_jawab=$_POST["penanggung_jawab"];
$tanggal_mulai=$_POST["tanggal_mulai"];
$tanggal_akhir=$_POST["tanggal_akhir"];
$status_kontrak=$_POST["status_kontrak"];

$kata = explode(" ", $nama_karyawan);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_kontrak FROM kontrak_kerja ORDER BY id_kontrak DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_kontrak'];
    $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_kontrak = "CON/" . $inisial . "/" . $nomor_format;

$sql_input = "INSERT INTO kontrak_kerja
(id_kontrak, nama_kontrak, id_karyawan, id_struktur_gaji,
id_penanggung_jawab, tanggal_mulai_kontrak, tanggal_akhir_kontrak,
status_kontrak)
VALUES ('$id_kontrak', '$nama_kontrak', '$id_karyawan', '$struktur_gaji',
'$penanggung_jawab', '$tanggal_mulai', '$tanggal_akhir',
'$status_kontrak')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: kontrak.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>