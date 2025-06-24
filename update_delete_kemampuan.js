$(document).ready(function () {
    $(".heading_skill").click(function () {
        $(".overlay").fadeIn();

        $("#update_bidang").fadeIn();
        var container = $(this).closest(".heading_skill");

        var id_bidang_kemampuan = container.find(".id_bidang_kemampuan").val();
        var nama_bidang_kemampuan = container.find(".nama_bidang_kemampuan").val();

        $("#nama_bidang_kemampuan_update").val(nama_bidang_kemampuan);
        $("#id_bidang_kemampuan_update").val(id_bidang_kemampuan);

        $("#simpan_update_bidang").click(function () {
            $("#form_update_bidang").submit();
        })

        $("#hapus_bidang").click(function () {

            $("#id_bidang_kemampuan_hapus").val(id_bidang_kemampuan);
            $("#nama_bidang_kemampuan_hapus")
                .text("Apakah Anda yakin mau menghapus bidang kemampuan " + nama_bidang_kemampuan + " ?");
            $("#hapus_bidang_popup,.overlay").fadeIn();
        })

        $("#confirm_hapus_bidang_kemampuan").click(function () {
            $("#form_hapus_bidang_kemampuan").submit();
        })
    })

    $(".data_skill").click(function () {
        $(".overlay").fadeIn();

        $("#update_skill").fadeIn();

        var id_bidang_kemampuan = $(this).data("id-bidang");
        var jenis_kemampuan = $(this).data("jenis-kemampuan");
        var id_kemampuan = $(this).data("id-kemampuan");

        $("#id_bidang_kemampuan_update_skill")
            .val(id_bidang_kemampuan)
            .trigger("change")
            .css("color", "black");
        $("#jenis_kemampuan_update").val(jenis_kemampuan);
        $("#id_Kemampuan_update").val(id_kemampuan);

        $("#simpan_update_kemampuan").click(function () {
            $("#form_update_kemampuan").submit();
        })
        $("#hapus_jenis").click(function () {

        $("#id_kemampuan_hapus").val(id_kemampuan);
        $("#nama_kemampuan_hapus")
            .text("Apakah Anda yakin mau menghapus kemampuan " + jenis_kemampuan + " ?");
        $("#hapus_kemampuan_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_kemampuan").click(function () {
        $("#form_hapus_kemampuan").submit();
    })
    })

});