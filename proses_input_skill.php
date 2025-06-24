<?php
include("config.php");
$bidang_dipilih = $_POST["bidang_dipilih"];
$jenis_skill = $_POST["jenis_skill"];

$kata = explode(" ", $jenis_skill);
$inisial = "";
foreach ($kata as $k) {
    $inisial .= strtoupper(substr($k, 0, 1));
}


$sql = "SELECT id_kemampuan 
        FROM kemampuan 
        WHERE id_kemampuan LIKE 'SKILL/$inisial/%' 
        ORDER BY CAST(SUBSTRING_INDEX(id_kemampuan, '/', -1) AS UNSIGNED) DESC 
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row['id_kemampuan'];
    $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
    $next_number = $last_number + 1;
} else {
    $next_number = 1;
}

$nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);

$id_kemampuan = "SKILL/" . $inisial . "/" . $nomor_format;

$sql_input = "INSERT INTO kemampuan
(id_kemampuan, 	id_bidang_kemampuan, jenis_kemampuan)
VALUES ('$id_kemampuan', '$bidang_dipilih', '$jenis_skill')";

if ($conn->query($sql_input) === TRUE) {
    echo "<br><b>Data berhasil di input</b><br><br>";
    header("Location: kemampuan.php");

} else {
    echo "Gagal: " . $sql_input . "<br>" . $conn->error;
}

?>