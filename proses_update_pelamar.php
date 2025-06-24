<?php
include("config.php");

$id_pelamar = $_POST["id_pelamar_update"];
$nama_pelamar = $_POST["nama_pelamar_update"];
$id_lowongan = $_POST["id_lowongan_update"];
$no_telp = $_POST["no_telp_update"];
$alamat_email = $_POST["alamat_email_update"];
$id_rekruiter = $_POST["id_rekruiter_update"];
$id_interviewer = $_POST["id_interviewer_update"];
$id_status_lamaran = $_POST["id_status_lamaran_update"];
$linkedln = $_POST["profile_linkedln_update"];

$query_old = "SELECT foto_profile, file_cv FROM pelamar WHERE id_pelamar = '$id_pelamar'";
$result_old = $conn->query($query_old);
$row_old = $result_old->fetch_assoc();
$foto_lama = $row_old['foto_profile'];
$cv_lama = $row_old['file_cv'];

$foto_profile = $foto_lama;
if (isset($_FILES['foto_profile_update']) && $_FILES['foto_profile_update']['error'] === UPLOAD_ERR_OK) {
    $folder_foto = "uploads/profil_pelamar/";
    if (!file_exists($folder_foto)) {
        mkdir($folder_foto, 0777, true);
    }

    $ext_foto = pathinfo($_FILES['foto_profile_update']['name'], PATHINFO_EXTENSION);
    $nama_baru_foto = uniqid("foto_", true) . "." . $ext_foto;
    $lokasi_tmp_foto = $_FILES['foto_profile_update']['tmp_name'];
    $lokasi_simpan_foto = $folder_foto . $nama_baru_foto;

    if (move_uploaded_file($lokasi_tmp_foto, $lokasi_simpan_foto)) {

        if (!empty($foto_lama) && file_exists($folder_foto . $foto_lama)) {
            unlink($folder_foto . $foto_lama);
        }
        $foto_profile = $nama_baru_foto;
    }
}

$file_cv = $cv_lama;
if (isset($_FILES['cv_pelamar']) && $_FILES['cv_pelamar']['error'] === UPLOAD_ERR_OK) {
    $folder_cv = "uploads/cv_pelamar/";
    if (!file_exists($folder_cv)) {
        mkdir($folder_cv, 0777, true);
    }

    $ext_cv = pathinfo($_FILES['cv_pelamar']['name'], PATHINFO_EXTENSION);
    $nama_file_asli = pathinfo($_FILES['cv_pelamar']['name'], PATHINFO_FILENAME);
    $nama_baru_cv = "cv_" . preg_replace("/[^A-Za-z0-9]/", "_", $nama_pelamar) . "_" . uniqid() . "." . $ext_cv;
    $lokasi_tmp_cv = $_FILES['cv_pelamar']['tmp_name'];
    $lokasi_simpan_cv = $folder_cv . $nama_baru_cv;

    if (move_uploaded_file($lokasi_tmp_cv, $lokasi_simpan_cv)) {

        if (!empty($cv_lama) && file_exists($folder_cv . $cv_lama)) {
            unlink($folder_cv . $cv_lama);
        }
        $file_cv = $nama_baru_cv;
    }
}

$sql_update = "UPDATE pelamar SET 
    nama_pelamar = '$nama_pelamar',
    id_lowongan = '$id_lowongan',
    no_telp = '$no_telp',
    alamat_email = '$alamat_email',
    id_rekruiter = '$id_rekruiter',
    id_interviewer = '$id_interviewer',
    id_status_lamaran = '$id_status_lamaran',
    profile_linkedln = '$linkedln',
    foto_profile = '$foto_profile',
    file_cv = '$file_cv'
    WHERE id_pelamar = '$id_pelamar'";

if ($conn->query($sql_update) === TRUE) {
    header("Location: pelamar.php");
    exit();
} else {
    echo "Gagal update data: " . $conn->error;
}
?>
