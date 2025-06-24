$(document).ready(function () {

    function updateSelectColor($select) {
        const val = $select.val();
        const isPlaceholder = val === null || val === "" || $select.find("option:selected").is("[disabled]");
        $select.css("color", isPlaceholder ? "grey" : "black");
    }

    var id_karyawan_ambil = $("#id_karyawan_ambil").val();
    var nama_karyawan_ambil = $("#nama_karyawan_ambil").val();
    var id_pekerjaan_ambil = $("#id_pekerjaan_ambil").val();
    var telepon_kerja_ambil = $("#telepon_kerja_ambil").val();
    var email_ambil = $("#email_ambil").val();
    var id_atasan_ambil = $("#id_atasan_ambil").val();
    var foto_karyawan_ambil = $("#foto_karyawan_ambil").val();
    var id_departemen_ambil = $("#id_departemen_ambil").val();
    var id_divisi_ambil = $("#id_divisi_ambil").val();
    var spesifikasi_kerja_ambil = $("#spesifikasi_kerja_ambil").val();

    var namaAtasan = $("#spesifikasi_kerja_update option").filter(function () {
        return $(this).data("id-penanggung") == id_atasan_ambil;
    }).data("nama-penanggung");

    $("#id_karyawan_update").val(id_karyawan_ambil);
    $("#nama_pj_display").val(namaAtasan);
    $("#text_PN").val(id_atasan_ambil);
    $("#nama_karyawan_update").val(nama_karyawan_ambil);
    $("#id_pekerjaan_update").val(id_pekerjaan_ambil);
    $("#telepon_kerja_update").val(telepon_kerja_ambil);
    $("#email_update").val(email_ambil);
    $("#id_atasan_update").val(id_atasan_ambil);
    $("#spesifikasi_kerja_update").val(spesifikasi_kerja_ambil);
    $("#input_profil").attr("src", "./uploads/foto_karyawan/" + foto_karyawan_ambil).show();
    $("#camera").hide();
    $(".upload_container").css({ padding: "0vw", height: "10vw", width: "10vw" });

    $("#nik_update").val($("#nik_diambil").val());
    $("#umur_update").val($("#umur_diambil").val());
    $("#email_pribadi_update").val($("#email_pribadi_diambil").val());
    $("#status_kawin_update").val($("#status_kawin_diambil").val()).css("color", "black");
    $("#jenis_kelamin_update").val($("#jenis_kelamin_diambil").val()).css("color", "black");
    $("#jumlah_anak_update").val($("#jumlah_anak_diambil").val());
    $("#alamat_update").val($("#alamat_diambil").val());
    $("#telepon_pribadi_update").val($("#telepon_pribadi_diambil").val());

    $("#foto_karyawan_update").change(function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#input_profil").attr("src", e.target.result).show();
                $("#camera").hide();
                $(".upload_container").css({ padding: "0vw", height: "10vw", width: "10vw" });
            };
            reader.readAsDataURL(file);
        }
    });

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
        $("#spesifikasi_kerja_update option").each(function () {
            var dataDivisi = $(this).data('id-divisi');
            if (!dataDivisi || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataDivisi != idDivisi);
            }
        });
    }

    function filterPekerjaan(idSpesifikasi) {
        $("#id_pekerjaan_update option").each(function () {
            var dataSpec = $(this).data('id-spec');
            if (!dataSpec || $(this).val() === "") {
                $(this).prop('hidden', false);
            } else {
                $(this).prop('hidden', dataSpec != idSpesifikasi);
            }
        });
    }

    function filterJenisKemampuan(idBidang, $selectJenis) {
        $selectJenis.find("option").each(function () {
            const dataBidang = $(this).data("id-bidang");
            const isPlaceholder = $(this).val() === "";

            if (isPlaceholder || dataBidang == idBidang) {
                $(this).prop("hidden", false);
            } else {
                $(this).prop("hidden", true);
            }
        });
    }

    $("#id_departemen_update").on("change", function () {
        var idDepartemen = $(this).val();
        filterDivisi(idDepartemen);
        $("#id_divisi_update").val("").trigger("change");
        updateSelectColor($(this));
    });

    $("#id_divisi_update").on("change", function () {
        var idDivisi = $(this).val();
        filterSpesifikasi(idDivisi);
        $("#spesifikasi_kerja_update").val("").trigger("change");
        $("#nama_pj_display").val("");
        $("#text_PN").val("");
        updateSelectColor($(this));
    });

    $("#spesifikasi_kerja_update").on("change", function () {
        var selected = $(this).find("option:selected");
        var idSpec = selected.val();
        var idPenanggung = selected.data("id-penanggung");
        var namaPenanggung = selected.data("nama-penanggung");

        $("#text_PN").val(idPenanggung);
        $("#nama_pj_display").val(namaPenanggung);

        filterPekerjaan(idSpec);
        $("#id_pekerjaan_update").val("").trigger("change");

        updateSelectColor($(this));
    });

    $("#id_pekerjaan_update").on("change", function () {
        updateSelectColor($(this));
    });

    $("#id_departemen_update").val(id_departemen_ambil).trigger("change");

    setTimeout(function () {
        $("#id_divisi_update").val(id_divisi_ambil).trigger("change");
        $("#spesifikasi_kerja_update").val(spesifikasi_kerja_ambil).trigger("change");
        $("#id_pekerjaan_update").val(id_pekerjaan_ambil).trigger("change");

        updateSelectColor($("#id_departemen_update"));
        updateSelectColor($("#id_divisi_update"));
        updateSelectColor($("#spesifikasi_kerja_update"));
        updateSelectColor($("#id_pekerjaan_update"));
    }, 100);

    $("#update_karyawan").on("submit", function () {
        let daftar_kemampuan = [];
        $(".body_skill").each(function () {
            let kolom = $(this).find("td");
            daftar_kemampuan.push({
                bidang: kolom.eq(0).text().trim(),
                jenis: kolom.eq(1).text().trim(),
                tingkat: kolom.eq(2).text().trim()
            });
        });
        $("#daftar_kemampuan").val(JSON.stringify(daftar_kemampuan));
    });

    $("#tambah_skill").on("click", function () {
        $("#bidang_kemampuan_popup, #jenis_kemampuan_popup").val("").css("color", "grey").trigger("change");
        $("#tingkat_kemampuan_popup").val("").css("color", "grey");
        $("#bidang_kemampuan_popup").val("").trigger("change");
        $("#jenis_kemampuan_popup").val("").trigger("change");
        $("#tingkat_kemampuan_popup").val("").trigger("change");
        updateSelectColor($("#bidang_kemampuan_popup"));
        updateSelectColor($("#jenis_kemampuan_popup"));
        updateSelectColor($("#tingkat_kemampuan_popup"));

        $(".overlay").fadeIn(200);
        $("#input_skill").fadeIn(200);
    });

    $(document).on("click", ".body_skill", function () {
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
        if ($("#input_skill").is(":visible")) {
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
        }
    });

    $("#edit_skill .save").on("click", function () {
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
        if (baris) {
            baris.remove();
        }
        $("#edit_skill").fadeOut(200);
        $(".overlay").fadeOut(200);
    });

    $(".x, .close").on("click", function () {
        $(".popup").fadeOut(200);
        $(".overlay").fadeOut(200);
    });
    $("#bidang_kemampuan_popup").on("change", function () {
        const idBidang = $(this).val();
        filterJenisKemampuan(idBidang, $("#jenis_kemampuan_popup"));
        $("#jenis_kemampuan_popup").val("").trigger("change");
        $("#jenis_kemampuan_popup").css("color","grey");
        updateSelectColor($(this));
    });

    $("#bidang_kemampuan_update").on("change", function () {
        const idBidang = $(this).val();
        filterJenisKemampuan(idBidang, $("#jenis_kemampuan_update"));
        $("#jenis_kemampuan_update").val("").trigger("change");
        $("#jenis_kemampuan_update").css("color","grey");
        updateSelectColor($(this));
    });

    $(".hapus_karyawan").click(function (){
        var container = $(this).closest(".data_karyawan");
        var id_karyawan = container.find(".id_karyawan").val();
        var nama_karyawan = container.find(".nama_karyawan").val();
        $("#id_karyawan_hapus").val(id_karyawan);
        $("#nama_karyawan_hapus")
        .text("Apakah Anda yakin mau menghapus data "+nama_karyawan+" ?");

        $("#hapus_karyawan, .overlay").fadeIn();
    })
    $("#confirm_hapus_karyawan").click(function (){
        $("#form_hapus_karyawan").submit();
    })


});
