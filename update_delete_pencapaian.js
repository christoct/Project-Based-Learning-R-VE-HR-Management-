$(document).ready(function () {
    $(".ubah_penilaian").click(function () {

        var container = $(this).closest(".data_pencapaian");

        var id_pencapaian = container.find(".id_pencapaian").val();
        var nama_pencapaian = container.find(".nama_pencapaian").val();
        var id_karyawan = container.find(".id_karyawan").val();
        var tanggal_mulai = container.find(".tanggal_mulai").val();
        var tanggal_selesai = container.find(".tanggal_selesai").val();
        var status_pencapaian = container.find(".status_pencapaian").val();

        $("#id_pencapaian_update").val(id_pencapaian);
        $("#nama_pencapaian_update").val(nama_pencapaian);
        $("#id_karyawan_update").val(id_karyawan).css("color", "black");
        $("#tanggal_mulai_update").val(tanggal_mulai);
        $("#tanggal_selesai_update").val(tanggal_selesai);
        $("#status_pencapaian_update").val(status_pencapaian).css("color", "black");

        $("#update_pencapaian, .overlay").fadeIn();
    })
    $("#simpan_update_pencapaian").click(function () {
        $("#form_update_pencapaian").submit();
    })

        $(".hapus_penilaian").click(function () {
        var container = $(this).closest(".data_pencapaian");
        var id_pencapaian = container.find(".id_pencapaian").val();
        var nama_pencapaian = container.find(".nama_pencapaian").val();
        $("#id_pencapaian_hapus").val(id_pencapaian);
        $("#nama_pencapaian_hapus")
            .text("Yakin mau menghapus Pencapaian " + nama_pencapaian + " ?");
        $("#hapus_pencapaian_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_pencapaian").click(function () {
        $("#form_hapus_pencapaian").submit();
    })
})