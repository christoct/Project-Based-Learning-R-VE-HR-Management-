$(document).ready(function () {
    function updateSelectColor($select) {
        var val = $select.val();
        var isPlaceholder = val === null || val === "" || $select.find("option:selected").is("[disabled]");
        $select.css("color", isPlaceholder ? "grey" : "black");
    }

    function updateInputColor($input) {
        $input.css("color", $input.val() === "" ? "grey" : "black");
    }

    function filterDivisi(idDepartemen) {
        $("#id_divisi_update option").each(function () {
            var dataDepartemen = $(this).data('id-departemen');
            if (!dataDepartemen || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataDepartemen != idDepartemen);
            }
        });
    }

    function filterSpesifikasi(idDivisi) {
        $("#id_spesifikasi_update option").each(function () {
            var dataDivisi = $(this).data('id-divisi');
            if (!dataDivisi || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataDivisi != idDivisi);
            }
        });
    }

    function filterJenisKemampuan(idBidang, $selectTarget) {
        $selectTarget.find("option").each(function () {
            var dataBidang = $(this).data("id-bidang");
            if (!dataBidang || $(this).val() === "") {
                $(this).prop("hidden", false);
            } else {
                $(this).prop("hidden", dataBidang != idBidang);
            }
        });
    }

    var id_pekerjaan_ambil = $("#id_pekerjaan_ambil").val();
    var id_departemen_ambil = $("#id_departemen_ambil").val();
    var id_divisi_ambil = $("#id_divisi_ambil").val();
    var spesifikasi_kerja_ambil = $("#spesifikasi_kerja_ambil").val();
    var deskripsi_pekerjaan_ambil = $("#deskripsi_pekerjaan_ambil").val();
    var nama_pekerjaan_ambil = $("#nama_pekerjaan_ambil").val();

    $("#nama_pekerjaan_update").val(nama_pekerjaan_ambil);
    $("#id_pekerjaan_update").val(id_pekerjaan_ambil);
    $("#deskripsi_update").val(deskripsi_pekerjaan_ambil);
    $("#id_departemen_update").val(id_departemen_ambil).trigger("change");

    filterDivisi(id_departemen_ambil);
    $("#id_divisi_update").val(id_divisi_ambil).trigger("change");

    filterSpesifikasi(id_divisi_ambil);
    $("#id_spesifikasi_update").val(spesifikasi_kerja_ambil).trigger("change");

    setTimeout(function () {
        var selected = $("#id_spesifikasi_update option:selected");
        var namaPenanggungJawab = selected.data("nama-penanggung") || "-";
        var idPenanggung = selected.data("id-penanggung") || "";

        $("#nama_pj_update").val(namaPenanggungJawab);
        $("#id_pj_update").val(idPenanggung);

        updateInputColor($("#nama_pj_update"));
    }, 100);

    $("#id_departemen_update").on("change", function () {
        var idDepartemen = $(this).val();
        filterDivisi(idDepartemen);
        $("#id_divisi_update").val("").trigger("change");
        updateSelectColor($(this));
    });

    $("#id_divisi_update").on("change", function () {
        var idDivisi = $(this).val();
        filterSpesifikasi(idDivisi);
        $("#id_spesifikasi_update").val("").trigger("change");
        $("#nama_pj_update").val("");
        $("#id_pj_update").val("");
        updateSelectColor($(this));
    });

    $("#id_spesifikasi_update").on("change", function () {
        var selected = $(this).find("option:selected");
        var idPenanggung = selected.data("id-penanggung") || "";
        var namaPenanggung = selected.data("nama-penanggung") || "-";
        $("#nama_pj_update").val(namaPenanggung);
        $("#id_pj_update").val(idPenanggung);
        updateSelectColor($(this));
        updateInputColor($("#nama_pj_update"));
    });

    updateSelectColor($("#id_departemen_update"));
    updateSelectColor($("#id_divisi_update"));
    updateSelectColor($("#id_spesifikasi_update"));
    updateInputColor($("#nama_pj_update"));

    $("#tambah_skill").on("click", function () {
        $(".overlay").show();
        $("#input_skill").fadeIn(200);
    });

    $(".close, .x, .tidak").on("click", function () {
        $(".popup").fadeOut(200);
        $(".overlay").hide();
    });

    $(".table_skill").on("click", ".body_skill", function () {
        const bidang = $(this).find("td").eq(0).text().trim();
        const jenis = $(this).find("td").eq(1).text().trim();
        const tingkat = $(this).find("td").eq(2).text().trim();

        $("#edit_skill").data("baris_edit", $(this));

        $("#bidang_kemampuan_update option").filter(function () {
            return $(this).text().trim() === bidang;
        }).prop("selected", true).trigger("change");

        $("#jenis_kemampuan_update option").filter(function () {
            return $(this).text().trim() === jenis;
        }).prop("selected", true).trigger("change");

        $("#tingkat_kemampuan_update").val(tingkat).trigger("change");

        $(".overlay").fadeIn(200);
        $("#edit_skill").fadeIn(200);

        updateSelectColor($("#bidang_kemampuan_update"));
        updateSelectColor($("#jenis_kemampuan_update"));
        updateSelectColor($("#tingkat_kemampuan_update"));
    });

    $("#simpan_skill").on("click", function () {
        const bidang = $("#bidang_kemampuan_popup option:selected").text();
        const jenis = $("#jenis_kemampuan_popup option:selected").text();
        const tingkat = $("#tingkat_kemampuan_popup").val();

        if (bidang && jenis && tingkat) {
            $(".table_skill").append(`
                <tr class="body_skill">
                    <td class="data_skill">${bidang}</td>
                    <td class="data_skill">${jenis}</td>
                    <td class="data_skill">${tingkat}</td>
                </tr>
            `);
            $("#input_skill").fadeOut(200);
            $(".overlay").fadeOut(200);
        }
    });

    $("#simpan_skill_update").on("click", function () {
        const baris = $("#edit_skill").data("baris_edit");
        const bidang = $("#bidang_kemampuan_update option:selected").text();
        const jenis = $("#jenis_kemampuan_update option:selected").text();
        const tingkat = $("#tingkat_kemampuan_update").val();

        if (baris && bidang && jenis && tingkat) {
            baris.find("td").eq(0).text(bidang);
            baris.find("td").eq(1).text(jenis);
            baris.find("td").eq(2).text(tingkat);
            $("#edit_skill").fadeOut(200);
            $(".overlay").fadeOut(200);
        }
    });

    $("#hapus_kemampuan").on("click", function () {
        const baris = $("#edit_skill").data("baris_edit");
        if (baris) baris.remove();
        $("#edit_skill").fadeOut(200);
        $(".overlay").fadeOut(200);
    });

    $("#bidang_kemampuan_popup").on("change", function () {
        const idBidang = $(this).val();
        filterJenisKemampuan(idBidang, $("#jenis_kemampuan_popup"));
        $("#jenis_kemampuan_popup").val("").trigger("change");
        $("#jenis_kemampuan_popup").css("color", "grey");
        updateSelectColor($(this));
    });

    $("#bidang_kemampuan_update").on("change", function () {
        const idBidang = $(this).val();
        filterJenisKemampuan(idBidang, $("#jenis_kemampuan_update"));
        $("#jenis_kemampuan_update").val("").trigger("change");
        $("#jenis_kemampuan_update").css("color", "grey");
        updateSelectColor($(this));
    });

    $("#form_update_pekerjaan").on("submit", function () {
        const daftarKemampuan = [];

        $(".table_skill .body_skill").each(function () {
            const bidang = $(this).find("td").eq(0).text().trim();
            const jenis = $(this).find("td").eq(1).text().trim();
            const tingkat = $(this).find("td").eq(2).text().trim();
            daftarKemampuan.push({ bidang, jenis, tingkat });
        });

        $("#daftar_kemampuan").val(JSON.stringify(daftarKemampuan));
    });
    $("#hapus_pekerjaan").click(function () {
        $("#id_pekerjaan_hapus").val(id_pekerjaan_ambil);
        $("#nama_pekerjaan_hapus")
            .text("Apakah Anda yakin mau menghapus data Pekerjaan " + nama_pekerjaan_ambil + " ?");
        $("#hapus_pekerjaan_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_spec").click(function () {
        $("#form_hapus_pekerjaan").submit();
    })
});
