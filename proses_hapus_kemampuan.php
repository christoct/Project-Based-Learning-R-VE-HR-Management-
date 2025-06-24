<?php
include("config.php");
$id_kemampuan_hapus = $_POST["id_kemampuan_hapus"];

$sql2 = "DELETE FROM kemampuan_karyawan
WHERE id_jenis_kemampuan  = '$id_kemampuan_hapus'";
if ($conn->query($sql2) === TRUE) {
    echo "Data Kemampuan Karyawan Berhasil dihapus!";
} else {
    echo "Error : " . $conn->error;
}

$sql3 = "DELETE FROM kemampuan_kerja
WHERE id_jenis_kemampuan = '$id_kemampuan_hapus'";
if ($conn->query($sql3) === TRUE) {
    echo "Data Kemampuan Kerja Berhasil dihapus!";
} else {
    echo "Error : " . $conn->error;
}

$sql = "DELETE FROM kemampuan
WHERE id_kemampuan  = '$id_kemampuan_hapus'";
if ($conn->query($sql) === TRUE) {
    echo "Data Kemampuan Berhasil dihapus!";
        header("Location: kemampuan.php");
} else {
    echo "Error : " . $conn->error;
}
?>