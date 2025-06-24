<?php
include("config.php");

$id_status_lamaran_update=$_POST["id_status_lamaran_update"];
$nama_status_lamaran_update=$_POST["nama_status_lamaran_update"];

print_r($_POST);

$sql = "UPDATE status_lamaran SET 
nama_status_lamaran ='$nama_status_lamaran_update'

WHERE id_status_lamaran ='$id_status_lamaran_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: status_lamaran.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>