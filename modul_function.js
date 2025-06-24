$(document).ready(function () {
    $(".modul").hover(function () {
        $(".gambar_modul").toggle();
        $(".back").toggle();
    })
    $(".modul").click(function () {
        window.location.href = "pbl_dashboard.php";
    })
    $(".profile_drop").click(function () {
        $(".user").toggle();
        $(".space").toggle();
        $(".opsi_profil").toggle();
    })
    $(".logout").parent().click(function () {
        window.location.href = "proses_logout.php";
    })
    $("#tambah_skill").click(function () {
        $('.overlay, #input_skill').fadeIn();
    })
    $("#new_kemampuan").click(function () {
        $('.overlay, #jenis_skill').fadeIn();
    })
    $(".close,.x,.tidak").click(function () {
        $('.overlay, .popup').fadeOut();
    })
    $("#tutup_jenis,#close_jenis").click(function () {
        $('.overlay, #jenis_skill').fadeOut();
    })
    $("#simpan_jenis").click(function () {
        $('.overlay, #jenis_skill').fadeOut();
    })
    $(".btn_bidang").click(function () {
        $('#jenis_skill').fadeOut();
        $('#popup_bidang').fadeIn();
    })
    $("#simpan_bidang").click(function () {
        
        $('#popup_bidang').fadeOut();
        $('#jenis_skill').fadeIn();
    })
    $("#tutup_bidang,#close_bidang").click(function () {
        $('#popup_bidang').fadeOut();
        $('#jenis_skill').fadeIn();
    })
    $(".save").click(function () {
        $('.overlay, .popup').fadeOut();
    })
    $(".popup_select,.sub_select,.main_select").change(function () {
        $(this).css("color", "black");
    })
    $(".new_karyawan").click(function () {
        window.location.href = "input_karyawan.php";
    })
    $(".add_select").change(function () {
        $(this).css("color", "black");
    })
    $("#lowongan_kerja").click(function () {
        window.location.href = "pbl_lowongan_kerja.php";
    })
    $("#pelamar").click(function () {
        window.location.href = "pelamar.php";
    })
    $("#struktur_gaji").click(function () {
        window.location.href = "pbl_struktur_gaji.php";
    })
    $("#rekening_karyawan").click(function () {
        window.location.href = "rekening_karyawan.php";
    })
    $("#kontrak_kerja").click(function () {
        window.location.href = "kontrak.php";
    })
    $("#new_pelamar").click(function () {
        window.location.href = "input_pelamar.php";
    })
    $("#slip_gaji").click(function () {
        window.location.href = "slip_gaji.php";
    })
    $("#penilaian_karyawan").click(function () {
        window.location.href = "pbl_penilaian_karyawan.php";
    })
    $("#pencapaian_karyawan").click(function () {
        window.location.href = "pencapaian_karyawan.php";
    })
    $("#nilai_akhir").click(function () {
        window.location.href = "nilai_akhir.php";
    })
    $("#status_lamaran").click(function () {
        window.location.href = "status_lamaran.php";
    })
    $("#departemen").click(function () {
        window.location.href = "departemen.php";
    })
    $("#profil_karyawan").click(function () {
        window.location.href = "pbl_profil_karyawan.php";
    })
    $("#divisi").click(function () {
        window.location.href = "divisi.php";
    })
    $("#spesifikasi").click(function () {
        window.location.href = "spesifikasi.php";
    })
    $("#kemampuan").click(function () {
        window.location.href = "kemampuan.php";
    })
    $("#deskripsi").click(function () {
        window.location.href = "deskripsi.php";
    })
    $("#new_deskripsi").click(function () {
        window.location.href = "input_deskripsi.php";
    })
    $("#cancel_deskripsi").click(function () {
        window.location.href = "deskripsi.php";
    })
    $("#new_slip").click(function () {
        window.location.href = "input_slip.php";
    })
    $(".non-aktif").click(function () {
        $(".aktif").css("color", "rgb(100, 100, 100");
        $(".aktif").css("background-color", "rgb(212, 212, 212)")
        $(this).css("color", "black");
        $(this).css("background-color", " rgb(162, 178, 255)")
        $("#status_lowongan_input").val("Non-Aktif");
    })
    $(".aktif").click(function () {
        $(".non-aktif").css("color", "rgb(100, 100, 100");
        $(".non-aktif").css("background-color", "rgb(212, 212, 212)")
        $(this).css("color", "black");
        $(this).css("background-color", " rgb(162, 178, 255)")
        $("#status_lowongan_input").val("Aktif");
    })
    $(".lihat,.user").click(function(){
        window.location.href="profil.php";
    })
    $(".lihat").parent().click(function(){
        window.location.href="profil.php";
    })
})
