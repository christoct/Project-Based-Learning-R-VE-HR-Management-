$(document).ready(function () {
    $(".ubah_karyawan").click(function () {
        $(".overlay").fadeIn();
        $("#update_departemen").fadeIn();
        var container = $(this).closest(".data_departemen");

        var id_departemen = container.find(".id_departemen").val();
        var nama_departemen = container.find(".nama_departemen").val();
        var id_direktur = container.find(".id_direktur").val();
        $("#nama_departemen_update").val(nama_departemen);
        $("#nama_dirktur_update").val(id_direktur).css("color", "black");
        $("#id_departemen_update").val(id_departemen);

        $("#simpan_update_departemen").click(function () {
            $("#form_update_departemen").submit();
        })
    })

    $(".hapus_karyawan").click(function (){
        var container = $(this).closest(".data_departemen");
        var id_departemen = container.find(".id_departemen").val();
        var nama_departemen = container.find(".nama_departemen").val();
        $("#id_departemen_hapus").val(id_departemen);
        $("#nama_departemen_hapus")
        .text("Apakah Anda yakin mau menghapus data departemen "+nama_departemen+" ?");
        $("#hapus__departemen,.overlay").fadeIn();
    })

    $("#confirm_hapus_departemen").click(function (){
        $("#form_hapus_departemen").submit();
    })
});