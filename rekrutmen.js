$(document).ready(function () {
    $("#baris_departemen").hide();
    $("#baris_divisi").hide();
    $("#baris_spec").hide();
    $("#pilih_posisi").change(function () {
        var selected = $(this).val();
        if (selected === "Staff") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").show();
        } else if (selected === "Supervisor") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").show();
        } else if (selected === "Manager") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").hide();
        } else if (selected === "Direktur") {
            $("#baris_departemen").show();
            $("#baris_divisi").hide();
            $("#baris_spec").hide();
        }
    })
    $("#new_lowongan").click(function () {
        $("#tambah_lowongan, .overlay").fadeIn();
    })
    $(".ubah_rekrutmen").click(function () {
        $("#update_lowongan, .overlay").fadeIn();
    })
    $(".hapus_rekrutmen").click(function () {
        $("#hapus_lowongan, .overlay").fadeIn();
    })
    $(".hapus_rekrutmen").click(function () {
        $("#hapus_pelamar, .overlay").fadeIn();
    })
    $("#ubah_pelamar").click(function () {
        window.location.href = "update_pelamar.html";
    })
    $(".data_stat").click(function () {
        $(".overlay,#update_status").fadeIn();
    })
    $("#hapus_status").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#simpan_status").click(function () {

    })
    $("#new_status").click(function () {
        $("#input_status,.overlay").fadeIn();
    })

})