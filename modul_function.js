$(document).ready(function () {
    $(".modul").hover(function () {
        $(".gambar_modul").toggle();
        $(".back").toggle();
    })
    $(".modul").click(function () {
        window.location.href = "pbl_dashboard.html";
    })
    $(".profile_drop").click(function () {
        $(".user").toggle();
        $(".space").toggle();
        $(".opsi_profil").toggle();
    })
    $(".logout").parent().click(function () {
        window.location.href = "pbl_login.html";
    })
    $("#new_lowongan,#tambah_skill,#new_struktur,#new_rekening,#new_kontrak").click(function () {
        $('.overlay, .popup').fadeIn();
    })
    $("#new_penilaian,#new_pencapaian,#new_nilai,#new_status,#new_departemen,#new_divisi").click(function () {
        $('.overlay, .popup').fadeIn();
    })
    $("#new_spesifikasi").click(function () {
        $('.overlay, .popup').fadeIn();
    })
    $("#new_spesifikasi").click(function () {
        $('.overlay, .popup').fadeIn();
    })
    $("#new_kemampuan").click(function () {
        $('.overlay, #jenis_skill').fadeIn();
    })
    $(".close,.x").click(function () {
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
        window.location.href = "input_karyawan.html";
    })
    $(".add_select").change(function () {
        $(this).css("color", "black");
    })
    $("#lowongan_kerja").click(function () {
        window.location.href = "pbl_lowongan_kerja.html";
    })
    $("#pelamar").click(function () {
        window.location.href = "pelamar.html";
    })
    $("#struktur_gaji").click(function () {
        window.location.href = "pbl_struktur_gaji.html";
    })
    $("#rekening_karyawan").click(function () {
        window.location.href = "rekening_karyawan.html";
    })
    $("#kontrak_kerja").click(function () {
        window.location.href = "kontrak.html";
    })
    $("#new_pelamar").click(function () {
        window.location.href = "input_pelamar.html";
    })
    $("#slip_gaji").click(function () {
        window.location.href = "slip_gaji.html";
    })
    $("#penilaian_karyawan").click(function () {
        window.location.href = "pbl_penilaian_karyawan.html";
    })
    $("#pencapaian_karyawan").click(function () {
        window.location.href = "pencapaian_karyawan.html";
    })
    $("#nilai_akhir").click(function () {
        window.location.href = "nilai_akhir.html";
    })
    $("#status_lamaran").click(function () {
        window.location.href = "status_lamaran.html";
    })
    $("#departemen").click(function () {
        window.location.href = "departemen.html";
    })
    $("#profil_karyawan").click(function () {
        window.location.href = "pbl_profil_karyawan.html";
    })
    $("#divisi").click(function () {
        window.location.href = "divisi.html";
    })
    $("#spesifikasi").click(function () {
        window.location.href = "spesifikasi.html";
    })
    $("#kemampuan").click(function () {
        window.location.href = "kemampuan.html";
    })
    $("#deskripsi").click(function () {
        window.location.href = "deskripsi.html";
    })
    $("#new_deskripsi").click(function () {
        window.location.href = "input_deskripsi.html";
    })
    $("#cancel_deskripsi").click(function () {
        window.location.href = "deskripsi.html";
    })
    $("#new_slip").click(function () {
        window.location.href = "input_slip.html";
    })
    $(".non-aktif").click(function () {
        $(".aktif").css("color", "rgb(100, 100, 100");
        $(".aktif").css("background-color", "rgb(212, 212, 212)")
        $(this).css("color", "black");
        $(this).css("background-color", " rgb(162, 178, 255)")
    })
    $(".aktif").click(function () {
        $(".non-aktif").css("color", "rgb(100, 100, 100");
        $(".non-aktif").css("background-color", "rgb(212, 212, 212)")
        $(this).css("color", "black");
        $(this).css("background-color", " rgb(162, 178, 255)")
    })
})
