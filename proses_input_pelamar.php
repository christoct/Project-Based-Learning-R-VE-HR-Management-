<?php
include("config.php");
$nama_pelamar = $_POST['nama_pelamar'];
$lowongan_dipilih = $_POST['lowongan_dipilih'];
$telepon_pelamar = $_POST['telepon_pelamar'];
$email_pelamar = $_POST['email_pelamar'];
$recruiter = $_POST['recruiter'];
$interviewer = $_POST['interviewer'];
$status_lamaran = $_POST['status_lamaran'];
$linkedln = $_POST['linkedln'];
$foto_nama = '';
print_r($_POST);

if (isset($_FILES['profil_pelamar']) && $_FILES['profil_pelamar']['error'] === UPLOAD_ERR_OK) {
    $folder = "uploads/profil_pelamar/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $nama_file_asli = basename($_FILES["profil_pelamar"]["name"]);
    $ekstensi = pathinfo($nama_file_asli, PATHINFO_EXTENSION);
    $nama_baru = uniqid('foto_', true) . '.' . $ekstensi;
    $lokasi_tmp = $_FILES["profil_pelamar"]["tmp_name"];
    $lokasi_tujuan = $folder . $nama_baru;

    if (move_uploaded_file($lokasi_tmp, $lokasi_tujuan)) {
        $foto_nama = $nama_baru;
    } else {
        die("Gagal upload file");
    }
}

$cv_nama = '';
if (isset($_FILES['cv_pelamar']) && $_FILES['cv_pelamar']['error'] === UPLOAD_ERR_OK) {
    $folder_cv = "uploads/cv_pelamar/";
    if (!file_exists($folder_cv)) {
        mkdir($folder_cv, 0777, true);
    }

    $nama_file_cv = basename($_FILES["cv_pelamar"]["name"]);
    $ext_cv = pathinfo($nama_file_cv, PATHINFO_EXTENSION);

    $nama_cv_clean = preg_replace("/[^a-zA-Z0-9]/", "", $nama_pelamar);
    $kode_unik = mt_rand(1000000, 9999999);
    $nama_cv_baru = "cv_" . $nama_cv_clean . "_" . $kode_unik . "." . $ext_cv;

    $lokasi_tmp_cv = $_FILES["cv_pelamar"]["tmp_name"];
    $lokasi_cv_tujuan = $folder_cv . $nama_cv_baru;

    if (move_uploaded_file($lokasi_tmp_cv, $lokasi_cv_tujuan)) {
        $cv_nama = $nama_cv_baru;
    } else {
        die("Gagal upload CV");
    }
}


$kata = explode(" ", $nama_karyawan);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}


$sql = "SELECT id_pelamar FROM pelamar 
        WHERE id_pelamar LIKE '$inisial-%' 
        ORDER BY id_pelamar DESC LIMIT 1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_pelamar'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);
$id_pelamar ="PL-". $inisial . "-" . $nomor_format;

$sql_input = "INSERT INTO pelamar
(id_pelamar, nama_pelamar, id_lowongan, no_telp, id_rekruiter,
id_status_lamaran, alamat_email,
id_interviewer, profile_linkedln, foto_profile, file_cv)
VALUES ('$id_pelamar', '$nama_pelamar', '$lowongan_dipilih', '$telepon_pelamar', '$recruiter',
'$status_lamaran', '$email_pelamar',
'$interviewer', '$linkedln', '$foto_nama', '$cv_nama')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: pelamar.php");

} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>