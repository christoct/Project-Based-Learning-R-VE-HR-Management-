$(document).ready(function () {
    $(".upload_container").hover(function () {
        $(".update_foto").toggle();
    })
    $("#save_karyawan").click(function () {
        document.getElementById('input_karyawan').requestSubmit();
    })
    $("#cancel_karyawan").click(function () {
        window.location.href = "pbl_profil_karyawan.html"
    })
    $("#save_pelamar").click(function () {
        $("#input_pelamar").submit();
    })
    $("#cancel_pelamar").click(function () {
        window.location.href = "pelamar.html"
    })
    $(".upload_container_cv").hover(function () {
        $(".update_cv").toggle();
    })
    $("#rupiah").on("input", function () {
        let value = $(this).val().replace(/[^\d]/g, '');
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
        $(this).val(formatted);
    });
    $("#confirm_slip").hide();
    $("#kembali_confirm").hide();
    $("#save_slip").hide();
    $("#kembali_save").hide();
    $("#generate_slip").click(function () {
        $("#generate_slip").hide();
        $("#confirm_slip").show();
        $("#kembali_confirm").show();
        $(".kalkulasi_pembayaran").show();
    })
    $("#kembali_confirm").click(function () {
        $("#kembali_confirm").hide();
        $("#confirm_slip").hide();
        $("#generate_slip").show();
        $(".kalkulasi_pembayaran").hide();
    })
    $("#confirm_slip").click(function () {
        $("#kembali_confirm").hide();
        $("#confirm_slip").hide();
        $("#generate_slip").hide();
        $(".keterangan_slip").show();
        $("#save_slip").show();
        $("#kembali_save").show();
    })
    $("#save_slip").click(function () {
        window.location.href = "slip_gaji.html"
    })
    $("#kembali_save").click(function () {
        $("#kembali_confirm").show();
        $("#confirm_slip").show();
        $("#generate_slip").hide();
        $(".keterangan_slip").hide();
        $("#save_slip").hide();
        $("#kembali_save").hide();
    })
    $("#keluar_slip").click(function () {
        window.location.href = "slip_gaji.html"
    })


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
        $(".upload_container_cv").css("border","none");
    })
})
