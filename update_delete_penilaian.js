$(document).ready(function () {
    $(".ubah_penilaian").click(function () {

        var container = $(this).closest(".data_penilaian");

        var id_penilaian = container.find(".id_penilaian").val();
        var id_karyawan = container.find(".id_karyawan").val();
        var id_penilai = container.find(".id_penilai").val();
        var tanggal_penilaian = container.find(".tanggal_penilaian").val();
        var id_akhir = container.find(".id_akhir").val();
        var status_penilaian = container.find(".status_penilaian").val();

        $("#id_penilaian_update").val(id_penilaian);
        $("#id_karyawan_update").val(id_karyawan).css("color", "black");
        $("#id_penilai_update").val(id_penilai).css("color", "black");
        $("#tanggal_penilaian_update").val(tanggal_penilaian);
        $("#id_akhir_update").val(id_akhir).css("color", "black");
        $("#status_penilaian_update").val(status_penilaian).css("color", "black");

        $("#update_penilaian, .overlay").fadeIn();
    })
    $("#simpan_update_penilaian").click(function () {
        $("#form_update_penilaian").submit();
    })

    $(".hapus_penilaian").click(function () {
        var container = $(this).closest(".data_penilaian");
        var id_penilaian = container.find(".id_penilaian").val();
        var nama_karyawan = container.find(".nama_karyawan").val();
        $("#id_penilaian_hapus").val(id_penilaian);
        $("#nama_penilaian_hapus")
            .text("Apakah Anda yakin mau menghapus Penilaian " + nama_karyawan + " ?");
        $("#hapus_penilaian_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_penilaian").click(function () {
        $("#form_hapus_penilaian").submit();
    })
})