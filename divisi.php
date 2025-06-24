<!DOCTYPE html>
<html lang="id">
<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['id_karyawan'])) {
    header("Location: pbl_login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisi</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="karyawan.js"></script>
<script src="update_delete_divisi.js"></script>
<script src="search_karyawan.js"></script>
<script src="session.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="karyawan.css">

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
    <div class="popup" id="input_divisi">
        <span class="x">&times;</span>
        <span class="popup_tittle">Tambah Divisi</span>
        <hr class="line">
        <form action="proses_input_divisi.php" id="form_input_divisi" method="POST">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Departemen </td>
                    <td class="popup_data">
                        <select name="departemen_dipilih" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Marketing</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM departemen";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_departemen'] . "'>" . $row['nama_departemen'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Divisi </td>
                    <td class="popup_data">
                        <input type="text" name="nama_divisi" placeholder="co. HR Training" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Manager </td>
                    <td class="popup_data">
                        <select name="nama_manager" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Pemimpin Divisi</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_karyawan'] . "'>" . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
        </form>
        <hr class="line">
        <span class="close">Tutup</span>
        <span class="save" id="simpan_input_divisi">Simpan</span>
    </div>

    <form action="proses_update_divisi.php" method="POST" id="form_update_divisi">
        <input type="hidden" name="id_divisi_update" id="id_divisi_update">
        <div class="popup" id="update_divisi">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Divisi</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Departemen </td>
                    <td class="popup_data">
                        <select name="id_departemen_update" id="id_departemen_update" class="popup_select">
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM departemen";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_departemen'] . "'>" . $row['nama_departemen'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Divisi </td>
                    <td class="popup_data">
                        <input id="nama_divisi_update" type="text" name="nama_divisi_update"
                            placeholder="co. HR Training" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Manager </td>
                    <td class="popup_data">
                        <select name="nama_manager_update" id="nama_manager_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Pemimpin Divisi</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_karyawan'] . "'>" . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_update_divisi">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_divisi.php" method="post" id="form_hapus_divisi">
        <div class="popup" id="hapus_divisi_popup">
            <input type="hidden" name="id_divisi_hapus" id="id_divisi_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Divisi</span>
            <hr class="line">
            <span class="popup_text" id="nama_divisi_hapus">Apakah Anda yakin mau menghapus divisi ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_divisi">Ya</span>
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

            <img src="employee.png" alt="Gambar Modul" class="gambar_modul">Karyawan
        </div>
        <ul class="daftar_menu">
            <li class="menu" id="profil_karyawan">Profil Karyawan</li>
            <li class="menu" id="departemen">Departemen</li>
            <li class="menu" id="divisi">Divisi</li>
            <li class="menu" id="spesifikasi">Spesifikasi Kerja</li>
            <li class="menu" id="deskripsi">Deskripsi Pekerjaan</li>
            <li class="menu" id="kemampuan">Kemampuan Kerja</li>
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

    <div class="bar"> <span class="new" id="new_divisi">Baru</span>
        <span class="tittle_karyawan">Divisi</span>
        <div class="wadah_search"><input type="text" id="search_input" class="search_bar"
                placeholder="Cari Nama Divisi..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_divisi">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT divisi.*, profil_karyawan.nama_karyawan, departemen.nama_departemen
            FROM divisi
            JOIN profil_karyawan ON divisi.id_manager = profil_karyawan.id_karyawan
            JOIN departemen ON divisi.id_departemen = departemen.id_departemen
            WHERE divisi.nama_divisi LIKE '%$keyword%'";
        } else {
            $sql = "SELECT divisi.*, profil_karyawan.nama_karyawan, departemen.nama_departemen
            FROM divisi
            JOIN profil_karyawan ON divisi.id_manager = profil_karyawan.id_karyawan
            JOIN departemen ON divisi.id_departemen = departemen.id_departemen";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_divisi'>
            <span class='data_tittle_karyawan'>" . $row["nama_divisi"] . "</span><br>
            <hr>
            <span class='body_divisi'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_divisi'>
                        <path fill-rule='evenodd' d='M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 
                            1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 
                            0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z' clip-rule='evenodd' />
                    </svg>
                </span>" . $row["nama_karyawan"] . "</span><br>
            <span class='keterangan_divisi'>" . $row["nama_departemen"] . "</span><br>
            <hr>
            <div class='ubah_karyawan'>Ubah</div>
            <div class='hapus_karyawan'>Hapus</div>
            <input type='hidden' class='id_departemen' value='" . $row["id_departemen"] . "'>
            <input type='hidden' class='id_divisi' value='" . $row["id_divisi"] . "'>
            <input type='hidden' class='nama_divisi' value='" . $row["nama_divisi"] . "'>
            <input type='hidden' class='id_manager' value='" . $row["id_manager"] . "'>
        </div>");
            }
        } else {
            echo "<div style='padding:1rem;'>Tidak ada data divisi ditemukan.</div>";
        }
        ?>

    </div>

</body>

</html>