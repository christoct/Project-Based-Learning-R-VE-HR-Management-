$(document).ready(function () {
    $(".ubah_penggajian").click(function (){

        var container = $(this).closest(".data_rekening");

        var id_rekening = container.find(".id_rekening").val();
        var id_karyawan = container.find(".id_karyawan").val();
        var nama_bank = container.find(".nama_bank").val();
        var nomor_rekening = container.find(".nomor_rekening").val();

        $("#id_rekening_update").val(id_rekening);
        $("#id_karyawan_update").val(id_karyawan).css("color","black");
        $("#nama_bank_update").val(nama_bank).css("color","black");
        $("#nomor_rekening_update").val(nomor_rekening);

        $("#update_rekening, .overlay").fadeIn();
        $("#simpan_update_rekening").click(function () {
            $("#form_update_rekening").submit();
        })
    })

        $(".hapus_penggajian").click(function (){
        var container = $(this).closest(".data_rekening");
        var id_rekening = container.find(".id_rekening").val();
        var nomor_rekening = container.find(".nomor_rekening").val();
        $("#id_rekening_hapus").val(id_rekening);
        $("#nomor_rekening_hapus")
        .text("Apakah Anda yakin mau menghapus No.Rek "+nomor_rekening+" ?");
        $("#hapus_rekening_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_rekening").click(function (){
        $("#form_hapus_rekening").submit();
    })
})