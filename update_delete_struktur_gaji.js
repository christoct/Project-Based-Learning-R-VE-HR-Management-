function formatRupiah(angka) {
    if (!angka) return "Rp 0";
    angka = angka.toString().replace(/[^0-9]/g, "");
    if (angka === "") angka = "0";
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}

$(document).ready(function () {
    $(".ubah_penggajian").click(function () {
        var container = $(this).closest(".data_struktur_gaji");

        var id_struktur_gaji = container.find(".id_struktur_gaji").val();
        var nama_struktur = container.find(".nama_struktur").val();
        var jam_kerja = container.find(".jam_kerja").val();
        var jumlah_gaji = container.find(".jumlah_gaji").val();
        var interval_gaji = container.find(".interval_gaji").val();

        $("#interval_gaji_update").val(interval_gaji).css("color", "black");
        $("#id_struktur_gaji_update").val(id_struktur_gaji);
        $("#nama_struktur_update").val(nama_struktur);
        $("#jam_kerja_update").val(jam_kerja);
        $("#jumlah_gaji_update").val(formatRupiah(jumlah_gaji));
        $("#jumlah_gaji_raw_update").val(jumlah_gaji); 

        $("#update_struktur, .overlay").fadeIn();

    });

    $("#jumlah_gaji_update").on("blur", function () {
        var nilaiInput = $(this).val();
        var angkaBersih = nilaiInput.replace(/[^0-9]/g, "");
        if (angkaBersih === "") angkaBersih = "0";

        $(this).val(formatRupiah(angkaBersih));
        $("#jumlah_gaji_raw_update").val(angkaBersih);
    });
    $("#simpan_update_struktur_gaji").click(function () {
        $("#jumlah_gaji_update").trigger("blur"); 
        $("#form_update_struktur_gaji").submit();
    });

});
