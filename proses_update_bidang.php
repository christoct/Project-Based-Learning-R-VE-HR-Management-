<?php
include("config.php");

$id_bidang_kemampuan_update=$_POST["id_bidang_kemampuan_update"];
$nama_bidang_kemampuan_update=$_POST["nama_bidang_kemampuan_update"];

print_r($_POST);

$sql = "UPDATE bidang_kemampuan SET 
nama_bidang_kemampuan ='$nama_bidang_kemampuan_update'
WHERE id_bidang_kemampuan  ='$id_bidang_kemampuan_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: kemampuan.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>