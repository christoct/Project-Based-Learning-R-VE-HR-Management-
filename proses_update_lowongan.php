<?php
include("config.php");

$id_lowongan           = $_POST["update_id_lowongan"];
$nama_lowongan         = $_POST["update_nama_lowongan"];
$id_departemen         = $_POST["update_id_departemen"];
$id_divisi             = $_POST["update_id_divisi"];
$id_spesifikasi_kerja  = $_POST["update_id_spesifikasi_kerja"];
$id_pekerjaan          = $_POST["update_id_pekerjaan"];
$tenggat_akhir         = $_POST["update_tenggat_akhir"];
$status_lowongan       = $_POST["update_status_lowongan"];


$sql = "UPDATE lowongan SET 
    nama_lowongan = '$nama_lowongan',
    id_pekerjaan = '$id_pekerjaan',
    status_lowongan = '$status_lowongan',
    tenggat_akhir = '$tenggat_akhir'
WHERE id_lowongan = '$id_lowongan'";

if ($conn->query($sql) === TRUE) {
    header("Location: pbl_lowongan_kerja.php");
    exit;
} else {
    echo "Gagal update data: " . $conn->error;
    print_r($_POST);
}

$conn->close();
?>
