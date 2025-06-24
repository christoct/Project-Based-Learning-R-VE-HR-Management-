$(document).ready(function () {
    var status = $(".lowongan_stat").text();
    if(status === "Aktif"){
        $(".lowongan_stat").addClass("lowongan_stat_aktif")
    }else if(status === "Non-Aktif"){
        $(".lowongan_stat").addClass("lowongan_stat_non")
    }
    $("#new_lowongan").click(function () {
        $("#tambah_lowongan, .overlay").fadeIn();
        $(".aktif").click();
    })
    $(".ubah_rekrutmen").click(function () {
        $("#update_lowongan, .overlay").fadeIn();
    })
    $(".hapus_rekrutmen").click(function () {
        $("#hapus_lowongan, .overlay").fadeIn();
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        $("#hapus_lowongan .popup_text").text("Yakin mau menghapus data "+nama+" ?");
        $("#id_dihapus").val(id);
    })
    $("#konfirmasi_hapus_lowongan").click(function(){
        $("#form_hapus_lowongan").submit();
    })
    $(".hapus_rekrutmen").click(function () {
        $("#hapus_pelamar, .overlay").fadeIn();
    })
    $("#ubah_pelamar").click(function () {
        window.location.href = "update_pelamar.php";
    })
    $(".data_stat").click(function () {
        $(".overlay,#update_status").fadeIn();
    })
    $("#hapus_status").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#simpan_status").click(function () {
    })
    $("#new_status").click(function () {
        $("#input_status,.overlay").fadeIn();
    })
    $("#simpan_input_lowongan").click(function () {
        $("#form_input_lowongan").submit();
    })
        $('#text_departemen').on('change', function () {
        var idDepartemen = $(this).val();
        $('#text_divisi option').each(function () {
            var option = $(this);
            var dataDepartemen = option.data('id-departemen');
            if (!dataDepartemen) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataDepartemen == idDepartemen) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })
    $('#text_divisi').on('change', function () {
        var idDivisi = $(this).val();
        $('#text_spec option').each(function () {
            var option = $(this);
            var dataDivisi = option.data('id-divisi');
            if (!dataDivisi) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataDivisi == idDivisi) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })
        $('#text_spec').on('change', function () {
        var idSpec = $(this).val();
        $('#nama_kerja option').each(function () {
            var option = $(this);
            var dataSpec = option.data('id-spec');
            if (!dataSpec) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataSpec == idSpec) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })
    $("#simpan_input_status_lamaran").click(function () {
        $("#form_input_status_lamaran").submit();
    })
    $("#save_pelamar").click(function () {
        $("#input_pelamar").submit();
    })
    $(".ubah_rekrutmen").click(function () {
        var container = $(this).closest(".data_pelamar");
        container.find(".update_pelamar").submit();
    })
})