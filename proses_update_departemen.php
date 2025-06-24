<?php
include("config.php");

$id_departemen_update=$_POST["id_departemen_update"];
$nama_departemen_update=$_POST["nama_departemen_update"];
$nama_dirktur_update=$_POST["nama_dirktur_update"];

print_r($_POST);

$sql = "UPDATE departemen SET 
nama_departemen='$nama_departemen_update',
id_direktur = '$nama_dirktur_update'
WHERE id_departemen ='$id_departemen_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: departemen.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>