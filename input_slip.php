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
    <title>Slip Gaji Baru</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="penggajian.js"></script>
<script src="session.js"></script>
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

    <div class="bar">
        <span class="save_pelamar" id="generate_slip">Kalkulasi</span>
        <span class="save_pelamar" id="confirm_slip">Konfirmasi</span>
        <span class="cancel_karyawan" id="kembali_confirm"> Kembali</span>
        <span class="save_pelamar" id="simpan_slip">Simpan</span>
        <span class="cancel_karyawan" id="kembali_save"> Kembali</span>
        <span class="tittle_input">Slip Gaji Baru</span>
        <span class="keluar_input" id="keluar_slip">Keluar</span>
    </div>

    <div class="container">
        <form action="proses_input_slip.php" id="form_input_slip" method="POST">
            <?php
            include("config.php");
            $sql = "SELECT id_slip_gaji FROM slip_gaji ORDER BY id_slip_gaji  DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $last_id = $row['id_slip_gaji'];
                $last_number = intval(substr($last_id, strrpos($last_id, '/') + 1));
                $next_number = $last_number + 1;
            } else {
                $next_number = 1;
            }
            $nomor_format = str_pad($next_number, 3, "0", STR_PAD_LEFT);
            $id_slip_gaji = "SLIP/" . $nomor_format;
            echo ("<span class='id'>$id_slip_gaji</span>
            <input type='hidden' name='id_slip' value='$id_slip_gaji'>");
            ?>
            <br>
            <select name="karyawan_slip" id="karyawan_slip" class="main_select">
                <option value="" disabled selected hidden class="placeholder">
                    Nama Karyawan</option>
                <?php
                include("config.php");
                $sql = "SELECT profil_karyawan.*, kontrak_kerja.nama_kontrak,
                struktur_gaji.nama_struktur, struktur_gaji.jumlah_gaji,
                struktur_gaji.interval_gaji, rekening_karyawan.nomor_rekening,
                rekening_karyawan.nama_bank
                FROM profil_karyawan
                JOIN kontrak_kerja ON profil_karyawan.id_karyawan = kontrak_kerja.id_karyawan
                JOIN struktur_gaji ON kontrak_kerja.id_struktur_gaji = struktur_gaji.id_struktur_gaji
                JOIN rekening_karyawan ON profil_karyawan.id_karyawan = rekening_karyawan.id_karyawan";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option class='main_option'
                        value='" . $row['id_karyawan'] .
                        "'data-nama-kontrak='" . $row['nama_kontrak'] .
                        "'data-nama-struktur='" . $row['nama_struktur'] .
                        "'data-jumlah-gaji='" . $row['jumlah_gaji'] .
                        "'data-interval-gaji='" . $row['interval_gaji'] .
                        "'data-nomor-rekening='" . $row['nomor_rekening'] .
                        "'data-nama-bank='" . $row['nama_bank'] .
                        "'>"
                        . $row['nama_karyawan'] . "</option>";
                }
                ?>
            </select>
            <input type="text" id="kontrak_karyawan" class="sub_input" placeholder="Nama Kontrak (Otomatis)" readonly>

            <table class="add_table">
                <tr>
                    <td class="text_input">Struktur Gaji</td>
                    <td>
                        <input id="nama_struktur_gaji" type="text" class="add_input" placeholder="Otomatis Terisi"
                            readonly>
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Nominal Gaji</td>
                    <td>
                        <input id="nominal_gaji" type="text" class="add_input" placeholder="Otomatis Terisi" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Bayar Gaji Untuk</td>
                    <td>
                        <input id="satuan_interval" type="number" min="1" step="1" class="satuan_number"
                            placeholder="Satuan">
                        <span class="text_input" id="interval_gaji"></span>
                    </td>
                </tr>
            </table>
            <span class="kalkulasi_pembayaran">
                <hr class="line"><br>
                <span class="keterangan">Kalkulasi dan Pembayaran</span>
                <table class="add_table">
                    <tr>
                        <td class="text_input">Jumlah Gaji</td>
                        <td>
                            <input type="text" id="total_gaji" class="add_input" placeholder="Otomatis Terisi" readonly>
                        </td>
                        <td><input type="hidden" name="total_gaji" id="total_gaji_raw"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text_input">Metode Bayar</td>
                        <td>
                            <select name="metode_bayar" id="metode_bayar" class="add_select">
                                <option value="" disabled selected hidden class="placeholder">
                                    Tunai / Transfer</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td id="text_rekening" class="text_input_extend">Rekening Karyawan</td>
                        <td>
                            <input id="input_rekening" type="text" class="add_input" placeholder="Otomatis Terisi"
                                readonly>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </span>

            <span class="keterangan_slip">
                <hr class="line"><br>
                <span class="keterangan">Keterangan Slip Gaji</span><br>
                <table class="add_table">
                    <tr>
                        <td class="text_input_extend">Status Pembayaran</td>
                        <td>
                            <select name="status_pembayaran" id="status_pembayaran" class="add_select">
                                <option value="" disabled selected hidden class="placeholder">
                                    Status Pembayaran</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text_input">Tanggal Cetak</td>
                        <td>
                            <input id="tanggal_cetak" type="text" class="add_input" placeholder="Otomatis Terisi"
                                readonly>
                        </td>
                        <td><input type="hidden" name="tanggal_sql" id="tanggal_sql"></td>
                        <td></td>
                    </tr>
                </table>
            </span>
    </div>
    </form>
    </div>
</body>

</html>