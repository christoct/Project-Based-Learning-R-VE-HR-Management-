<?php
include("config.php");

$id_divisi_update=$_POST["id_divisi_update"];
$id_departemen_update=$_POST["id_departemen_update"];
$nama_divisi_update=$_POST["nama_divisi_update"];
$nama_manager_update=$_POST["nama_manager_update"];

print_r($_POST);

$sql = "UPDATE divisi SET 
id_departemen ='$id_departemen_update',
nama_divisi = '$nama_divisi_update',
id_manager  = '$nama_manager_update'

WHERE id_divisi ='$id_divisi_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: divisi.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>