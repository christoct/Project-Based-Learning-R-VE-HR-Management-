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
    <title>Slip Gaji</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="penggajian.js"></script>
<script src="update_delete_slip.js"></script>
<script src="hapus_slip.js"></script>
<script src="session.js"></script>
<script src="search_karyawan.js"></script>
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

    <form action="proses_hapus_slip.php" method="post" id="form_hapus_slip">
        <div class="popup" id="hapus_slip_popup">
            <input type="hidden" name="id_slip_gaji_hapus" id="id_slip_gaji_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Slip Gaji</span>
            <hr class="line">
            <span class="popup_text" id="nama_slip_hapus">Apakah Anda yakin mau menghapus slip gaji ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_slip">Ya</span>
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

    <div class="bar"> <span class="new_penggajian" id="new_slip">Baru</span>
        <span class="tittle_penggajian">Slip Gaji</span>
        <div class="wadah_search"><input type="text" class="search_bar" id="search_input"
                placeholder="Cari Nama Karyawan..">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196
5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="wadah_slip">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT slip_gaji.*, profil_karyawan.nama_karyawan
        FROM slip_gaji
        JOIN profil_karyawan ON slip_gaji.id_karyawan = profil_karyawan.id_karyawan
                WHERE profil_karyawan.nama_karyawan LIKE '%$keyword%'";
        } else {
            $sql = "SELECT slip_gaji.*, profil_karyawan.nama_karyawan
        FROM slip_gaji
        JOIN profil_karyawan ON slip_gaji.id_karyawan = profil_karyawan.id_karyawan";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_slip'>
            <span class='data_tittle_penggajian'>" . $row["id_slip_gaji"] . "</span><br>
            <hr>
            <span class='body_slip'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_slip'>
                        <path fill-rule='evenodd' d='M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 
                            1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 
                            0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z' clip-rule='evenodd' />
                    </svg>
                </span>" . $row["nama_karyawan"] . "</span><br>
            <span class='body_slip'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5'
                        stroke='currentColor' class='icon_keterangan_slip'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M2.25 18.75a60.07 
                            60.07 0 0 1 15.797 2.101c.727.198 
                            1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 
                            6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 
                            6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 
                            0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 
                            1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 
                            0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 
                            0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 
                            0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z' />
                    </svg>
                </span>Rp " . number_format($row["jumlah_gaji"], 0, ',', '.') . ",-" . "</span><br>
            <span class='body_slip'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' 
                    class='icon_keterangan_slip'>
                        <path fill-rule='evenodd'
                            d='M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 
                            3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 
                            3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 
                            1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z'
                            clip-rule='evenodd' />
                    </svg>
                </span>" . date("d/m/Y", strtotime($row["tanggal_cetak"]))
                    . "</span><br>
                <span class='keterangan_slip'>" . $row["status_pembayaran"] . "</span><br>
            <hr>
            <div class='ubah_penggajian' id=''>Ubah</div>
            <div class='hapus_penggajian' id=''>Hapus</div>
            <form action='update_slip.php' class='update_slip' method='POST'>
            <input type='hidden' class='id_slip_gaji' name='id_slip_gaji' value='" . $row["id_slip_gaji"] . "'>
            </form>
        </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</body>

</html>