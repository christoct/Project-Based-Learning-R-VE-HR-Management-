<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_pekerjaan = $_POST["id_pekerjaan_update"];
    $nama_pekerjaan = $_POST["nama_pekerjaan_update"];
    $id_spesifikasi = $_POST["id_spesifikasi_update"];
    $id_penanggung_jawab = $_POST["id_pj_update"];
    $deskripsi = $_POST["deskripsi_update"];
    $daftar_kemampuan = isset($_POST["daftar_kemampuan"]) ? $_POST["daftar_kemampuan"] : "[]";

    $sql_update = "UPDATE pekerjaan SET 
        nama_pekerjaan = ?, 
        id_spesifikasi_kerja = ?, 
        id_penanggung_jawab = ?, 
        deskripsi_pekerjaan = ?
        WHERE id_pekerjaan = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssss", $nama_pekerjaan, $id_spesifikasi, $id_penanggung_jawab, $deskripsi, $id_pekerjaan);
    $stmt->execute();

    $sql_delete_kemampuan = "DELETE FROM kemampuan_kerja WHERE id_pekerjaan = ?";
    $stmt_delete = $conn->prepare($sql_delete_kemampuan);
    $stmt_delete->bind_param("s", $id_pekerjaan);
    $stmt_delete->execute();

    $kemampuan = json_decode($daftar_kemampuan, true);
    if (is_array($kemampuan)) {
        foreach ($kemampuan as $item) {
            $bidang = $item["bidang"];
            $jenis = $item["jenis"];
            $tingkat = $item["tingkat"];

            $sql_id_kemampuan = "SELECT id_kemampuan FROM kemampuan WHERE jenis_kemampuan = ?";
            $stmt_id = $conn->prepare($sql_id_kemampuan);
            $stmt_id->bind_param("s", $jenis);
            $stmt_id->execute();
            $result_id = $stmt_id->get_result();

            if ($result_id->num_rows > 0) {
                $row_id = $result_id->fetch_assoc();
                $id_kemampuan = $row_id["id_kemampuan"];

                $sql_insert = "INSERT INTO kemampuan_kerja (id_pekerjaan, id_jenis_kemampuan, tingkat_kemampuan) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("sss", $id_pekerjaan, $id_kemampuan, $tingkat);
                $stmt_insert->execute();
            }
        }
    }

    echo "Data berhasil di update";
    header("Location: deskripsi.php");
} else {
    echo "Invalid Request!";
}
?>
