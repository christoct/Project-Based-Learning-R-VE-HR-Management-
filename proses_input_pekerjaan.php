<?php
include("config.php");

$pekerjaan_diinput=$_POST["pekerjaan_diinput"];
$departemen_dipilih=$_POST["departemen_dipilih"];
$divisi_dipilih=$_POST["divisi_dipilih"];
$spec_dipilih=$_POST["spec_dipilih"];
$penanggung_jawab=$_POST["penanggung_jawab"];
$deskripsi=$_POST["deskripsi"];

print_r($_POST);


$kata = explode(" ", $pekerjaan_diinput);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}

$sql = "SELECT id_pekerjaan FROM pekerjaan ORDER BY id_pekerjaan DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_pekerjaan'];
    $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1; 
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_pekerjaan = "JOB/" . $inisial . "/" . $nomor_format;

$sql_input = "INSERT INTO pekerjaan
(id_pekerjaan , nama_pekerjaan, id_spesifikasi_kerja, id_penanggung_jawab, deskripsi_pekerjaan )
VALUES ('$id_pekerjaan', '$pekerjaan_diinput', '$spec_dipilih','$penanggung_jawab','$deskripsi')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
        $daftar_kemampuan = $_POST['daftar_kemampuan'];
    $skill_array = explode(";", $daftar_kemampuan);

    foreach ($skill_array as $baris) {
        if (trim($baris) == "")
            continue;

        list($id_bidang, $id_jenis, $tingkat) = explode("|", $baris);

        $sql_kemampuan = "INSERT INTO kemampuan_kerja 
        (id_pekerjaan, id_jenis_kemampuan, tingkat_kemampuan)
        VALUES (
            '$id_pekerjaan',
            '$id_jenis',
            '$tingkat'
        )";

        if (!$conn->query($sql_kemampuan)) {
            echo "Gagal menyimpan skill: " . $conn->error;
        }
    }

    header("Location: deskripsi.php");
} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>