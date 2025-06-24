<?php
include("config.php");
$id_rekening_hapus = $_POST["id_rekening_hapus"];

print_r($_POST);

$sql = "DELETE FROM rekening_karyawan
WHERE id_rekening   = '$id_rekening_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Rekening Berhasil dihapus!";
    header("Location: rekening_karyawan.php");
} else {
    echo "Error : " . $conn->error;
}


?>