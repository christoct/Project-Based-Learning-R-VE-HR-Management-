$(document).ready(function () {
    $("#baris_departemen").hide();
    $("#baris_divisi").hide();
    $("#baris_spec").hide();
    $("#pilih_posisi").change(function () {
        var selected = $(this).val();
        if (selected === "Staff") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").show();
        } else if (selected === "Supervisor") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").show();
        } else if (selected === "Manager") {
            $("#baris_departemen").show();
            $("#baris_divisi").show();
            $("#baris_spec").hide();
        }else if (selected === "Direktur") {
            $("#baris_departemen").show();
            $("#baris_divisi").hide();
            $("#baris_spec").hide();
        }
    })
})