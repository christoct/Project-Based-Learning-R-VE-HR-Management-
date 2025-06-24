<?php
include("config.php");

$id_karyawan = $_POST["id_karyawan_update"];
$nama = $_POST["nama_karyawan"];
$id_pekerjaan = $_POST["id_pekerjaan"];
$email_kantor = $_POST["email_kantor_karyawan"];
$telepon_kantor = $_POST["telepon_kantor_karyawan"];
$id_atasan = $_POST["atasan"];

$nik = $_POST["nik_update"];
$umur = $_POST["umur_update"];
$email_pribadi = $_POST["email_pribadi_update"];
$status_kawin = $_POST["status_kawin_update"];
$jenis_kelamin = $_POST["jenis_kelamin_update"];
$jumlah_anak = $_POST["jumlah_anak_update"];
$alamat = $_POST["alamat_update"];
$telepon_pribadi = $_POST["telepon_pribadi_update"];

$fotoBaru = $_FILES["foto_karyawan_update"]["name"];
$daftar_kemampuan = json_decode($_POST["daftar_kemampuan"], true);


$uploadFoto = "";
if (!empty($fotoBaru)) {
    $tmp = $_FILES["foto_karyawan_update"]["tmp_name"];
    $folder = "uploads/foto_karyawan/";
    $ext = strtolower(pathinfo($fotoBaru, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $allowed_ext)) {
        $namaBaru = uniqid("foto_") . "." . $ext;
        if (move_uploaded_file($tmp, $folder . $namaBaru)) {
            $uploadFoto = $namaBaru;
        } else {
            die("Gagal mengupload foto.");
        }
    } else {
        die("Ekstensi file tidak diperbolehkan.");
    }
}

$sqlProfil = "UPDATE profil_karyawan SET 
    nama_karyawan='$nama', 
    id_pekerjaan='$id_pekerjaan', 
    email='$email_kantor', 
    telepon_kerja='$telepon_kantor', 
    id_atasan='$id_atasan'";

if ($uploadFoto != "") {
    $sqlProfil .= ", foto_karyawan='$uploadFoto'";
}
$sqlProfil .= " WHERE id_karyawan='$id_karyawan'";

if (!$conn->query($sqlProfil)) {
    die("Gagal update data profil: " . $conn->error);
}

$sqlPribadi = "UPDATE data_pribadi SET 
    nik='$nik', 
    umur='$umur', 
    email_pribadi='$email_pribadi', 
    status_kawin='$status_kawin', 
    jenis_kelamin='$jenis_kelamin', 
    jumlah_anak='$jumlah_anak', 
    alamat='$alamat', 
    telepon_pribadi='$telepon_pribadi'
    WHERE id_karyawan='$id_karyawan'";

if (!$conn->query($sqlPribadi)) {
    die("Gagal update data pribadi: " . $conn->error);
}

$sqlUser = "UPDATE akun_pengguna SET 
    email_pengguna ='$email_kantor'
    WHERE id_karyawan='$id_karyawan'";

if (!$conn->query($sqlUser)) {
    die("Gagal update data user: " . $conn->error);
}


$conn->query("DELETE FROM kemampuan_karyawan WHERE id_karyawan='$id_karyawan'");

if (is_array($daftar_kemampuan)) {
    foreach ($daftar_kemampuan as $skill) {
        if (
            !isset($skill['bidang'], $skill['jenis'], $skill['tingkat']) ||
            $skill['bidang'] == "" || $skill['jenis'] == "" || $skill['tingkat'] == ""
        ) {
            continue;
        }

        $bidang = $conn->real_escape_string($skill['bidang']);
        $jenis = $conn->real_escape_string($skill['jenis']);
        $tingkat = $conn->real_escape_string($skill['tingkat']);

        $q = "SELECT id_kemampuan FROM kemampuan 
              JOIN bidang_kemampuan ON kemampuan.id_bidang_kemampuan = bidang_kemampuan.id_bidang_kemampuan 
              WHERE jenis_kemampuan='$jenis' AND nama_bidang_kemampuan='$bidang' LIMIT 1";

        $r = $conn->query($q);
        if ($r && $r->num_rows > 0) {
            $id_kemampuan = $r->fetch_assoc()["id_kemampuan"];
            $conn->query("INSERT INTO kemampuan_karyawan (id_karyawan, id_jenis_kemampuan, tingkat_kemampuan) 
                          VALUES ('$id_karyawan', '$id_kemampuan', '$tingkat')");
        }
    }
}

$conn->close();

header("Location: pbl_profil_karyawan.php");
exit();
?>