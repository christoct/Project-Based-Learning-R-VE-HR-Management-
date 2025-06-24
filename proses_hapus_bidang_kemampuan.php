<?php
include("config.php");
$id_bidang_kemampuan_hapus = $_POST["id_bidang_kemampuan_hapus"];

$sql = "DELETE FROM bidang_kemampuan
WHERE id_bidang_kemampuan = '$id_bidang_kemampuan_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Bidang Kemampuan Berhasil dihapus!";
    header("Location: kemampuan.php");
} else {
    echo "Error : " . $conn->error;
}


?>