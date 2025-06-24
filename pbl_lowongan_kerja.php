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
    <title>Lowongan Kerja</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="rekrutmen.js"></script>
<script src="session.js"></script>
<script src="update_delete_lowongan.js"></script>
<script src="search_karyawan.js"></script>
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
    <div class="popup" id="tambah_lowongan">
        <span class="x">&times;</span>
        <span class="popup_tittle">Tambah Lowongan</span>
        <hr class="line">

        <form action="proses_input_lowongan.php" method="POST" id="form_input_lowongan">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Lowongan </td>
                    <td class="popup_data">
                        <input type="text" name="nama_lowongan" placeholder="co. Lowongan Kepala Sales"
                            class="popup_input">
                    </td>
                </tr>
                <tr id="baris_departemen">
                    <td class="popup_text">Departemen </td>
                    <td class="popup_data">
                        <select name="departemen" id="text_departemen" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Operational</option>
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
                    <td class="popup_text">Divisi </td>
                    <td class="popup_data">
                        <select name="divisi" id="text_divisi" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR Training</option>
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
                <tr id="baris_spec">
                    <td class="popup_text">Spesifikasi Kerja </td>
                    <td class="popup_data">
                        <select name="spec" id="text_spec" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR BaristaTraining
                            </option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM spesifikasi_kerja ";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_spesifikasi_kerja'] . "' 
                                data-id-divisi='" . $row['id_divisi'] . "'>
                                " . $row['nama_spesifikasi'] . "
                                </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Pekerjaan </td>
                    <td class="popup_data">
                        <select name="pekerjaan" id="nama_kerja" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR Design Trainer</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM pekerjaan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_pekerjaan'] . "' 
                                data-id-spec='" . $row['id_spesifikasi_kerja'] . "'>
                                " . $row['nama_pekerjaan'] . "
                                </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td class="popup_text">Tenggat Akhir</td>
                    <td class="popup_data">
                        <input type="date" name="tenggat" placeholder="co. Lowongan Kepala Sales" class="popup_date">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <input type="hidden" name="status_lowongan" id="status_lowongan_input" value="Aktif">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_input_lowongan">Simpan</span>
            <span class="aktif">Aktif</span>
            <span class="non-aktif">Non-Aktif</span>
        </form>
    </div>

    <div class="popup" id="update_lowongan">
        <span class="x">&times;</span>
        <span class="popup_tittle">Ubah Lowongan</span>
        <hr class="line">
        <form action="proses_update_lowongan.php" method="POST" id="form_update_lowongan">
            <input type="hidden" name="update_id_lowongan" id="update_id_lowongan">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Lowongan </td>
                    <td class="popup_data">
                        <input type="text" id="update_nama_lowongan" name="update_nama_lowongan"
                            placeholder="co. Lowongan Kepala Sales" class="popup_input">
                    </td>
                </tr>
                <tr id="baris_departemen">
                    <td class="popup_text">Departemen </td>
                    <td class="popup_data">
                        <select name="update_id_departemen" id="update_id_departemen" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Operational</option>
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
                    <td class="popup_text">Divisi </td>
                    <td class="popup_data">
                        <select name="update_id_divisi" id="update_id_divisi" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR Training</option>
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
                <tr id="baris_spec">
                    <td class="popup_text">Spesifikasi Kerja </td>
                    <td class="popup_data">
                        <select name="update_id_spesifikasi_kerja" id="update_id_spesifikasi_kerja"
                            class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR BaristaTraining
                            </option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM spesifikasi_kerja ";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_spesifikasi_kerja'] . "' 
                                data-id-divisi='" . $row['id_divisi'] . "'>
                                " . $row['nama_spesifikasi'] . "
                                </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Pekerjaan </td>
                    <td class="popup_data">
                        <select name="update_id_pekerjaan" id="update_id_pekerjaan" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. HR Design Trainer</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM pekerjaan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_pekerjaan'] . "' 
                                data-id-spec='" . $row['id_spesifikasi_kerja'] . "'>
                                " . $row['nama_pekerjaan'] . "
                                </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td class="popup_text">Tenggat Akhir</td>
                    <td class="popup_data">
                        <input type="date" id="update_tenggat_akhir" name="update_tenggat_akhir"
                            placeholder="co. Lowongan Kepala Sales" class="popup_date">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <input type="hidden" name="update_status_lowongan" id="update_status_lowongan" value="Aktif">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_update_lowongan">Simpan</span>
            <span class="aktif">Aktif</span>
            <span class="non-aktif">Non-Aktif</span>
        </form>
    </div>

    <div class="popup" id="hapus_lowongan">
        <form action="proses_hapus_lowongan.php" id="form_hapus_lowongan" method="POST">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Lowongan</span>
            <hr class="line">
            <input type="hidden" name="id_lowongan_hapus" id="id_lowongan_hapus" value="">
            <span class="popup_text" id="nama_lowongan_hapus_"></span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_lowongan">Ya</span>
                <span class="tidak">Tidak</span>
            </div>
        </form>
    </div>

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


    <div class="bar"> <span class="new" id="new_lowongan">Baru</span>
        <span class="tittle_menu">Lowongan Kerja</span>
        <div class="wadah_search"><input type="text" id="search_input" class="search_bar"
                placeholder="Cari Nama Lowongan..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_lowongan">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT lowongan.*, pekerjaan.id_pekerjaan, 
        spesifikasi_kerja.id_spesifikasi_kerja, divisi.id_divisi,
        departemen.id_departemen, pekerjaan.nama_pekerjaan
        FROM lowongan
        JOIN pekerjaan ON lowongan.id_pekerjaan = pekerjaan.id_pekerjaan
        JOIN spesifikasi_kerja ON spesifikasi_kerja.id_spesifikasi_kerja = pekerjaan.id_spesifikasi_kerja
        JOIN divisi ON divisi.id_divisi = spesifikasi_kerja.id_divisi
        JOIN departemen ON departemen.id_departemen = divisi.id_departemen
        WHERE lowongan.nama_lowongan LIKE '%$keyword%'";
        } else {
            $sql = "SELECT lowongan.*, pekerjaan.id_pekerjaan, 
        spesifikasi_kerja.id_spesifikasi_kerja, divisi.id_divisi,
        departemen.id_departemen, pekerjaan.nama_pekerjaan
        FROM lowongan
        JOIN pekerjaan ON lowongan.id_pekerjaan = pekerjaan.id_pekerjaan
        JOIN spesifikasi_kerja ON spesifikasi_kerja.id_spesifikasi_kerja = pekerjaan.id_spesifikasi_kerja
        JOIN divisi ON divisi.id_divisi = spesifikasi_kerja.id_divisi
        JOIN departemen ON departemen.id_departemen = divisi.id_departemen";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_lowongan'>
                <span class='tittle_lowongan'>" . $row["nama_lowongan"] . "</span><br>
                <hr>
                <span class='body_lowongan'>" . $row["nama_pekerjaan"] . " </span>
                <span class='lowongan_stat " .
                    ($row["status_lowongan"] == "Aktif" ? "status_aktif" : "status_nonaktif") .
                    "'>" . $row["status_lowongan"] . "</span>
                <span class='tanggal_lowongan'>" . date("d/m/Y", strtotime($row["tenggat_akhir"]))
                    . "</span>
                <hr>
                    <div
                    class='ubah_rekrutmen'>Ubah</div>
                <div class='hapus_rekrutmen'>Hapus</div>
                <input type='hidden' class='id_lowongan' name='id_lowongan' value='" . $row["id_lowongan"] . "'>
                <input type='hidden' class='nama_lowongan' name='nama_lowongan' value='" . $row["nama_lowongan"] . "'>
                <input type='hidden' class='id_pekerjaan' name='id_pekerjaan' value='" . $row["id_pekerjaan"] . "'>
                <input type='hidden' class='status_lowongan' name='status_lowongan' value='" . $row["status_lowongan"] . "'>
                <input type='hidden' class='tenggat_akhir' name='tenggat_akhir' value='" . $row["tenggat_akhir"] . "'>
                <input type='hidden' class='id_spesifikasi_kerja' name='id_spesifikasi_kerja' value='" . $row["id_spesifikasi_kerja"] . "'>
                <input type='hidden' class='id_divisi' name='id_divisi' value='" . $row["id_divisi"] . "'>
                <input type='hidden' class='id_departemen' name='id_departemen' value='" . $row["id_departemen"] . "'>
                </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</body>

</html>