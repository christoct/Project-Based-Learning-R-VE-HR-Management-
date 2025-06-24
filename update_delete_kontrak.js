$(document).ready(function () {
    $(".ubah_penggajian").click(function () {

        var container = $(this).closest(".data_kontrak");

        var id_kontrak = container.find(".id_kontrak").val();
        var nama_kontrak = container.find(".nama_kontrak").val();
        var id_karyawan = container.find(".id_karyawan").val();
        var id_struktur_gaji = container.find(".id_struktur_gaji").val();
        var id_penanggung_jawab = container.find(".id_penanggung_jawab").val();
        var tanggal_mulai_kontrak = container.find(".tanggal_mulai_kontrak").val();
        var tanggal_akhir_kontrak = container.find(".tanggal_akhir_kontrak").val();
        var status_kontrak = container.find(".status_kontrak").val();

        $("#id_kontrak_update").val(id_kontrak);
        $("#nama_kontrak_update").val(nama_kontrak);
        $("#id_karyawan_update").val(id_karyawan).css("color", "black");
        $("#id_struktur_gaji_update").val(id_struktur_gaji).css("color", "black");
        $("#id_penanggung_jawab_update").val(id_penanggung_jawab).css("color", "black");
        $("#tanggal_mulai_kontrak_update").val(tanggal_mulai_kontrak);
        $("#tanggal_akhir_kontrak_update").val(tanggal_akhir_kontrak);
        $("#status_kontrak_update").val(status_kontrak).css("color", "black");

        $("#update_kontrak, .overlay").fadeIn();
    })
    $("#simpan_update_kontrak").click(function () {
        $("#form_update_kontrak").submit();
    })

    $(".hapus_penggajian").click(function () {
        var container = $(this).closest(".data_kontrak");
        var id_kontrak = container.find(".id_kontrak").val();
        var nama_kontrak = container.find(".nama_kontrak").val();
        $("#id_kontrak_hapus").val(id_kontrak);
        $("#nama_kontrak_hapus")
            .text("Apakah Anda yakin mau menghapus " + nama_kontrak + " ?");
        $("#hapus_kontrak_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_kontrak").click(function () {
        $("#form_hapus_kontrak").submit();
    })
})