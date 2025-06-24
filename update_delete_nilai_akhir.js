$(document).ready(function () {
    $(".data_nilai").click(function () {

        var container = $(this).closest(".data_nilai");

        var id_nilai_akhir = container.find(".id_nilai_akhir").val();
        var nama_nilai_akhir = container.find(".nama_nilai_akhir").val();

        $("#id_nilai_akhir_update").val(id_nilai_akhir);
        $("#nama_nilai_akhir_update").val(nama_nilai_akhir);

        $("#update_nilai, .overlay").fadeIn();

        $("#hapus_nilai").click(function () {
            $("#id_nilai_akhir_hapus").val(id_nilai_akhir);
            $("#nama_nilai_akhir_hapus")
                .text("Yakin mau menghapus nilai " + nama_nilai_akhir + " ?");
            $("#hapus_nilai_popup,.overlay").fadeIn();
        })
    })
    $("#simpan_update_nilai_akhir").click(function () {
        $("#form_update_nilai_akhir").submit();
    })

    $("#confirm_hapus_nilai").click(function () {
        $("#form_hapus_nilai").submit();
    })
})