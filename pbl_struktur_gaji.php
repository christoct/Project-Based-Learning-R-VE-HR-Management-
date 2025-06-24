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
    <title>Struktur Gaji</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="penggajian.js"></script>
<script src="search_karyawan.js"></script>
<script src="session.js"></script>
<script src="update_delete_struktur_gaji.js"></script>
<script src="hapus_struktur_gaji.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="penggajian.css">

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
    <form action="proses_input_struktur_gaji.php" method="POST" id="form_input_struktur_gaji">
        <div class="popup" id="input_struktur">
            <span class="x">&times;</span>
            <span class="popup_tittle">Tambah Struktur Gaji</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Struktur</td>
                    <td class="popup_data">
                        <input name="nama_struktur_gaji" type="text" placeholder="co. Struktur Full-Time"
                            class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Jam Kerja</td>
                    <td class="popup_data">
                        <input name="jam_kerja" type="number" class="popup_number" min="10" step="5" max="55"
                            placeholder="co.20">
                        <span class="popup_keterangan">Jam / Minggu</span>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Jumlah Gaji</td>
                    <td class="popup_data">
                        <input name="jumlah_gaji" type="text" placeholder="co. Rp 2.000.000" class="popup_input"
                            id="rupiah">
                        <input type="hidden" name="jumlah_gaji_raw" id="jumlah_gaji_raw">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Interval Gaji</td>
                    <td class="popup_data">
                        <select name="interval_gaji" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Bulan</option>
                            <option value="Bulan">Bulan</option>
                            <option value="Minggu">Minggu</option>
                            <option value="Hari">Hari</option>
                            <option value="Jam">Jam</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_struktur_gaji">Simpan</span>
        </div>
    </form>

    <form action="proses_update_struktur_gaji.php" method="POST" id="form_update_struktur_gaji">
        <input type="hidden" name="id_struktur_gaji_update" id="id_struktur_gaji_update">
        <div class="popup" id="update_struktur">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Struktur Gaji</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Struktur</td>
                    <td class="popup_data">
                        <input name="nama_struktur_update" id="nama_struktur_update" type="text"
                            placeholder="co. Struktur Full-Time" class="popup_input">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Jam Kerja</td>
                    <td class="popup_data">
                        <input name="jam_kerja_update" id="jam_kerja_update" type="number" class="popup_number" min="10"
                            step="5" max="55" placeholder="co.20">
                        <span class="popup_keterangan">Jam / Minggu</span>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Jumlah Gaji</td>
                    <td class="popup_data">
                        <input name="jumlah_gaji_update" type="text" placeholder="co. Rp 2.000.000" class="popup_input"
                            id="jumlah_gaji_update">
                        <input type="hidden" name="jumlah_gaji_raw_update" id="jumlah_gaji_raw_update">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Interval Gaji</td>
                    <td class="popup_data">
                        <select name="interval_gaji_update" id="interval_gaji_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Bulan</option>
                            <option value="Bulan">Bulan</option>
                            <option value="Minggu">Minggu</option>
                            <option value="Hari">Hari</option>
                            <option value="Jam">Jam</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_update_struktur_gaji">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_struktur_gaji.php" id="form_hapus_struktur_gaji" method="post">
        <div class="popup" id="hapus_struktur_gaji">
            <input type="hidden" name="id_struktur_gaji_hapus" id="id_struktur_gaji_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Struktur Gaji</span>
            <hr class="line">
            <span class="popup_text" id="nama_struktur_hapus">Apakah Anda yakin mau menghapus struktur gaji ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_struktur_gaji">Ya</span>
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

            <img src="payroll.png" alt="Gambar Modul" class="gambar_modul">Penggajian
        </div>
        <ul class="daftar_menu">
            <li class="menu" id="struktur_gaji">Struktur Gaji</li>
            <li class="menu" id="rekening_karyawan">Rekening Karyawan</li>
            <li class="menu" id="kontrak_kerja">Kontrak Kerja</li>
            <li class="menu" id="slip_gaji">Slip Gaji</li>
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

    <div class="bar"> <span class="new_penggajian" id="new_struktur">Baru</span>
        <span class="tittle_penggajian">Struktur Gaji</span>
        <div class="wadah_search"><input type="text" class="search_bar" id="search_input"
                placeholder="Cari Nama Struktur Gaji..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_struktur_gaji">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT * FROM struktur_gaji
        WHERE nama_struktur LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM struktur_gaji";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_struktur_gaji'>
            <span class='data_tittle_penggajian'>" . $row["nama_struktur"] . "</span><br>
            <hr>
            <span class='body_struktur'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5'
                        stroke='currentColor' class='icon_keterangan_struktur'>
                        <path stroke-linecap='round' stroke-linejoin='round'
                            d='M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                    </svg>
                </span>" . $row["jam_kerja"] . " jam / minggu</span><br>
            <span class='body_struktur'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5'
                        stroke='currentColor' class='icon_keterangan_struktur'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 
                            1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 
                            6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 
                            6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 
                            0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 
                            1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 
                            0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 
                            0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 
                            0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z' />
                    </svg>
                </span>Rp " . number_format($row["jumlah_gaji"], 0, ',', '.') . ",- / "
                    . $row["interval_gaji"] . "</span><br>
            <hr>
            <div class='ubah_penggajian' id=''>Ubah</div>
            <div class='hapus_penggajian' id=''>Hapus</div>
            <input type='hidden' class='id_struktur_gaji' value='" . $row["id_struktur_gaji"] . "'>
            <input type='hidden' class='nama_struktur' value='" . $row["nama_struktur"] . "'>
            <input type='hidden' class='jam_kerja' value='" . $row["jam_kerja"] . "'>
            <input type='hidden' class='jumlah_gaji' value='" . $row["jumlah_gaji"] . "'>
            <input type='hidden' class='interval_gaji' value='" . $row["interval_gaji"] . "'>
        </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</body>

</html>