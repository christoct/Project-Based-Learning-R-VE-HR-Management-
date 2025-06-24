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
    <title>Pencapaian Karyawan</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="penilaian.js"></script>
<script src="update_delete_pencapaian.js"></script>
<script src="search_karyawan.js"></script>
<script src="session.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="penilaian.css">

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
    <form action="proses_input_pencapaian.php" id="form_input_pencapaian" method="POST">
        <div class="popup" id="input_pencapaian">
            <span class="x">&times;</span>
            <span class="popup_tittle">Tambah Pencapaian Karyawan</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Pencapaian </td>
                    <td class="popup_data">
                        <input type="text" name="nama_pencapaian" placeholder="co. Mengikuti Training Leadership"
                            class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Karyawan</td>
                    <td class="popup_data">
                        <select name="id_karyawan" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Agung</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_karyawan'] . "'
                                data-nama-karyawan='" . $row['nama_karyawan']
                                    . "'>"
                                    . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                            <input type="hidden" name="nama_karyawan" id="nama_karyawan">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Mulai</td>
                    <td class="popup_data">
                        <input type="date" name="tanggal_mulai" class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Selesai</td>
                    <td class="popup_data">
                        <input type="date" name="tanggal_selesai" class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Status Pencapaian</td>
                    <td class="popup_data">
                        <select name="status_pencapaian" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Progress (0-100%)</option>
                            <option value="Belum Dilaksanakan (0%)">Belum Dilaksanakan (0%)</option>
                            <option value="Sedang Dilaksanakan (25%)">Sedang Dilaksanakan (25%)</option>
                            <option value="Separuh Jalan (50%)">Separuh Jalan (50%)</option>
                            <option value="Hampir Selesai (75%)">Hampir Selesai (75%)</option>
                            <option value="Selesai (100%)">Selesai (100%)</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_pencapaian">Simpan</span>
        </div>
    </form>

    <form action="proses_update_pencapaian.php" id="form_update_pencapaian" method="POST">
        <div class="popup" id="update_pencapaian">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Pencapaian Karyawan</span>
            <hr class="line">
            <input type="hidden" name="id_pencapaian_update" id="id_pencapaian_update">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Pencapaian </td>
                    <td class="popup_data">
                        <input type="text" name="nama_pencapaian_update" id="nama_pencapaian_update"
                            placeholder="co. Mengikuti Training Leadership" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nama Karyawan</td>
                    <td class="popup_data">
                        <select name="id_karyawan_update" id="id_karyawan_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Agung</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_karyawan'] . "'
                                data-nama-karyawan='" . $row['nama_karyawan']
                                    . "'>"
                                    . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                            <input type="hidden" name="nama_karyawan" id="nama_karyawan">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Mulai</td>
                    <td class="popup_data">
                        <input type="date" name="tanggal_mulai_update" id="tanggal_mulai_update" class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Selesai</td>
                    <td class="popup_data">
                        <input type="date" name="tanggal_selesai_update" id="tanggal_selesai_update" class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Status Pencapaian</td>
                    <td class="popup_data">
                        <select name="status_pencapaian_update" id="status_pencapaian_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Progress (0-100%)</option>
                            <option value="Belum Dilaksanakan (0%)">Belum Dilaksanakan (0%)</option>
                            <option value="Sedang Dilaksanakan (25%)">Sedang Dilaksanakan (25%)</option>
                            <option value="Separuh Jalan (50%)">Separuh Jalan (50%)</option>
                            <option value="Hampir Selesai (75%)">Hampir Selesai (75%)</option>
                            <option value="Selesai (100%)">Selesai (100%)</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_update_pencapaian">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_pencapaian.php" id="form_hapus_pencapaian" method="post">
        <div class="popup" id="hapus_pencapaian_popup">
            <input type="hidden" name="id_pencapaian_hapus" id="id_pencapaian_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Pencapaian Karyawan</span>
            <hr class="line">
            <span class="popup_text" id="nama_pencapaian_hapus">Apakah Anda yakin mau menghapus pencapaian karyawan
                ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_pencapaian">Ya</span>
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

            <img src="appraisals.png" alt="Gambar Modul" class="gambar_modul">Penilaian
        </div>
        <ul class="daftar_menu">
            <li class="menu" id="penilaian_karyawan">Penilaian Karyawan</li>
            <li class="menu" id="nilai_akhir">Nilai Akhir</li>
            <li class="menu" id="pencapaian_karyawan">Pencapaian Karyawan</li>
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

    <div class="bar"> <span class="new_penilaian" id="new_pencapaian">Baru</span>
        <span class="tittle_penilaian">Pencapaian Karyawan</span>
        <div class="wadah_search"><input type="text" class="search_bar" id="search_input"
                placeholder="Cari Nama Pencapaian..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_pencapaian">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT pencapaian_karyawan.*, profil_karyawan.nama_karyawan
        FROM pencapaian_karyawan
        JOIN profil_karyawan ON pencapaian_karyawan.id_karyawan = profil_karyawan.id_karyawan
        WHERE nama_pencapaian LIKE '%$keyword%'";
        } else {
            $sql = "SELECT pencapaian_karyawan.*, profil_karyawan.nama_karyawan
        FROM pencapaian_karyawan
        JOIN profil_karyawan ON pencapaian_karyawan.id_karyawan = profil_karyawan.id_karyawan";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_pencapaian'>
            <span class='data_tittle_penilaian'>" . $row["nama_pencapaian"] . "</span><br>
            <hr>
            <span class='body_pencapaian'>
                " . $row["nama_karyawan"] . "</span><br>
            <span class='keterangan_pencapaian'>" . $row["status_pencapaian"] . "</span><br>
            <hr>
            <div class='ubah_penilaian' id=''>Ubah</div>
            <div class='hapus_penilaian' id=''>Hapus</div>
            <input type='hidden' class='id_pencapaian' value='" . $row["id_pencapaian"] . "'>
            <input type='hidden' class='nama_pencapaian' value='" . $row["nama_pencapaian"] . "'>
            <input type='hidden' class='id_karyawan' value='" . $row["id_karyawan"] . "'>
            <input type='hidden' class='tanggal_mulai' value='" . $row["tanggal_mulai"] . "'>
            <input type='hidden' class='tanggal_selesai' value='" . $row["tanggal_selesai"] . "'>
            <input type='hidden' class='status_pencapaian' value='" . $row["status_pencapaian"] . "'>
        </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</body>

</html>