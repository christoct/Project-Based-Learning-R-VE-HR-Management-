$(document).ready(function(){

    $(".hapus_rekrutmen").click(function () {
        var container = $(this).closest(".data_pelamar");
        var id_pelamar = container.find(".id_pelamar").val();
        var nama_pelamar = container.find(".nama_pelamar").val();
        $("#id_pelamar_hapus").val(id_pelamar);
        $("#nama_pelamar_hapus")
            .text("Apakah Anda yakin mau menghapus data pelamar " + nama_pelamar + " ?");
            
        $("#hapus_pelamar_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_pelamar").click(function () {
        $("#form_hapus_pelamar").submit();
    })
})