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
    <title>Penilaian Karyawan</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="penilaian.js"></script>
<script src="session.js"></script>
<script src="search_karyawan.js"></script>
<script src="update_delete_penilaian.js"></script>
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
    <form action="proses_input_penilaian.php" method="POST" id="form_input_penilaian">
        <div class="popup" id="input_penilaian">
            <span class="x">&times;</span>
            <span class="popup_tittle">Tambah Penilaian Karyawan</span>
            <hr class="line">
            <table class="data">
                <tr>
                    <td class="popup_text">Nama Karyawan</td>
                    <td class="popup_data">
                        <select name="id_karyawan" id="pilih_karyawan" class="popup_select">
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
                    <td class="popup_text">Nama Penilai</td>
                    <td class="popup_data">
                        <select name="id_penilai" id="pilih_penilai" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Sella</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option
                                value='" . $row['id_karyawan'] . "'
                                data-nama-penilai='" . $row['nama_karyawan']
                                    . "'>"
                                    . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="nama_penilai" id="nama_penilai">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Penilaian</td>
                    <td class="popup_data">
                        <input type="date" name="tanggal_penilaian" class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nilai Akhir</td>
                    <td class="popup_data">
                        <select name="nilai_akhir" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Skor Penilaian</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM nilai_akhir";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_nilai_akhir'] . "'>"
                                    . $row['nama_nilai_akhir'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Status Penilaian</td>
                    <td class="popup_data">
                        <select name="status_penilaian" id="" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Selesai</option>
                            <option value="Belum Dilaksanakan">Belum Dilaksanakan</option>
                            <option value="Sedang Dilaksanakan">Sedang Dilaksanakan</option>
                            <option value="Berhasil Dilaksanakan">Berhasil Dilaksanakan</option>
                            <option value="Sedang Dikonfirmasi">Sedang Dikonfirmasi</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_penilaian">Simpan</span>
        </div>
    </form>

    <form action="proses_update_penilaian.php" method="POST" id="form_update_penilaian">
        <div class="popup" id="update_penilaian">
            <span class="x">&times;</span>
            <span class="popup_tittle">Ubah Penilaian Karyawan</span>
            <hr class="line">
            <input type="hidden" name="id_penilaian_update" id="id_penilaian_update">
            <table class="data">
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
                    <td class="popup_text">Nama Penilai</td>
                    <td class="popup_data">
                        <select name="id_penilai_update" id="id_penilai_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Sella</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option
                                value='" . $row['id_karyawan'] . "'
                                data-nama-penilai='" . $row['nama_karyawan']
                                    . "'>"
                                    . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="nama_penilai" id="nama_penilai">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Tanggal Penilaian</td>
                    <td class="popup_data">
                        <input type="date" id="tanggal_penilaian_update" name="tanggal_penilaian_update"
                            class="popup_date">
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Nilai Akhir</td>
                    <td class="popup_data">
                        <select name="id_akhir_update" id="id_akhir_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">Skor Penilaian</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM nilai_akhir";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option 
                                value='" . $row['id_nilai_akhir'] . "'>"
                                    . $row['nama_nilai_akhir'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup_text">Status Penilaian</td>
                    <td class="popup_data">
                        <select name="status_penilaian_update" id="status_penilaian_update" class="popup_select">
                            <option value="" disabled selected hidden class="placeholder">co. Selesai</option>
                            <option value="Belum Dilaksanakan">Belum Dilaksanakan</option>
                            <option value="Sedang Dilaksanakan">Sedang Dilaksanakan</option>
                            <option value="Berhasil Dilaksanakan">Berhasil Dilaksanakan</option>
                            <option value="Sedang Dikonfirmasi">Sedang Dikonfirmasi</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <hr class="line">
            <span class="close">Tutup</span>
            <span class="save" id="simpan_update_penilaian">Simpan</span>
        </div>
    </form>

    <form action="proses_hapus_penilaian.php" method="post" id="form_hapus_penilaian">
        <div class="popup" id="hapus_penilaian_popup">
            <input type="hidden" name="id_penilaian_hapus" id="id_penilaian_hapus">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Penilaian Karyawan</span>
            <hr class="line">
            <span class="popup_text" id="nama_penilaian_hapus">Apakah Anda yakin mau menghapus penilaian karyawan
                ini?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_penilaian">Ya</span>
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

    <div class="bar"> <span class="new_penilaian" id="new_penilaian">Baru</span>
        <span class="tittle_penilaian">Penilaian Karyawan</span>
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

    <div class="wadah_penilaian">
        <?php
        include("config.php");

        $keyword = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $keyword = trim($_GET['search']);
            $sql = "SELECT penilaian_karyawan.*, profil_karyawan.nama_karyawan,
        nilai_akhir.nama_nilai_akhir
        FROM penilaian_karyawan
        JOIN profil_karyawan ON penilaian_karyawan.id_karyawan = profil_karyawan.id_karyawan
        JOIN nilai_akhir ON penilaian_karyawan.id_akhir = nilai_akhir.id_nilai_akhir
        WHERE profil_karyawan.nama_karyawan LIKE '%$keyword%'";
        } else {
            $sql = "SELECT penilaian_karyawan.*, profil_karyawan.nama_karyawan,
        nilai_akhir.nama_nilai_akhir
        FROM penilaian_karyawan
        JOIN profil_karyawan ON penilaian_karyawan.id_karyawan = profil_karyawan.id_karyawan
        JOIN nilai_akhir ON penilaian_karyawan.id_akhir = nilai_akhir.id_nilai_akhir";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("<div class='data_penilaian'>
            <span class='data_tittle_penilaian'>" . $row["nama_karyawan"] . "</span><br>
            <hr>
            <span class='body_penilaian'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_penilaian'>
                        <path fill-rule='evenodd' d='M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                            5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 
                            1.136-.964 2.033-1.96 1.425L12 18.354 7.373 
                            21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 
                            2.082-5.005Z' clip-rule='evenodd' />
                    </svg>
                </span>" . $row["nama_nilai_akhir"] . "</span><br>
            <span class='body_penilaian'>
                <span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                        class='icon_keterangan_penilaian'>
                        <path fill-rule='evenodd' d='M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 
                            3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 
                            3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 
                            1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z'
                            clip-rule='evenodd' />
                    </svg>
                </span>" . date("d/m/Y", strtotime($row["tanggal_penilaian"]))
                    . "</span><br>
            <span class='keterangan_penilaian'>" . $row["status_penilaian"] . "</span><br>
            <hr>
            <div class='ubah_penilaian' id=''>Ubah</div>
            <div class='hapus_penilaian' id=''>Hapus</div>
            <input type='hidden' class='id_penilaian' value='" . $row["id_penilaian"] . "'>
            <input type='hidden' class='nama_karyawan' value='" . $row["nama_karyawan"] . "'>
            <input type='hidden' class='id_karyawan' value='" . $row["id_karyawan"] . "'>
            <input type='hidden' class='id_penilai' value='" . $row["id_penilai"] . "'>
            <input type='hidden' class='tanggal_penilaian' value='" . $row["tanggal_penilaian"] . "'>
            <input type='hidden' class='id_akhir' value='" . $row["id_akhir"] . "'>
            <input type='hidden' class='status_penilaian' value='" . $row["status_penilaian"] . "'>
        </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</body>

</html>