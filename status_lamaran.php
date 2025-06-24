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
    <title>Status Lamaran</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="rekrutmen.js"></script>
<script src="search_karyawan.js"></script>
<script src="session.js"></script>
<script src="update_delete_status_lamaran.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="rekrutmen.css">

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
    <div class="overlay"></div>
    <form action="proses_input_status_lamaran.php" id="form_input_status_lamaran" method="POST">
        <div class="popup" id="input_status">
            <span class="x">&times;</span>
            <span class="popup_tittle">Tambah Status Lamaran</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Status Lamaran </td>
                    <td class="popup_data">
                        <input type="text" name="nama_status_lamaran" placeholder="co. Interview User"
                            class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_input_status_lamaran">Simpan</span>
        </div>
    </form>

    <form action="proses_update_status_lamaran.php" id="form_update_status_lamaran" method="POST">
        <div class="popup" id="update_status">
            <input type="hidden" name="id_status_lamaran_update" id="id_status_lamaran_update">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Status Lamaran</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Status Lamaran </td>
                    <td class="popup_data">
                        <input type="text" id="nama_status_lamaran_update" name="nama_status_lamaran_update"
                            placeholder="co. Interview User" class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close" id="hapus_status">Hapus</span>
            <span class="save" id="simpan_update_status_lamaran">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_status_lamaran.php" id="form_hapus_status_lamaran" method="post">
        <div class="popup" id="hapus_status_lamaran_popup">
            <input type="hidden" name="id_status_lamaran_hapus" id="id_status_lamaran_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Status Lamaran</span>
            <hr class="line">
            <span class="popup_text" id="nama_status_lamaran_hapus">Apakah Anda yakin mau menghapus status lamaran
                ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_status_lamaran">Ya</span>
                <span class="tidak">Tidak</span>
            </div>
        </div>
    </form>


    <div class="top">
        <div class="modul">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="back">
                <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31
12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
            </svg>

            <img src="recruitment.png" alt="Gambar Modul" class="gambar_modul">Rekrutmen
        </div>
        <ul class="daftar_menu">
            <li class="menu" id="lowongan_kerja">Lowongan Kerja</li>
            <li class="menu" id="pelamar">Pelamar</li>
            <li class="menu" id="status_lamaran">Status Lamaran</li>
        </ul>
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


    <div class="bar"> <span class="new" id="new_status">Baru</span>
        <span class="tittle_menu">Status Lamaran</span>
        <div class="wadah_search"><input type="text" class="search_bar" id="search_input"
                placeholder="Cari Nama Status..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="wadah_stat">
        <table class="tabel_stat">
            <tr class="heading_stat">
                <td class="text_heading">
                    Status lamaran
                </td>
            </tr>
            <?php
            include("config.php");

            $keyword = "";
            if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                $keyword = trim($_GET['search']);
                $sql = "SELECT * FROM status_lamaran
            WHERE nama_status_lamaran LIKE '%$keyword%'";
            } else {
                $sql = "SELECT * FROM status_lamaran";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo ("<tr class='data_stat'>
                    <td class='isi_data_stat'>" . $row["nama_status_lamaran"] . "</td>
                    <input type='hidden' class='id_status_lamaran' value='" . $row["id_status_lamaran"] . "'>
                    <input type='hidden' class='nama_status_lamaran' value='" . $row["nama_status_lamaran"] . "'>
                    </tr>");
                }
            } else {
                echo ("<tr class=''>
                    <td class=''>0 results</td>
                    </tr>");
            }
            ?>
        </table>
    </div>
</body>

</html>