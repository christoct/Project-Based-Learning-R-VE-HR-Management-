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
    <title>Karyawan Baru</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="karyawan.js"></script>
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
        <span class="save" id="simpan_skill">Simpan</span>
    </div>

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
        <button type="submit" form="input_karyawan" class="save_karyawan" id="simpan_karyawan">Simpan</button>
        <span class="cancel_karyawan" id="cancel_karyawan"> Batal</span>
        <span class="tittle_input">Karyawan Baru</span>
    </div>

    <div class="container">
        <form action="proses_input_karyawan.php" id="input_karyawan" method="POST" enctype="multipart/form-data">
            <label class="upload_container">
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
                <span class="update_foto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="update">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625
                        2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75
                        0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75
                        0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0
                        0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                </span>
                <input name="foto_karyawan" type="file" class="foto_karyawan" id="file_foto_karyawan" accept="image/*">
            </label>
            <input name="nama_karyawan" type="text" class="main_input" placeholder="Nama Karyawan Baru">
            <select name="nama_pekerjaan" id="nama_kerja" class="sub_select" disabled>
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
                        <select name="departemen_dipilih" id="text_departemen" class="add_select">
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
                        <input name="email_kantor_karyawan" type="email" class="add_input"
                            placeholder="co. sella-hr-manager@gmail.com">
                    </td>
                </tr>
                <tr>
                    <td class="text_input" id="keterangan_divisi">Divisi Kerja</td>
                    <td>
                        <select id="text_divisi" name="divisi_dipilih" class="add_select">
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
                        <input name="telepon_kantor_karyawan" type="text" class="add_input"
                            placeholder="co. 087765219005">
                    </td>
                </tr>
                <tr>
                    <td class="text_input" id="keterangan_spec">Spesifikasi Kerja</td>
                    <td>
                        <select name="spec_dipilih" id="text_spec" class="add_select">
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
                        <input type="text" id="nama_pj_display" class="add_input" placeholder="Otomatis Terisi"
                            readonly>
                        <input type="hidden" name="atasan" id="text_PN">
                    </td>
                </tr>
            </table>
            <hr class="line"><br>
            <span class="keterangan">Data Pribadi</span>


            <table class="add_table">
                <tr>
                    <td class="text_input">NIK</td>
                    <td>
                        <input name="NIK_karyawan" type="text" class="add_input" placeholder="co. 237625448009">
                    </td>
                    <td class="text_input">Jenis Kelamin</td>
                    <td>
                        <select name="jenis_kelamin" id="" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">Pria / Wanita</option>
                            <option value="L">Pria</option>
                            <option value="P">Wanita</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Umur</td>
                    <td>
                        <input name="umur_karyawan" type="number" min="18" max="60" step="1" class="add_number"
                            placeholder="18 - 60 tahun">
                    </td>
                    <td class="text_input">Jumlah Anak</td>
                    <td>
                        <input name="jumlah_anak" type="number" min="0" step="1" class="add_number"
                            placeholder="Jumlah Anak Kandung">
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Status Kawin</td>
                    <td>
                        <select name="status_kawin" id="" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">Sudah/Belum/Cerai</option>
                            <option value="Sudah Menikah">Sudah Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Bercerai">Bercerai</option>
                        </select>
                    </td>
                    <td class="text_input">Alamat</td>
                    <td>
                        <input name="alamat_karyawan" type="text" class="add_input" placeholder="co. Jl.Anggrek No.17">
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Email Pribadi</td>
                    <td>
                        <input name="email_karyawan" type="text" class="add_input"
                            placeholder="co. sella.ajaa@gmail.com">
                    </td>
                    <td class="text_input">Telepon Pribadi</td>
                    <td>
                        <input name="telepon_karyawan" type="text" class="add_input" placeholder="co. +628772654800">
                    </td>
                </tr>
            </table>


            <hr class="line"><br>
            <span class="keterangan">Kemampuan Kerja</span><br><br>
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
                </table>
            </div>
            <input type="hidden" name="daftar_kemampuan" id="daftar_kemampuan">
        </form>
    </div>
</body>

</html>