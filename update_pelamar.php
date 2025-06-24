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
    <title>Ubah Pelamar</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="input_function.js"></script>
<script src="session.js"></script>
<script src="update_delete_pelamar.js"></script>
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
    $id_pelamar = $_POST["id_pelamar"];
    $sql = "SELECT pelamar.* , profil_karyawan.nama_karyawan
    FROM pelamar
    JOIN profil_karyawan ON profil_karyawan.id_karyawan = pelamar.id_rekruiter
    WHERE id_pelamar = '$id_pelamar'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            echo ("<input type='hidden' id='id_pelamar_ambil' value='" . $row["id_pelamar"] . "'>");
            echo ("<input type='hidden' id='nama_pelamar_ambil' value='" . $row["nama_pelamar"] . "'>");
            echo ("<input type='hidden' id='id_lowongan_ambil' value='" . $row["id_lowongan"] . "'>");
            echo ("<input type='hidden' id='no_telp_ambil' value='" . $row["no_telp"] . "'>");
            echo ("<input type='hidden' id='id_rekruiter_ambil' value='" . $row["id_rekruiter"] . "'>");
            echo ("<input type='hidden' id='id_status_lamaran_ambil' value='" . $row["id_status_lamaran"] . "'>");
            echo ("<input type='hidden' id='alamat_email_ambil' value='" . $row["alamat_email"] . "'>");
            echo ("<input type='hidden' id='id_interviewer_ambil' value='" . $row["id_interviewer"] . "'>");
            echo ("<input type='hidden' id='profile_linkedln_ambil' value='" . $row["profile_linkedln"] . "'>");
            echo ("<input type='hidden' id='foto_profile_ambil' value='" . $row["foto_profile"] . "'>");
            echo ("<input type='hidden' id='file_cv_ambil' value='" . $row["file_cv"] . "'>");
        }
    }else {
        echo "Gagal akses data profil";
    }
    ?>

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
    <div class="bar">
        <span class="save_pelamar" id="simpan_update_pelamar">Simpan</span>
        <span class="cancel_karyawan" id="cancel_pelamar"> Batal</span>
        <span class="tittle_input">Ubah Pelamar</span>
    </div>

    <div class="container">
        <form action="proses_update_pelamar.php" id="form_update_pelamar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_pelamar_update" id="id_pelamar_update">
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
                <input type="file" name="foto_profile_update" id="foto_profile_update" class="foto_karyawan"
                    accept="image/*">
            </label>
            <input type="text" id="nama_pelamar_update" name="nama_pelamar_update" class="main_input" placeholder="Nama Pelamar Baru">
            <select name="id_lowongan_update" id="id_lowongan_update" class="sub_select">
                <option value="" disabled selected hidden class="placeholder">
                    Lowongan Pekerjaan</option>
                <?php
                include("config.php");
                $sql = "SELECT * FROM lowongan";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option class='sub_option' value='" . $row['id_lowongan'] . "'>" . $row['nama_lowongan'] . "</option>";
                }
                ?>
            </select>

            <table class="add_table">
                <tr>
                    <td class="text_input">Nomor Telepon</td>
                    <td>
                        <input type="text" name="no_telp_update" id="no_telp_update" class="add_input" placeholder="co. 087726503008">
                    </td>
                    <td class="text_input">Alamat Email</td>
                    <td>
                        <input type="email" name="alamat_email_update" id="alamat_email_update" class="add_input"
                            placeholder="co. agung-wahyudi@gmail.com">
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Recruiter</td>
                    <td>
                        <select name="id_rekruiter_update" id="id_rekruiter_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">Recruiter Pelamar</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_karyawan'] . "'>" . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td class="text_input">Interviewer</td>
                    <td>
                        <select name="id_interviewer_update" id="id_interviewer_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">Interviewer Pelamar</option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM profil_karyawan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_karyawan'] . "'>" . $row['nama_karyawan'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="text_input">Status Lamaran</td>
                    <td>
                        <select name="id_status_lamaran_update" id="id_status_lamaran_update" class="add_select">
                            <option value="" disabled selected hidden class="placeholder">Status Lamaran Saat Ini
                            </option>
                            <?php
                            include("config.php");
                            $sql = "SELECT * FROM status_lamaran";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_status_lamaran'] . "'>" . $row['nama_status_lamaran'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td class="text_input">Profile Linkedln</td>
                    <td>
                        <input type="text" id="profile_linkedln_update" name="profile_linkedln_update" class="add_input"
                            placeholder="co. https/linkedln/agung-mantap">
                    </td>
                </tr>
            </table>
            <span class="text_cv">File CV Pelamar</span><br>
            <label class="upload_container_cv">
                <img src="" alt="profil" id="icon_file" class="gambar_profil">
                <span class="camera" id="gambar_doc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="cv"
                        id="document">
                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875
                                1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875
                                1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm5.845 17.03a.75.75 0 0 0 1.06
                                0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06
                                1.06l3 3Z" clip-rule="evenodd" />
                        <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23
                                5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                    </svg>
                </span>
                <span class="update_cv">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="update">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625
                        2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75
                        0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75
                        0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0
                        0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                </span>
                <input name="cv_pelamar" type="file" class="foto_karyawan" id="cv_pelamar" type=".pdf,.doc,.docx,application/msword,
                application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
            </label>
            <div class="nama_cv"></div>
    </div>
    </form>
    </div>
</body>

</html>