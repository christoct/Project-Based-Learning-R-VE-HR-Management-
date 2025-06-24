<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['id_karyawan'])) {
    header("Location: pbl_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<script src="jquery.js"></script>
<script src="dashboard_function.js"></script>
<script src="session.js"></script>
<link rel="stylesheet" href="dashboard_style.css">

<body>
    <?php
    include("config.php");
    echo ("<input type='hidden' class='username_login' name='username_login' value='" . $_SESSION['username'] . "'>
        <input type='hidden' class='id_login' name='id_login' value='" . $_SESSION['id_karyawan'] . "'>");
    $id_karyawan = $_SESSION["id_karyawan"];
    $sql = "SELECT * FROM profil_karyawan
        WHERE id_karyawan = '$id_karyawan'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ("<input type='hidden' id='foto_user' value='" . $row["foto_karyawan"] . "'>");
        }
    } else {
        echo "Gagal akses data profil";
    }
    ?>
    <div class="top">R-VE HR Management
        <ul class="profile_drop"><img src="profile.jpg" alt="" class="profile">
            <li class="user">
                <div class="user_info">A-001 Admin1</div>
            </li>
            <li class="space">&nbsp;</li>
            <li class="opsi_profil"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="emot_lihat">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9
    0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683
    18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
                <span class="lihat">Lihat Profil</span>
            </li>
            <li class="opsi_profil"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="emot_logout">
                    <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5
1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3
    3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75
    0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72
    1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75
    0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                </svg><span class="logout">
                    Logout</span></li>
        </ul>
    </div>
    <ul class="daftar_modul">
        <li>
            <div class="modul" id="rekrutmen"><img src="recruitment.png" alt="Gambar Modul Tidak Terdefinisi"
                    class="modul_img">
                <span class="modul_tittle">Rekrutmen</span>
                <span class="isi_modul">
                    <ul>
                        <li class="list">Lowongan Kerja</li>
                        <li class="list">Pelamar</li>
                        <li class="list">Status Lamaran</li>
                    </ul>
                </span>
            </div>
        </li>

        <li>
            <div class="modul" id="karyawan"><img src="employee.png" alt="Gambar Modul Tidak Terdefinisi"
                    class="modul_img">
                <span class="modul_tittle">Karyawan</span>
                <span class="isi_modul">
                    <ul>
                        <li class="list">Profil Karyawan</li>
                        <li class="list">Departemen, Divisi & Spesifikasi Kerja</li>
                        <li class="list">Deskripsi Pekerjaan</li>
                        <li class="list">Kemampuan Kerja</li>
                    </ul>
                </span>
            </div>
        </li>

        <li>
            <div class="modul" id="penggajian"><img src="payroll.png" alt="Gambar Modul Tidak Terdefinisi"
                    class="modul_img">
                <span class="modul_tittle">Penggajian</span>
                <span class="isi_modul">
                    <ul>
                        <li class="list">Struktur Gaji</li>
                        <li class="list">Rekening Karyawan</li>
                        <li class="list">Kontrak Kerja</li>
                        <li class="list">Slip Gaji</li>
                    </ul>
                </span>
            </div>
        </li>

        <li>
            <div class="modul" id="penilaian"><img src="appraisals.png" alt="Gambar Modul Tidak Terdefinisi"
                    class="modul_img">
                <span class="modul_tittle">&nbsp;Penilaian</span>
                <span class="isi_modul">
                    <ul>
                        <li class="list">Penilaian Karyawan</li>
                        <li class="list">Nilai Akhir</li>
                        <li class="list">Pencapaian Karyawan</li>
                    </ul>
                </span>
            </div>
        </li>

    </ul>

</body>

</html>