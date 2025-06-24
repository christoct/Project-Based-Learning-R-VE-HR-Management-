function tampilkanIconCV(fileName) {
    var ext = fileName.split('.').pop().toLowerCase();
    var iconPath = "";

    if (ext === "pdf") {
        iconPath = "pdf.png"; 
    } else if (ext === "doc" || ext === "docx") {
        iconPath = "word.png"; 
    } else {
        iconPath = "icon/file.png"; 
    }

    $("#icon_file").attr("src", iconPath).show();
    $(".nama_cv").text(fileName);
}

$(document).ready(function () {

    var id_pelamar_ambil = $("#id_pelamar_ambil").val();
    var nama_pelamar_ambil = $("#nama_pelamar_ambil").val();
    var id_lowongan_ambil = $("#id_lowongan_ambil").val();
    var no_telp_ambil = $("#no_telp_ambil").val();
    var id_rekruiter_ambil = $("#id_rekruiter_ambil").val();
    var id_status_lamaran_ambil = $("#id_status_lamaran_ambil").val();
    var alamat_email_ambil = $("#alamat_email_ambil").val();
    var id_interviewer_ambil = $("#id_interviewer_ambil").val();
    var profile_linkedln_ambil = $("#profile_linkedln_ambil").val();
    var foto_profile_ambil = $("#foto_profile_ambil").val();
    var file_cv_ambil = $("#file_cv_ambil").val();

    $("#id_pelamar_update").val(id_pelamar_ambil);
    $("#nama_pelamar_update").val(nama_pelamar_ambil);
    $("#id_lowongan_update").val(id_lowongan_ambil).css("color", "black");
    $("#no_telp_update").val(no_telp_ambil);
    $("#id_rekruiter_update").val(id_rekruiter_ambil).css("color", "black");
    $("#id_status_lamaran_update").val(id_status_lamaran_ambil).css("color", "black");
    $("#alamat_email_update").val(alamat_email_ambil);
    $("#id_interviewer_update").val(id_interviewer_ambil).css("color", "black");
    $("#profile_linkedln_update").val(profile_linkedln_ambil);
    $("#file_cv_update").val(file_cv_ambil);
    $("#input_profil").attr("src", "./uploads/profil_pelamar/" + foto_profile_ambil).show();
    console.log(foto_profile_ambil)
    $("#camera").hide();
    $(".upload_container").css({ padding: "0vw", height: "10vw", width: "10vw" });
    $(".upload_container_cv").css({ padding: "0vw", height: "10vw", width: "10vw", border: "none" });
    $("#gambar_doc").hide();
    $(".nama_cv").text(file_cv_ambil);
    tampilkanIconCV(file_cv_ambil);

    $("#simpan_update_pelamar").click(function () {
        $("#form_update_pelamar").submit();
    })

    $("#foto_profile_update").change(function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#input_profil").attr("src", e.target.result).show();
                $("#camera").hide();
                $(".upload_container").css({ padding: "0vw", height: "10vw", width: "10vw" });
            };
            reader.readAsDataURL(file);
        }
    });

})