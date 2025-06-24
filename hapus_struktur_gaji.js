$(document).ready(function(){
        $(".hapus_penggajian").click(function () {

        var container = $(this).closest(".data_struktur_gaji");

        var id_struktur_gaji = container.find(".id_struktur_gaji").val();
        var nama_struktur = container.find(".nama_struktur").val();

        $("#id_struktur_gaji_hapus").val(id_struktur_gaji);
        $("#nama_struktur_hapus")
        .text("Apakah Anda yakin mau menghapus data Spesifikasi "+nama_struktur+" ?");
        $("#hapus_struktur_gaji,.overlay").fadeIn();
    })

    $("#confirm_hapus_struktur_gaji").click(function () {
        $("#form_hapus_struktur_gaji").submit();
    })
})