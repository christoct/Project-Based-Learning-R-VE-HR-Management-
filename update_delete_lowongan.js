$(document).ready(function () {
    function updateSelectColor($select) {
        const val = $select.val();
        const isPlaceholder = val === null || val === "" || $select.find("option:selected").is("[disabled]");
        $select.css("color", isPlaceholder ? "grey" : "black");
    }
    function filterDivisi(idDepartemen) {
        $("#update_id_divisi option").each(function () {
            var dataDepartemen = $(this).data('id-departemen');
            if (!dataDepartemen || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataDepartemen != idDepartemen);
            }
        });
    }

    function filterSpesifikasi(idDivisi) {
        $("#update_id_spesifikasi_kerja option").each(function () {
            var dataDivisi = $(this).data('id-divisi');
            if (!dataDivisi || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataDivisi != idDivisi);
            }
        });
    }

    function filterPekerjaan(idSpesifikasi) {
        $("#update_id_pekerjaan option").each(function () {
            var dataSpec = $(this).data('id-spec');
            if (!dataSpec || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataSpec != idSpesifikasi);
            }
        });
    }
    $(".ubah_rekrutmen").click(function () {
        var container = $(this).closest(".data_lowongan");

        var id_lowongan = container.find(".id_lowongan").val();
        var nama_lowongan = container.find(".nama_lowongan").val();
        var id_pekerjaan = container.find(".id_pekerjaan").val();
        var status_lowongan = container.find(".status_lowongan").val();
        var tenggat_akhir = container.find(".tenggat_akhir").val();
        var id_spesifikasi_kerja = container.find(".id_spesifikasi_kerja").val();
        var id_divisi = container.find(".id_divisi").val();
        var id_departemen = container.find(".id_departemen").val();

        $("#update_id_lowongan").val(id_lowongan);
        $("#update_nama_lowongan").val(nama_lowongan);
        $("#update_id_pekerjaan").val(id_pekerjaan).css("color", "black");
        $("#update_tenggat_akhir").val(tenggat_akhir);
        $("#update_id_spesifikasi_kerja").val(id_spesifikasi_kerja).css("color", "black");
        $("#update_id_divisi").val(id_divisi).css("color", "black");
        $("#update_id_departemen").val(id_departemen).css("color", "black");

        if (status_lowongan === "Aktif") {
            $("#update_lowongan .aktif").click();
        } else {
            $("#update_lowongan .non-aktif").click();
        }

        $(".aktif").click(function () {
            $("#update_status_lowongan").val("Aktif");
            $(".aktif").addClass("selected");
            $(".non-aktif").removeClass("selected");
        });

        $(".non-aktif").click(function () {
            $("#update_status_lowongan").val("Non-Aktif");
            $(".non-aktif").addClass("selected");
            $(".aktif").removeClass("selected");
        });
        $("#update_lowongan, .overlay").fadeIn();

        $("#simpan_update_lowongan").click(function () {
            $("#form_update_lowongan").submit();
        })
    })

    $(".hapus_rekrutmen").click(function (){
        var container2 = $(this).closest(".data_lowongan");
        var id_lowongan2 = container2.find(".id_lowongan").val();
        var nama_lowongan2 = container2.find(".nama_lowongan").val();
        $("#id_lowongan_hapus").val(id_lowongan2);
        $("#nama_lowongan_hapus_")
        .text("Apakah Anda yakin mau menghapus data "+nama_lowongan2+" ?");
        $("#hapus_lowongan,.overlay").fadeIn();
    })

    $("#confirm_hapus_lowongan").click(function (){
        $("#form_hapus_lowongan").submit();
    })

    $("#update_id_departemen").on("change", function () {
        var idDepartemen = $(this).val();
        filterDivisi(idDepartemen);
        $("#update_id_divisi").val("").trigger("change");
        updateSelectColor($(this));
    });

    $("#update_id_divisi").on("change", function () {
        var idDivisi = $(this).val();
        filterSpesifikasi(idDivisi);
        $("#update_id_spesifikasi_kerja").val("").trigger("change");
        updateSelectColor($(this));
    });

    $("#update_id_spesifikasi_kerja").on("change", function () {
        var selected = $(this).find("option:selected");
        var idSpec = selected.val();


        filterPekerjaan(idSpec);
        $("#update_id_pekerjaan").val("").trigger("change");

        updateSelectColor($(this));
    });

    $("#update_id_pekerjaan").on("change", function () {
        updateSelectColor($(this));
    });

    $("#update_id_departemen").val(id_departemen_ambil).trigger("change");

    setTimeout(function () {
        $("#update_id_divisi").val(id_divisi_ambil).trigger("change");
        $("#update_id_spesifikasi_kerja").val(spesifikasi_kerja_ambil).trigger("change");
        $("#update_id_pekerjaan").val(id_pekerjaan_ambil).trigger("change");

        updateSelectColor($("#update_id_departemen"));
        updateSelectColor($("#update_id_divisi"));
        updateSelectColor($("#update_id_spesifikasi_kerja"));
        updateSelectColor($("#update_id_pekerjaan"));
    }, 100);

})