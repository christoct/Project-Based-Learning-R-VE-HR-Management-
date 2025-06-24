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
    <title>Kemampuan Kerja</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="karyawan.js"></script>
<script src="session.js"></script>
<script src="search_karyawan.js"></script>
<script src="update_delete_kemampuan.js"></script>
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
    <form action="proses_input_bidang.php" id="form_input_bidang" method="POST">
        <div class="overlay"></div>
        <div class="popup" id="popup_bidang">
            <span class="x_bidang" id="close_bidang">&times;</span>
            <span class="popup_tittle">Tambah Bidang Kemampuan</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Bidang Kemampuan </td>
                    <td class="popup_data">
                        <input type="text" name="nama_bidang" placeholder="co. Kemampuan SDM" class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close_bidang" id="tutup_bidang">Tutup</span>
            <span class="save_bidang" id="simpan_bidang">Simpan</span>
        </div>
    </form>

    <form action="proses_update_bidang.php" id="form_update_bidang" method="POST">
        <div class="popup" id="update_bidang">
            <span class="x_bidang">&times;</span>
            <span class="popup_tittle">Ubah Bidang Kemampuan</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Bidang Kemampuan </td>
                    <td class="popup_data">
                        <input type="hidden" name="id_bidang_kemampuan_update" id="id_bidang_kemampuan_update">
                        <input type="text" id="nama_bidang_kemampuan_update" name="nama_bidang_kemampuan_update"
                            placeholder="co. Kemampuan SDM" class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close_bidang" id="hapus_bidang">Hapus</span>
            <span class="save_bidang" id="simpan_update_bidang">Simpan</span>
        </div>
    </form>

    <div class="popup" id="jenis_skill">
        <form action="proses_input_skill.php" id="form_input_skill" method="POST">
            <span class="x" id="close_jenis">&times;</span>
            <span class="popup_tittle">Tambah Kemampuan Kerja</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td colspan="2">
                        <span class="btn_bidang">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="tambah">
                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0
                        1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1
                        0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                            </svg>
                            Tambah Bidang</span>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Bidang Kemampuan </td>
                    <td class="popup_data">
                        <select name="bidang_dipilih" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Marketing Skill</option>
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
                        <input type="text" name="jenis_skill" placeholder="co. Prduct Branding" class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close" id="tutup_jenis">Tutup</span>
            <span class="save" id="simpan_jenis">Simpan</span>
        </form>
    </div>

    <form action="proses_update_kemampuan.php" id="form_update_kemampuan" method="POST">
        <div class="popup" id="update_skill">
            <span class="x" id="close_jenis">&times;</span>
            <span class="popup_tittle">Ubah Kemampuan Kerja</span>
            <hr class="line">
            <input type="hidden" name="id_Kemampuan_update" id="id_Kemampuan_update">
            <table class="data">
                <tr>
                    <td class="popup_text">Bidang Kemampuan </td>
                    <td class="popup_data">
                        <select name="id_bidang_kemampuan_update_skill" id="id_bidang_kemampuan_update_skill"
                            class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Marketing Skill</option>
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
                        <input type="text" id="jenis_kemampuan_update" name="jenis_kemampuan_update"
                            placeholder="co. Prduct Branding" class="popup_input">
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close" id="hapus_jenis">Hapus</span>
            <span class="save" id="simpan_update_kemampuan">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_kemampuan.php" id="form_hapus_kemampuan" method="post">
        <div class="popup" id="hapus_kemampuan_popup">
            <input type="hidden" name="id_kemampuan_hapus" id="id_kemampuan_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Kemampuan</span>
            <hr class="line">
            <span class="popup_text" id="nama_kemampuan_hapus">Apakah Anda yakin mau menghapus ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_kemampuan">Ya</span>
                <span class="tidak">Tidak</span>
            </div>
        </div>
    </form>

    <form action="proses_hapus_bidang_kemampuan.php" method="post" id="form_hapus_bidang_kemampuan">
        <div class="popup" id="hapus_bidang_popup">
            <input type="hidden" name="id_bidang_kemampuan_hapus" id="id_bidang_kemampuan_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Bidang Kemampuan</span>
            <hr class="line">
            <span class="popup_text" id="nama_bidang_kemampuan_hapus">Apakah Anda yakin mau menghapus bidang kemampuan
                ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_bidang_kemampuan">Ya</span>
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

    <div class="bar"> <span class="new" id="new_kemampuan">Baru</span>
        <span class="tittle_karyawan">Kemampuan Kerja</span>
        <div class="wadah_search"><input type="text" id="search_input" class="search_bar"
                placeholder="Cari Nama Kemampuan..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <?php
    include("config.php");

    $search = isset($_GET['search']) ? trim($_GET['search']) : "";

    $sql_bidang = "SELECT * FROM bidang_kemampuan ORDER BY nama_bidang_kemampuan ASC";
    $result_bidang = $conn->query($sql_bidang);

    $kemampuan_terfilter = [];
    $sql_kemampuan = "SELECT * FROM kemampuan";
    if (!empty($search)) {
        $sql_kemampuan .= " WHERE jenis_kemampuan LIKE '%$search%'";
    }
    $result_kemampuan = $conn->query($sql_kemampuan);

    while ($row = $result_kemampuan->fetch_assoc()) {
        $id_bidang = $row['id_bidang_kemampuan'];
        $kemampuan_terfilter[$id_bidang][] = $row;
    }
    ?>

    <div class="wadah_skill">
        <?php
        if ($result_bidang->num_rows > 0) {
            while ($bidang = $result_bidang->fetch_assoc()) {
                echo "<table class='tabel_skill'>";
                echo "<tr class='heading_skill'><td class='text_heading'>" . htmlspecialchars($bidang['nama_bidang_kemampuan']) . "</td>";
                echo "<input type='hidden' class='id_bidang_kemampuan' value='" . $bidang["id_bidang_kemampuan"] . "'>";
                echo "<input type='hidden' class='nama_bidang_kemampuan' value='" . $bidang["nama_bidang_kemampuan"] . "'>";
                echo("</tr>");
                $id_bidang = $bidang['id_bidang_kemampuan'];
                if (isset($kemampuan_terfilter[$id_bidang])) {
                    foreach ($kemampuan_terfilter[$id_bidang] as $skill) {
                        echo "<tr class='data_skill' 
                        data-id-kemampuan='" . $skill["id_kemampuan"] . "' 
                        data-jenis-kemampuan='" . htmlspecialchars($skill["jenis_kemampuan"], ENT_QUOTES) . "' 
                        data-id-bidang='" . $skill["id_bidang_kemampuan"] . "'>
                        <td class='isi_data_skill'>" . htmlspecialchars($skill["jenis_kemampuan"]) . "</td>
                    </tr>";
                    }
                }
                echo "</table>";
            }
        } else {
            echo "<p>Tidak ada data bidang kemampuan.</p>";
        }
        ?>
    </div>

</body>

</html>