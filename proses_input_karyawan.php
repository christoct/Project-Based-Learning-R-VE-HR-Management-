<?php
include("config.php");

$nama_karyawan = $_POST['nama_karyawan'];
$nama_pekerjaan = $_POST['nama_pekerjaan'];
$email_kantor = $_POST['email_kantor_karyawan'];
$telepon_kantor = $_POST['telepon_kantor_karyawan'];
$departemen = $_POST['departemen_dipilih'];
$divisi = $_POST['divisi_dipilih'];
$spec = $_POST['spec_dipilih'];
$atasan = $_POST['atasan'];

$nik = $_POST['NIK_karyawan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$umur = $_POST['umur_karyawan'];
$jumlah_anak = $_POST['jumlah_anak'];
$status_kawin = $_POST['status_kawin'];
$alamat = $_POST['alamat_karyawan'];
$email_pribadi = $_POST['email_karyawan'];
$telepon_pribadi = $_POST['telepon_karyawan'];

$foto_nama = '';
if (isset($_FILES['foto_karyawan']) && $_FILES['foto_karyawan']['error'] === UPLOAD_ERR_OK) {
    $folder = "uploads/foto_karyawan/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $nama_file_asli = basename($_FILES["foto_karyawan"]["name"]);
    $ekstensi = pathinfo($nama_file_asli, PATHINFO_EXTENSION);
    $nama_baru = uniqid('foto_', true) . '.' . $ekstensi;
    $lokasi_tmp = $_FILES["foto_karyawan"]["tmp_name"];
    $lokasi_tujuan = $folder . $nama_baru;

    if (move_uploaded_file($lokasi_tmp, $lokasi_tujuan)) {
        $foto_nama = $nama_baru;
    } else {
        die("Gagal upload file");
    }
}

$kata = explode(" ", $nama_karyawan);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_karyawan FROM profil_karyawan 
        WHERE id_karyawan LIKE '$inisial-%' 
        ORDER BY id_karyawan DESC LIMIT 1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_karyawan'];
    $last_number = intval(substr($last_id, strrpos($last_id, '-') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);
$id_karyawan = $inisial . "-" . $nomor_format;

print_r($_POST);

$sql_profil = "INSERT INTO profil_karyawan
(id_karyawan, nama_karyawan, id_pekerjaan, email, telepon_kerja, id_atasan, foto_karyawan)
VALUES (
    '$id_karyawan',
    '$nama_karyawan',
    '$nama_pekerjaan',
    '$email_kantor',
    '$telepon_kantor',
    '$atasan',
    '$foto_nama'
)";

if ($conn->query($sql_profil) === TRUE) {

    $sql_pribadi = "INSERT INTO data_pribadi
    (id_karyawan, nik, jenis_kelamin, umur, jumlah_anak, status_kawin, alamat, email_pribadi, telepon_pribadi)
    VALUES (
        '$id_karyawan',
        '$nik',
        '$jenis_kelamin',
        '$umur',
        '$jumlah_anak',
        '$status_kawin',
        '$alamat',
        '$email_pribadi',
        '$telepon_pribadi'
    )";

    if (!$conn->query($sql_pribadi)) {
        echo "Gagal menyimpan data pribadi: " . $conn->error;
        exit;
    }

    $daftar_kemampuan = $_POST['daftar_kemampuan'];
    $skill_array = explode(";", $daftar_kemampuan);

    foreach ($skill_array as $baris) {
        if (trim($baris) == "")
            continue;

        list($id_bidang, $id_jenis, $tingkat) = explode("|", $baris);

        $sql_kemampuan = "INSERT INTO kemampuan_karyawan 
        (id_karyawan, id_jenis_kemampuan, tingkat_kemampuan)
        VALUES (
            '$id_karyawan',
            '$id_jenis',
            '$tingkat'
        )";

        if (!$conn->query($sql_kemampuan)) {
            echo "Gagal menyimpan skill: " . $conn->error;
        }
    }

    header("Location: pbl_profil_karyawan.php");
    exit;

} else {
    echo "Gagal menyimpan data karyawan: " . $conn->error;
}
?>