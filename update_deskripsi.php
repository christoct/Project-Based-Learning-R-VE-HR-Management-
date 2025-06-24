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
    <title>Update Pekerjaan</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="session.js"></script>
<script src="update_delete_deskripsi.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="input_style.css">
<link rel="stylesheet" href="popup_style.css">

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
    <?php
    include("config.php");
    $id_pekerjaan = $_POST["id_pekerjaan"];
    $sql = "SELECT pekerjaan.* , departemen.id_departemen,
    divisi.id_divisi, spesifikasi_kerja.id_spesifikasi_kerja,
    profil_karyawan.nama_karyawan
    FROM pekerjaan
    JOIN profil_karyawan ON profil_karyawan.id_karyawan = pekerjaan.id_penanggung_jawab 
    JOIN spesifikasi_kerja ON pekerjaan.id_spesifikasi_kerja = spesifikasi_kerja.id_spesifikasi_kerja
    JOIN divisi ON spesifikasi_kerja.id_divisi = divisi.id_divisi
    JOIN departemen ON divisi.id_departemen  = departemen.id_departemen
    WHERE pekerjaan.id_pekerjaan = '$id_pekerjaan'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ("<input type='hidden' id='id_pekerjaan_ambil' value='" . $row["id_pekerjaan"] . "'>");
            echo ("<input type='hidden' id='nama_pekerjaan_ambil' value='" . $row["nama_pekerjaan"] . "'>");
            echo ("<input type='hidden' id='id_departemen_ambil' value='" . $row["id_departemen"] . "'>");
            echo ("<input type='hidden' id='id_divisi_ambil' value='" . $row["id_divisi"] . "'>");
            echo ("<input type='hidden' id='spesifikasi_kerja_ambil' value='" . $row["id_spesifikasi_kerja"] . "'>");
            echo ("<input type='hidden' id='id_penanggung_jawab_ambil' value='" . $row["id_penanggung_jawab"] . "'>");
            echo ("<input type='hidden' id='deskripsi_pekerjaan_ambil' value='" . $row["deskripsi_pekerjaan"] . "'>");
            echo ("<input type='hidden' id='nama_karyawan_ambil' value='" . $row["nama_karyawan"] . "'>");
        }
    } else {
        echo "Gagal akses data profil";
    }

    ?>

    <div class="overlay"></div>
    <div class="popup" id="input_skill">
        <span class="x">&times;</span>
        <span class="popup_tittle">Tambah Kemampuan</span>
        <hr class="line">
        <table class="data">
            <tr>
                <td class="popup_text">Bidang Kemampuan</td>
                <td class="popup_data">
                    <select name="bidang kemampuan" id="bidang_kemampuan_popup" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">co. Teknologi Informasi</option>
                        <?php
                        include("config.php");
                        $sql = "SELECT * FROM bidang_kemampuan";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_bidang_kemampuan'] . "'>" . $row['nama_bidang_kemampuan'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="popup_text">Jenis Kemampuan</td>
                <td class="popup_data">
                    <select name="departemen" id="jenis_kemampuan_popup" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">co. Database Input</option>
                        <?php
                        include("config.php");
                        $sql = "SELECT * FROM kemampuan";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_kemampuan'] . "'data-id-bidang='" . $row['id_bidang_kemampuan'] . "'>" . $row['jenis_kemampuan'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="popup_text">Tingkat Kemampuan</td>
                <td class="popup_data">
                    <select name="posisi" id="tingkat_kemampuan_popup" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">
                            Tingkat 1 - 5</option>
                        <option value="Pemula">Pemula</option>
                        <option value="Rata-Rata">Rata-rata</option>
                        <option value="Handal">Handal</option>
                        <option value="Sangat Handal">Sangat Handal</option>
                        <option value="Mahir">Mahir</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <hr class="line">
        <span class="close">Tutup</span>
        <span class="save" id="simpan_skill">Simpan</span>
    </div>

    <div class="popup" id="edit_skill">
        <span class="x">&times;</span>
        <span class="popup_tittle">Ubah Kemampuan</span>
        <hr class="line">
        <table class="data">
            <tr>
                <td class="popup_text">Bidang Kemampuan</td>
                <td class="popup_data">
                    <select name="bidang kemampuan" id="bidang_kemampuan_update" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">co. Teknologi Informasi</option>
                        <?php
                        include("config.php");
                        $sql = "SELECT * FROM bidang_kemampuan";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_bidang_kemampuan'] . "'>" . $row['nama_bidang_kemampuan'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="popup_text">Jenis Kemampuan</td>
                <td class="popup_data">
                    <select name="departemen" id="jenis_kemampuan_update" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">co. Database Input</option>
                        <?php
                        include("config.php");
                        $sql = "SELECT * FROM kemampuan";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_kemampuan'] . "'data-id-bidang='" . $row['id_bidang_kemampuan'] . "'>" . $row['jenis_kemampuan'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="popup_text">Tingkat Kemampuan</td>
                <td class="popup_data">
                    <select name="posisi" id="tingkat_kemampuan_update" class="popup_select">
                        <option value="" disabled selected hidden class="placeholder">
                            Tingkat 1 - 5</option>
                        <option value="Pemula">Pemula</option>
                        <option value="Rata-Rata">Rata-rata</option>
                        <option value="Handal">Handal</option>
                        <option value="Sangat Handal">Sangat Handal</option>
                        <option value="Mahir">Mahir</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <hr class="line">
        <span class="close" id="hapus_kemampuan">Hapus</span>
        <span class="save" id="simpan_skill_update">Simpan</span>
    </div>

    <form action="proses_hapus_pekerjaan.php" method="post" id="form_hapus_pekerjaan">
        <input type="hidden" name="id_pekerjaan_hapus" id="id_pekerjaan_hapus">
        <div class="popup" id="hapus_pekerjaan_popup">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Pekerjaan</span>
            <hr class="line">
            <span class="popup_text" id="nama_pekerjaan_hapus">Apakah Anda yakin mau menghapus pekerjaan ini?</span>
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

    <div class="bar">
        <button type="submit" form="form_update_pekerjaan" class="save_karyawan">Simpan</button>
        <span class="cancel_karyawan" id="cancel_deskripsi"> Batal</span>
        <span class="tittle_input">Update Pekerjaan</span>
        <span class="hapus_pekerjaan" id="hapus_pekerjaan">Hapus</span>
    </div>

    <div class="container">
        <form action="proses_update_pekerjaan.php" method="POST" id="form_update_pekerjaan">
            <input type="hidden" name="id_pekerjaan_update" id="id_pekerjaan_update">
            <input type="text" class="main_input" name="nama_pekerjaan_update" id="nama_pekerjaan_update"
                placeholder="Nama Pekerjaan Baru">

            <table class="add_table" id="table_add">
                <tr>
                    <td class="text_input" id="keterangan_departemen">Departemen</td>
                    <td>
                        <select name="id_departemen_update" id="id_departemen_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">co. Operaational</option>
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
                    <td class="text_input" id="keterangan_divisi">Divisi Kerja</td>
                    <td>
                        <select id="id_divisi_update" name="id_divisi_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">co. Waitress</option>
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
                    <td class="text_input" id="keterangan_spec">Spesifikasi Kerja</td>
                    <td>
                        <select name="id_spesifikasi_update" id="id_spesifikasi_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">co. Organic Marketing</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT spesifikasi_kerja.*, profil_karyawan.nama_karyawan 
                                FROM spesifikasi_kerja 
                                LEFT JOIN profil_karyawan 
                                ON spesifikasi_kerja.id_supervisor = profil_karyawan.id_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_spesifikasi_kerja'] . "' 
                                data-id-divisi='" . $row['id_divisi'] . "' 
                                data-nama-penanggung='" . htmlspecialchars($row['nama_karyawan'], ENT_QUOTES) .
                                    "'data-id-penanggung='" . $row['id_supervisor'] . "'>
                                " . $row['nama_spesifikasi'] . "
                                </option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td class="text_input" id="keterangan_PN">Penanggung jawab</td>
                    <td>
                        <input type="text" id="nama_pj_update" class="add_input" placeholder="Otomatis Terisi" readonly>
                        <input type="hidden" name="id_pj_update" id="id_pj_update">
                    </td>
                </tr>
            </table>
            <span class="text_input" id="keterangan_desc">Deskripsi Pekerjaan</span><br>
            <textarea name="deskripsi_update" id="deskripsi_update" cols="120" rows="10" class="desc"
                placeholder="Deskripsikan secara detail mengenai pekerjaan ini !"></textarea>

            <hr class="line"><br>
            <span class="keterangan">Kemampuan Diperlukan</span><br><br>
            <span class="add_skill" id="tambah_skill">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tambah_skill">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0
                        1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1
                        0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                </svg>
                Tambah Kemampuan
            </span>
            <div class="skill_container">
                <table class="table_skill" cellspacing="0">
                    <tr class="head_skill">
                        <td class="attr_skill">Bidang Kemampuan</td>
                        <td class="attr_skill">Jenis Kemampuan</td>
                        <td class="attr_skill">Tingkat Kemampuan</td>
                    </tr>
                    <?php
                    include("config.php");
                    $id_pekerjaan = $_POST["id_pekerjaan"];
                    $sql_kemampuan = "SELECT bidang_kemampuan.nama_bidang_kemampuan, 
                    kemampuan.jenis_kemampuan, kemampuan_kerja.tingkat_kemampuan
                    FROM kemampuan_kerja
                    JOIN kemampuan  ON kemampuan_kerja.id_jenis_kemampuan  = kemampuan.id_kemampuan
                    JOIN bidang_kemampuan  ON kemampuan.id_bidang_kemampuan = bidang_kemampuan.id_bidang_kemampuan
                    WHERE kemampuan_kerja.id_pekerjaan = '$id_pekerjaan'";

                    $result_kemampuan = $conn->query($sql_kemampuan);
                    $daftar_kemampuan = [];

                    if ($result_kemampuan->num_rows > 0) {
                        while ($row = $result_kemampuan->fetch_assoc()) {
                            echo ("<tr class='body_skill'>
                            <td class='data_skill'>" . $row["nama_bidang_kemampuan"] . "</td>" .
                                "<td class='data_skill'>" . $row["jenis_kemampuan"] . "</td>" .
                                "<td class='data_skill'> " . $row["tingkat_kemampuan"] . "</td>" .
                                "</tr>");
                        }
                    }
                    ?>
                </table>

            </div>
            <input type="hidden" name="daftar_kemampuan" id="daftar_kemampuan">
        </form>
    </div>
</body>

</html>