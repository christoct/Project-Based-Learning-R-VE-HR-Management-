$(document).ready(function () {
    var username_login = $(".username_login").val();
    var id_login = $(".id_login").val();
    var foto_user = $("#foto_user").val();

    if (!foto_user || foto_user === "null" || foto_user === "undefined") {
        foto_user = "undifined_profil.png";
    }

    $(".user_info").text(id_login + " " + username_login);
    $(".profile").attr("src", "./uploads/foto_karyawan/" + foto_user).show();
});