$(document).ready(function(){
    $("#new_penilaian").click(function(){
        $("#input_penilaian,.overlay").fadeIn();
    })
    $("#ubah_penilaian").click(function(){
        $("#update_penilaian,.overlay").fadeIn();
    })
    $("#hapus_penilaian").click(function(){
        $("#hapus_popup,.overlay").fadeIn();
    })

    $("#new_pencapaian").click(function(){
        $("#input_pencapaian,.overlay").fadeIn();
    })
    $("#ubah_pencapaian").click(function(){
        $("#update_pencapaian,.overlay").fadeIn();
    })
    $("#hapus_pencapaian").click(function(){
        $("#hapus_popup,.overlay").fadeIn();
    })

    $("#new_nilai").click(function(){
        $("#input_nilai,.overlay").fadeIn();
    })
    $(".data_nilai").click(function(){
        $("#update_nilai,.overlay").fadeIn();
    })
    $("#hapus_nilai").click(function(){
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#simpan_nilai_akhir").click(function(){
        $("#form_input_nilai_akhir").submit();
    })
    $("#simpan_penilaian").click(function(){
        $("#form_input_penilaian").submit();
    })
    $('#pilih_karyawan').on('change', function () {
        var nama = $('#pilih_karyawan option:selected').data('nama-karyawan');
        $('#nama_karyawan').val(nama);
    })
    $('#pilih_penilai').on('change', function () {
        var nama = $('#pilih_penilai option:selected').data('nama-penilai');
        $('#nama_penilai').val(nama);
    })
    $("#simpan_pencapaian").click(function(){
        $("#form_input_pencapaian").submit();
    })
})