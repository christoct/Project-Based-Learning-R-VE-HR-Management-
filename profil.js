$(document).ready(function () {
    $("#hapus_akun").click(function () {
        $("#hapus_akun_popup, .overlay").fadeIn();
    })

    var id_karyawan_ambil = $("#id_karyawan_ambil").val();
    var nama_karyawan_ambil = $("#nama_karyawan_ambil").val();
    var id_pekerjaan_ambil = $("#id_pekerjaan_ambil").val();
    var telepon_kerja_ambil = $("#telepon_kerja_ambil").val();
    var email_ambil = $("#email_ambil").val();
    var id_atasan_ambil = $("#id_atasan_ambil").val();
    var foto_karyawan_ambil = $("#foto_karyawan_ambil").val();
    var id_departemen_ambil = $("#id_departemen_ambil").val();
    var id_divisi_ambil = $("#id_divisi_ambil").val();
    var spesifikasi_kerja_ambil = $("#spesifikasi_kerja_ambil").val();

    var namaAtasan = $("#spesifikasi_kerja_update option").filter(function () {
        return $(this).data("id-penanggung") == id_atasan_ambil;
    }).data("nama-penanggung");

    $("#id_karyawan_update").val(id_karyawan_ambil);
    $("#id_karyawan_hapus").val(id_karyawan_ambil);
    $("#nama_pj_display").val(namaAtasan);
    $("#text_PN").val(id_atasan_ambil);
    $("#nama_karyawan_update").val(nama_karyawan_ambil);
    $("#id_pekerjaan_update").val(id_pekerjaan_ambil);
    $("#telepon_kerja_update").val(telepon_kerja_ambil);
    $("#email_update").val(email_ambil);
    $("#id_atasan_update").val(id_atasan_ambil);
    $("#spesifikasi_kerja_update").val(spesifikasi_kerja_ambil);
    $("#id_departemen_update").val(id_departemen_ambil);
    $("#id_divisi_update").val(id_divisi_ambil);
    $("#input_profil").attr("src", "./uploads/foto_karyawan/" + foto_karyawan_ambil).show();
    $("#camera").hide();
    $(".upload_container").css({ padding: "0vw", height: "10vw", width: "10vw", cursor: "default" });
    $(".body_skill").hover(
        function () {
            $(this).css({ cursor: "default", backgroundColor: "white" });
        });

    $("#nik_update").val($("#nik_diambil").val());
    $("#umur_update").val($("#umur_diambil").val());
    $("#email_pribadi_update").val($("#email_pribadi_diambil").val());
    $("#status_kawin_update").val($("#status_kawin_diambil").val()).css("color", "black");
    $("#jenis_kelamin_update").val($("#jenis_kelamin_diambil").val()).css("color", "black");
    $("#jumlah_anak_update").val($("#jumlah_anak_diambil").val());
    $("#alamat_update").val($("#alamat_diambil").val());
    $("#telepon_pribadi_update").val($("#telepon_pribadi_diambil").val());

    $("#confirm_hapus_akun").click(function () {
        $("#form_hapus_akun").submit();
    })
})