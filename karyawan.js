$(document).ready(function () {
    $("#ubah_profil").click(function () {
        window.location.href = "update_karyawan.html"
    })
    $("#hapus_profil").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_departemen").click(function () {
        $("#input_departemen,.overlay").fadeIn();
    })
    $("#ubah_departemen").click(function () {
        $("#update_departemen,.overlay").fadeIn();
    })
    $("#hapus_departemen").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#hapus_divisi").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#ubah_divisi").click(function () {
        $("#update_divisi,.overlay").fadeIn();
    })
    $("#new_divisi").click(function () {
        $("#input_divisi,.overlay").fadeIn();
    })
    $("#hapus_spec").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#ubah_spec").click(function () {
        $("#update_spec,.overlay").fadeIn();
    })
    $("#new_spesifikasi").click(function () {
        $("#input_spec,.overlay").fadeIn();
    })
    $(".data_desc").click(function () {
        window.location.href = "update_deskripsi.html"
    })
    $("#hapus_pekerjaan").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $(".data_skill").click(function () {
        $("#update_skill,.overlay").fadeIn();
    })
    $(".heading_skill").click(function () {
        $("#update_bidang,.overlay").fadeIn();
    })
    $(".x_bidang").click(function () {
        $("#update_bidang,.overlay").fadeOut();
    })
    $("#hapus_jenis").click(function () {
        $("#hapus_kemampuan_popup,.overlay").fadeIn();
    })
    $("#hapus_bidang").click(function () {
        $("#hapus_bidang_popup,.overlay").fadeIn();
        $("#update_bidang").fadeOut();
    })
})