$(document).ready(function () {

    $(".ubah_karyawan").click(function () {
        $(".overlay").fadeIn();
        $("#update_spec").fadeIn();

        var container = $(this).closest(".data_spec");

        var id_spesifikasi_kerja = container.find(".id_spesifikasi_kerja").val();
        var id_divisi = container.find(".id_divisi").val();
        var nama_spesifikasi = container.find(".nama_spesifikasi").val();
        var id_supervisor = container.find(".id_supervisor").val();
        var id_departemen = container.find(".id_departemen").val();

        $("#id_spesifikasi_kerja_update").val(id_spesifikasi_kerja).css("color", "black");
        $("#nama_spesifikasi_update").val(nama_spesifikasi);
        $("#id_supervisor_update").val(id_supervisor).css("color", "black");

        $("#id_departemen_update").val(id_departemen).trigger("change");

        setTimeout(function () {
            $("#id_divisi_update").val(id_divisi).css("color", "black");
        }, 0);

        $("#simpan_update_spec").off("click").on("click", function () {
            $("#form_update_spec").submit();
        });
    });

    $('#id_departemen_update').on('change', function () {
        var idDepartemen = $(this).val();

        $("#id_divisi_update option").each(function () {
            var option = $(this);
            var dataDepartemen = option.data('id-departemen');

            if (!dataDepartemen || option.val() === "") {
                option.prop('hidden', false);
            } else if (dataDepartemen == idDepartemen) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        });

        $("#id_divisi_update").val("");
        $("#id_divisi_update").css("color", "grey");
    });

    $('#id_divisi_update').on('change', function () {
        var selectedOption = $(this).find("option:selected");
        if (selectedOption.hasClass("placeholder") || selectedOption.val() === "") {
            $(this).css("color", "grey");
        } else {
            $(this).css("color", "black");
        }
    });

    $(".hapus_karyawan").click(function (){
        var container = $(this).closest(".data_spec");
        var id_spesifikasi_kerja = container.find(".id_spesifikasi_kerja").val();
        var nama_spesifikasi = container.find(".nama_spesifikasi").val();
        $("#id_spesifikasi_kerja_hapus").val(id_spesifikasi_kerja);
        $("#nama_spesifikasi_hapus")
        .text("Apakah Anda yakin mau menghapus data Spesifikasi "+nama_spesifikasi+" ?");
        $("#hapus_spec_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_spec").click(function (){
        $("#form_hapus_spec").submit();
    })
});
