$(document).ready(function () {
    $(".ubah_karyawan").click(function () {
        $(".overlay").fadeIn();

        $("#update_divisi").fadeIn();
        var container = $(this).closest(".data_divisi");

        var id_divisi = container.find(".id_divisi").val();
        var nama_divisi = container.find(".nama_divisi").val();
        var id_maanger = container.find(".id_manager").val();
        var id_departemen = container.find(".id_departemen").val();

        $("#id_departemen_update").val(id_departemen).css("color", "black");
        $("#nama_manager_update").val(id_maanger).css("color", "black");
        $("#id_divisi_update").val(id_divisi);
        $("#nama_divisi_update").val(nama_divisi);

        $("#simpan_update_divisi").click(function () {
            $("#form_update_divisi").submit();
        })
    })
    $(".hapus_karyawan").click(function (){
        var container = $(this).closest(".data_divisi");
        var id_divisi = container.find(".id_divisi").val();
        var nama_divisi = container.find(".nama_divisi").val();
        $("#id_divisi_hapus").val(id_divisi);
        $("#nama_divisi_hapus")
        .text("Apakah Anda yakin mau menghapus data divisi "+nama_divisi+" ?");
        $("#hapus_divisi_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_divisi").click(function (){
        $("#form_hapus_divisi").submit();
    })
});