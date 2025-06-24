<?php
include("config.php");

$id_Kemampuan_update=$_POST["id_Kemampuan_update"];
$id_bidang_kemampuan_update_skill=$_POST["id_bidang_kemampuan_update_skill"];
$jenis_kemampuan_update=$_POST["jenis_kemampuan_update"];

print_r($_POST);

$sql = "UPDATE kemampuan SET 
id_bidang_kemampuan ='$id_bidang_kemampuan_update_skill',
jenis_kemampuan ='$jenis_kemampuan_update'
WHERE id_kemampuan   ='$id_Kemampuan_update'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil di update";
    header("Location: kemampuan.php");
} else {
    echo "Error : " . $conn->error;
}

$conn->close();
?>