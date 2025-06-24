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
    <title>Profil</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="profil.js"></script>
<script src="session.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="input_style.css">
<link rel="stylesheet" href="popup_style.css">
<style>
    select:disabled,
    input:disabled {
        background-color: white;
        color: black;
        opacity: 1;
    }
</style>

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
    $id_karyawan = $_SESSION["id_karyawan"];
        echo ("<input type='hidden' class='username_login' name='username_login' value='" . $_SESSION['username'] . "'>
        <input type='hidden' class='id_login' name='id_login' value='" . $_SESSION['id_karyawan'] . "'>");
    $sql = "SELECT profil_karyawan.* , departemen.id_departemen,
    divisi.id_divisi, spesifikasi_kerja.id_spesifikasi_kerja
    FROM profil_karyawan
    JOIN pekerjaan ON profil_karyawan.id_pekerjaan = pekerjaan.id_pekerjaan
    JOIN spesifikasi_kerja ON pekerjaan.id_spesifikasi_kerja = spesifikasi_kerja.id_spesifikasi_kerja
    JOIN divisi ON spesifikasi_kerja.id_divisi = divisi.id_divisi
    JOIN departemen ON divisi.id_departemen  = departemen.id_departemen
    WHERE id_karyawan = '$id_karyawan'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ("<input type='hidden' id='id_karyawan_ambil' value='" . $row["id_karyawan"] . "'>");
            echo ("<input type='hidden' id='id_departemen_ambil' value='" . $row["id_departemen"] . "'>");
            echo ("<input type='hidden' id='id_divisi_ambil' value='" . $row["id_divisi"] . "'>");
            echo ("<input type='hidden' id='spesifikasi_kerja_ambil' value='" . $row["id_spesifikasi_kerja"] . "'>");
            echo ("<input type='hidden' id='nama_karyawan_ambil' value='" . $row["nama_karyawan"] . "'>");
            echo ("<input type='hidden' id='id_pekerjaan_ambil' value='" . $row["id_pekerjaan"] . "'>");
            echo ("<input type='hidden' id='telepon_kerja_ambil' value='" . $row["telepon_kerja"] . "'>");
            echo ("<input type='hidden' id='email_ambil' value='" . $row["email"] . "'>");
            echo ("<input type='hidden' id='id_atasan_ambil' value='" . $row["id_atasan"] . "'>");
            echo ("<input type='hidden' id='foto_karyawan_ambil' value='" . $row["foto_karyawan"] . "'>");
        }
    } else {
        echo "Gagal akses data profil";
    }
    
    $sql2 = "SELECT *
    FROM data_pribadi
    WHERE id_karyawan = '$id_karyawan'";
    
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            echo ("<input type='hidden' id='nik_diambil' value='" . $row["nik"] . "'>");
            echo ("<input type='hidden' id='umur_diambil' value='" . $row["umur"] . "'>");
            echo ("<input type='hidden' id='email_pribadi_diambil' value='" . $row["email_pribadi"] . "'>");
            echo ("<input type='hidden' id='status_kawin_diambil' value='" . $row["status_kawin"] . "'>");
            echo ("<input type='hidden' id='jenis_kelamin_diambil' value='" . $row["jenis_kelamin"] . "'>");
            echo ("<input type='hidden' id='jumlah_anak_diambil' value='" . $row["jumlah_anak"] . "'>");
            echo ("<input type='hidden' id='alamat_diambil' value='" . $row["alamat"] . "'>");
            echo ("<input type='hidden' id='telepon_pribadi_diambil' value='" . $row["telepon_pribadi"] . "'>");
        }
    } else {
        echo "Gagal akses data pribadi";
    }
    $conn->close();
    ?>
    <div class="overlay"></div>
    <form action="proses_hapus_akun.php" method="post" id="form_hapus_akun">
        <input type="hidden" name="id_karyawan_hapus" id="id_karyawan_hapus">
        <div class="popup" id="hapus_akun_popup">
            <span class="x">&times;</span>
            <span class="popup_tittle">Hapus Akun</span>
            <hr class="line">
            <span class="popup_text" id="nama_karyawan_hapus">Apakah Anda yakin mau menghapus akun?</span>
            <br>
            <div class="popup_buttons">
                <span class="ya" id="confirm_hapus_akun">Ya</span>
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

            <img src="profil_icon.png" alt="Gambar Modul" class="gambar_modul">Profil
        </div>
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

    <div class="bar_profil">
    </div>

    <div class="container">
        <label class="upload_container">
            <input type="hidden" name="id_karyawan_update" id="id_karyawan_update">
            <img src="" alt="profil" id="input_profil" class="gambar_profil">
            <span class="camera" id="camera">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="camera">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507
                        2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865
                        47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232
                        0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
            </span>
            <input disabled name="foto_karyawan_update" id="foto_karyawan_update" type="file" class="foto_karyawan"
                id="file_foto_karyawan" accept="image/*">
        </label>
        <input name="nama_karyawan" id="nama_karyawan_update" type="text" class="main_input"
            placeholder="Nama Karyawan Baru" disabled>
        <select name="id_pekerjaan" id="id_pekerjaan_update" class="sub_select" disabled>
            <option value="" disabled selected hidden class="placeholder" class="sub_option">
                Nama Pekerjaan</option>
            <?php
            include("config.php");
            $sql = "SELECT * FROM pekerjaan";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option class='sub_option' value='" . $row['id_pekerjaan'] . "' data-id-spec ='" . $row['id_spesifikasi_kerja'] . "'>" . $row['nama_pekerjaan'] . "</option>";
            }
            ?>
        </select>

        <table class="add_table">
            <tr>
                <td class="text_input" id="keterangan_departemen">Departemen</td>
                <td>
                    <select name="id_departemen_update" id="id_departemen_update" class="add_select" disabled>
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
                <td class="text_input">Email Kerja</td>
                <td>
                    <input id="email_update" disabled name="email_kantor_karyawan" type="email" class="add_input"
                        placeholder="co. sella-hr-manager@gmail.com">
                </td>
            </tr>
            <tr>
                <td class="text_input" id="keterangan_divisi">Divisi Kerja</td>
                <td>
                    <select id="id_divisi_update" name="id_divisi_update" class="add_select" disabled>
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
                <td class="text_input">Telepon Kerja</td>
                <td>
                    <input id="telepon_kerja_update" disabled name="telepon_kantor_karyawan" type="text"
                        class="add_input" placeholder="co. 087765219005">
                </td>
            </tr>
            <tr>
                <td class="text_input" id="keterangan_spec">Spesifikasi Kerja</td>
                <td>
                    <select name="spesifikasi_kerja_update" id="spesifikasi_kerja_update" class="add_select" disabled>
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
                <td class="text_input" id="keterangan_PN">Atasan</td>
                <td>
                    <input type="text" disabled id="nama_pj_display" class="add_input" placeholder="Otomatis Terisi"
                        readonly>
                </td>
            </tr>
        </table>
        <hr class="line"><br>
        <span class="keterangan">Data Pribadi</span>


        <table class="add_table">
            <tr>
                <td class="text_input">NIK</td>
                <td>
                    <input id="nik_update" disabled name="nik_update" type="text" class="add_input"
                        placeholder="co. 237625448009">
                </td>
                <td class="text_input">Jenis Kelamin</td>
                <td>
                    <select disabled name="jenis_kelamin_update" id="jenis_kelamin_update" class="add_select">
                        <option value="" disabled selected hidden class="placeholder">Pria / Wanita</option>
                        <option value="L">Pria</option>
                        <option value="P">Wanita</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="text_input">Umur</td>
                <td>
                    <input disabled name="umur_update" id="umur_update" type="number" min="18" max="60" step="1"
                        class="add_number" placeholder="18 - 60 tahun">
                </td>
                <td class="text_input">Jumlah Anak</td>
                <td>
                    <input disabled name="jumlah_anak_update" id="jumlah_anak_update" type="number" min="0" step="1"
                        class="add_number" placeholder="Jumlah Anak Kandung">
                </td>
            </tr>
            <tr>
                <td class="text_input">Status Kawin</td>
                <td>
                    <select disabled name="status_kawin_update" id="status_kawin_update" class="add_select">
                        <option value="" disabled selected hidden class="placeholder">Sudah/Belum/Cerai</option>
                        <option value="Sudah Menikah">Sudah Menikah</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Bercerai">Bercerai</option>
                    </select>
                </td>
                <td class="text_input">Alamat</td>
                <td>
                    <input disabled name="alamat_update" id="alamat_update" type="text" class="add_input"
                        placeholder="co. Jl.Anggrek No.17">
                </td>
            </tr>
            <tr>
                <td class="text_input">Email Pribadi</td>
                <td>
                    <input name="email_pribadi_update" id="email_pribadi_update" type="text" class="add_input"
                        placeholder="co. sella.ajaa@gmail.com" disabled>
                </td>
                <td class="text_input">Telepon Pribadi</td>
                <td>
                    <input name="telepon_pribadi_update" id="telepon_pribadi_update" type="text" class="add_input"
                        placeholder="co. +628772654800" disabled>
                </td>
            </tr>
        </table>


        <hr class="line"><br>
        <span class="keterangan">Kemampuan Kerja</span><br><br>
        <div class="skill_container">
            <table class="table_skill" cellspacing="0">
                <tr class="head_skill">
                    <td class="attr_skill">Bidang Kemampuan</td>
                    <td class="attr_skill">Jenis Kemampuan</td>
                    <td class="attr_skill">Tingkat Kemampuan</td>
                </tr>
                <?php
                include("config.php");
                $id_karyawan = $_SESSION["id_karyawan"];
                $sql_kemampuan = "SELECT bidang_kemampuan.nama_bidang_kemampuan, 
                kemampuan.jenis_kemampuan, kemampuan_karyawan.tingkat_kemampuan
                FROM kemampuan_karyawan 
                JOIN kemampuan  ON kemampuan_karyawan.id_jenis_kemampuan  = kemampuan.id_kemampuan
                JOIN bidang_kemampuan  ON kemampuan.id_bidang_kemampuan = bidang_kemampuan.id_bidang_kemampuan
                WHERE kemampuan_karyawan.id_karyawan = '$id_karyawan'";
                
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
        <hr class="line">
        <div class="wadah_hapus_akun">
            <span class="hapus_akun" id="hapus_akun">Hapus Akun</span>
        </div>
    </div>
</body>

</html>