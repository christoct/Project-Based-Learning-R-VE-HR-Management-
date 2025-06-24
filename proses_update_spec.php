<?php
include("config.php");

$id_spesifikasi_kerja_update=$_POST["id_spesifikasi_kerja_update"];
$id_departemen_update=$_POST["id_departemen_update"];
$id_divisi_update=$_POST["id_divisi_update"];
$nama_spesifikasi_update=$_POST["nama_spesifikasi_update"];
$id_supervisor_update=$_POST["id_supervisor_update"];

print_r($_POST);

$sql = "UPDATE spesifikasi_kerja SET 
id_divisi  ='$id_divisi_update',
nama_spesifikasi = '$nama_spesifikasi_update',
id_supervisor   = '$id_supervisor_update'

WHERE id_spesifikasi_kerja ='$id_spesifikasi_kerja_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: spesifikasi.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>