$(document).ready(function () {
    $(".upload_container").hover(function () {
        $(".update_foto").toggle();
    })
    $("#save_karyawan").click(function () {
        document.getElementById('input_karyawan').requestSubmit();
    })
    $("#cancel_karyawan").click(function () {
        window.location.href = "pbl_profil_karyawan.php"
    })
    $("#save_pelamar").click(function () {
        $("#input_pelamar").submit();
    })
    $("#cancel_pelamar").click(function () {
        window.location.href = "pelamar.php"
    })
    $(".upload_container_cv").hover(function () {
        $(".update_cv").toggle();
    })
    $("#rupiah, #rupiah_update").on("input", function () {
        let value = $(this).val().replace(/[^\d]/g, '');
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
        $(this).val(formatted);
        $("#jumlah_gaji_raw").val(value);
    });


    $("#file_foto_karyawan, #file_profile_pelamar").change(function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#input_profil").attr("src", e.target.result);
                $("#input_profil").show();
                $("#camera").hide();
                $(".upload_container").css("padding", "0vw")
                $(".upload_container").css("height", "10vw")
                $(".upload_container").css("width", "10vw")
            }
            reader.readAsDataURL(file);
        }
    })

    $("#cv_pelamar").change(function (e) {
        var file = e.target.files[0];
        if (!file) return;
        var tipe = file.type;
        var nama = file.name.toLowerCase();
        var icon = "";
        if (nama.endsWith(".pdf")) {
            icon = "pdf.png";
        } else if (nama.endsWith(".docx")) {
            icon = "word.png";
        } else {
            alert("Hanya bisa upload tipe file PDF dxan Word");
            $(this).val("");
            return;
        }
        $("#icon_file").attr("src", icon);
        $(".nama_cv").text(file.name);
        $("#icon_file").show();
        $("#document").hide();
        $(".upload_container_cv").css("border", "none");
    })
})
