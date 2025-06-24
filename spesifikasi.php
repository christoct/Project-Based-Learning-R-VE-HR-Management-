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
    <title>Spesifikasi Kerja</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="karyawan.js"></script>
<script src="update_delete_spec.js"></script>
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
    <div class="popup" id="input_spec">
        <span class="x">&times;</span>
        <span class="popup_tittle">Tambah Spesifikasi Kerja</span>
        <hr class="line">
        <form action="proses_input_spec.php" id="form_input_spec" method="POST">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Departemen </td>
                    <td class="popup_data">
                        <select name="departemen" id="departemen_pilih" class="popup_select">
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
                <tr id="baris_divisi">
                    <td class="popup_text">Nama Divisi </td>
                    <td class="popup_data">
                        <select name="divisi_dipilih" id="divisi_dipilih" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Marketing</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM divisi";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_divisi'] . "' data-id-departemen='" . $row['id_departemen'] . "'>" . $row['nama_divisi'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Spesifikasi</td>
                    <td class="popup_data">
                        <input type="text" name="nama_spec" placeholder="co. Barista" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Supervisor </td>
                    <td class="popup_data">
                        <select name="nama_spv" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Pemimpin Spesifikasi</option>
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
            <span class="save" id="simpan_input_spec">Simpan</span>
        </form>
    </div>

    <form action="proses_update_spec.php" method="POST" id="form_update_spec">
        <input type="hidden" name="id_spesifikasi_kerja_update" id="id_spesifikasi_kerja_update">
        <div class="popup" id="update_spec">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Spesifikasi Kerja</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Departemen </td>
                    <td class="popup_data">
                        <select name="id_departemen_update" id="id_departemen_update" class="popup_select">
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
                        <select name="id_divisi_update" id="id_divisi_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Produksi</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM divisi";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_divisi'] . "' data-id-departemen='" . $row['id_departemen'] . "'>" . $row['nama_divisi'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Spesifikasi</td>
                    <td class="popup_data">
                        <input type="text" name="nama_spesifikasi_update" id="nama_spesifikasi_update"
                            placeholder="co. Barista" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Supervisor </td>
                    <td class="popup_data">
                        <select name="id_supervisor_update" id="id_supervisor_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Pemimpin Spesifikasi</option>
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
            <span class="save" id="simpan_update_spec">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_spec.php" method="post" id="form_hapus_spec">
        <div class="popup" id="hapus_spec_popup">
            <input type="hidden" name="id_spesifikasi_kerja_hapus" id="id_spesifikasi_kerja_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Spesifikasi Kerja</span>
            <hr class="line">
            <span class="popup_text" id="nama_spesifikasi_hapus">Apakah Anda yakin mau menghapus spesifikasi kerja
                ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_spec">Ya</span>
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

    <div class="bar"> <span class="new" id="new_spesifikasi">Baru</span>
        <span class="tittle_karyawan">Spesifikasi Kerja</span>
        <div class="wadah_search"><input type="text" id="search_input" class="search_bar"
                placeholder="Cari Nama Spesifikasi..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_spec">
        <?php
        include("config.php");
        $keyword = "";

        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT spesifikasi_kerja.*, profil_karyawan.nama_karyawan, departemen.nama_departemen, divisi.nama_divisi,
        departemen.id_departemen
        FROM spesifikasi_kerja
        JOIN profil_karyawan ON spesifikasi_kerja.id_supervisor = profil_karyawan.id_karyawan
        JOIN divisi ON spesifikasi_kerja.id_divisi = divisi.id_divisi
        JOIN departemen ON divisi.id_departemen = departemen.id_departemen
        WHERE spesifikasi_kerja.nama_spesifikasi LIKE '%$keyword%'";
        } else {
            $sql = "SELECT spesifikasi_kerja.*, profil_karyawan.nama_karyawan, departemen.nama_departemen, divisi.nama_divisi,
        departemen.id_departemen
        FROM spesifikasi_kerja
        JOIN profil_karyawan ON spesifikasi_kerja.id_supervisor = profil_karyawan.id_karyawan
        JOIN divisi ON spesifikasi_kerja.id_divisi = divisi.id_divisi
        JOIN departemen ON divisi.id_departemen = departemen.id_departemen";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_spec'>
            <span class='data_tittle_karyawan'>" . $row["nama_spesifikasi"] . "</span><br>
            <hr>
            <span class='body_spec'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_spec'>
                        <path fill-rule='evenodd' d='M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 
                            1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 
                            0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z' clip-rule='evenodd'/>
                    </svg>
                </span>" . $row["nama_karyawan"] . "</span><br>
            <span class='body_spec'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_spec'>
                        <path fill-rule='evenodd' d='M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75
                            0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75
                            0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 
                            1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 
                            0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 
                            1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 
                            1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 
                            1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z' clip-rule='evenodd' />
                    </svg>
                </span>" . $row["nama_divisi"] . "</span><br>
            <span class='keterangan_spec'>" . $row["nama_departemen"] . "</span><br>
            <hr>
            <div class='ubah_karyawan' id=''>Ubah</div>
            <div class='hapus_karyawan' id=''>Hapus</div>
            <input type='hidden' class='id_spesifikasi_kerja' value='" . $row["id_spesifikasi_kerja"] . "'>
            <input type='hidden' class='id_divisi' value='" . $row["id_divisi"] . "'>
            <input type='hidden' class='nama_spesifikasi' value='" . $row["nama_spesifikasi"] . "'>
            <input type='hidden' class='id_supervisor' value='" . $row["id_supervisor"] . "'>
            <input type='hidden' class='id_departemen' value='" . $row["id_departemen"] . "'>
        </div>");
            }
        } else {
            echo ("0 results");
        }
        ?>
    </div>
</body>

</html>