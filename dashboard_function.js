$(document).ready(function () {
    $(".profile_drop").click(function () {
        $(".user").toggle();
        $(".space").toggle();
        $(".opsi_profil").toggle();
    })
    $("#rekrutmen").click(function () {
        window.location.href = "pbl_lowongan_kerja.php";
    })
    $(".logout").parent().click(function () {
        window.location.href = "proses_logout.php";
    })
    $("#karyawan").click(function () {
        window.location.href = "pbl_profil_karyawan.php";
    })
    $("#penggajian").click(function () {
        window.location.href = "pbl_struktur_gaji.php";
    })
    $("#penilaian").click(function () {
        window.location.href = "pbl_penilaian_karyawan.php";
    })
    $(".lihat").parent().click(function () {
        window.location.href = "profil.php"
    })
    $(".user").click(function () {
        window.location.href = "profil.php"
    })
})