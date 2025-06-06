    $(document).ready(function () {
        $(".profile_drop").click(function () {
            $(".user").toggle();
            $(".space").toggle();
            $(".opsi_profil").toggle();
        })
        $(".logout").parent().click(function () {
            window.location.href = "pbl_login.html";
        })
        $("#rekrutmen").click(function () {
            window.location.href = "pbl_lowongan_kerja.html";
        })
        $("#karyawan").click(function () {
            window.location.href = "pbl_profil_karyawan.html";
        })
        $("#penggajian").click(function () {
            window.location.href = "pbl_struktur_gaji.html";
        })
        $("#penilaian").click(function () {
            window.location.href = "pbl_penilaian_karyawan.html";
        })
    })