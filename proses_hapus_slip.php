<?php
include("config.php");
$id_slip_gaji_hapus = $_POST["id_slip_gaji_hapus"];

$sql = "DELETE FROM slip_gaji 
WHERE id_slip_gaji  = '$id_slip_gaji_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Slip Gaji Berhasil dihapus!";
    header("Location: slip_gaji.php");
} else {
    echo "Error : " . $conn->error;
}


?>