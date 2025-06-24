$(document).ready(function () {
    $(".data_stat").click(function () {

        var container = $(this).closest(".data_stat");

        var id_status_lamaran = container.find(".id_status_lamaran").val();
        var nama_status_lamaran = container.find(".nama_status_lamaran").val();

        $("#id_status_lamaran_update").val(id_status_lamaran);
        $("#nama_status_lamaran_update").val(nama_status_lamaran);

        $("#update_status, .overlay").fadeIn();
        $("#simpan_update_status_lamaran").click(function () {
            $("#form_update_status_lamaran").submit();
        })
        $("#hapus_status").click(function () {
            $("#id_status_lamaran_hapus").val(id_status_lamaran);
            $("#nama_status_lamaran_hapus")
                .text("Apakah Anda yakin mau menghapus status lamaran " + nama_status_lamaran + " ?");

            $("#hapus_status_lamaran_popup,.overlay").fadeIn();
        })

        $("#confirm_hapus_status_lamaran").click(function () {
            $("#form_hapus_status_lamaran").submit();
        })
    })

})