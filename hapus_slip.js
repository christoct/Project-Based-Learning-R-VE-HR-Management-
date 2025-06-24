$(document).ready(function(){
    
        $(".hapus_penggajian").click(function () {
        var container = $(this).closest(".data_slip");
        var id_slip_gaji = container.find(".id_slip_gaji").val();
        $("#id_slip_gaji_hapus").val(id_slip_gaji);
        $("#nama_slip_hapus")
            .text("Apakah Anda yakin mau menghapus data slip " + id_slip_gaji + " ?");
        $("#hapus_slip_popup,.overlay").fadeIn();
    })

    $("#confirm_hapus_slip").click(function () {
        $("#form_hapus_slip").submit();
    })
})