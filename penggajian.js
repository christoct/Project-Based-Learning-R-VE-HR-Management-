$(document).ready(function () {
    $("#ubah_struktur").click(function () {
        $("#update_struktur,.overlay").fadeIn();
    })
    $("#hapus_struktur").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_struktur").click(function () {
        $("#input_struktur,.overlay").fadeIn();
    })

    $("#ubah_rekening").click(function () {
        $("#update_rekening,.overlay").fadeIn();
    })
    $("#hapus_rekening").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_rekening").click(function () {
        $("#input_rekening,.overlay").fadeIn();
    })

    $("#ubah_kontrak").click(function () {
        $("#update_kontrak,.overlay").fadeIn();
    })
    $("#hapus_kontrak").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_kontrak").click(function () {
        $("#input_kontrak,.overlay").fadeIn();
    })
    $("#ubah_slip").click(function () {
        window.location.href="update_slip.html"
    })
    $("#hapus_slip").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#simpan_perubahan_slip").click(function () {
        window.location.href="slip_gaji.html"
    })
    $("#kembali_slip").click(function () {
        window.location.href="slip_gaji.html"
    })
    $("#update_kalkulasi").show();
    $("#update_keterangan").show();
})