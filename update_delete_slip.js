function formatRupiah(angka) {
    return angka.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
}
$(document).ready(function () {

    $("#metode_bayar_update").trigger("change");
    $("#nomor_rekening_update").hide();

    var id_slip_gaji_ambil = $("#id_slip_gaji_ambil").val();
    var id_karyawan_ambil = $("#id_karyawan_ambil").val();
    var nama_kontrak_ambil = $("#nama_kontrak_ambil").val();
    var nama_struktur_ambil = $("#nama_struktur_ambil").val();
    var jumlah_gaji_ambil = $("#jumlah_gaji_ambil").val();
    var interval_gaji_ambil = $("#interval_gaji_ambil").val();
    var metode_bayar_ambil = $("#metode_bayar_ambil").val();
    var status_pembayaran_ambil = $("#status_pembayaran_ambil").val();
    var total_gaji_ambil = $("#total_gaji_ambil").val();
    var nama_bank_ambil = $("#nama_bank_ambil").val();
    var nomor_rekening_ambil = $("#nomor_rekening_ambil").val();
    var tanggal_cetak_ambil = $("#tanggal_cetak_ambil").val();
    var jumlah_pembayaran_ambil = $("#jumlah_pembayaran_ambil").val();

    $("#id_slip_gaji_update").val(id_slip_gaji_ambil);
    $("#id_karyawan_update").val(id_karyawan_ambil).css("color", "black");
    $('#id_karyawan_update')
        .on('mousedown', function (e) {
            e.preventDefault();
        })
        .on('focus', function () {
            this.blur();
        });
    $("#nama_kontrak_update").val(nama_kontrak_ambil);
    $("#nama_struktur_update").val(nama_struktur_ambil);

    $("#jumlah_gaji_update").val(jumlah_gaji_ambil);
    var format_jumlah_gaji = formatRupiah(parseInt(jumlah_gaji_ambil));
    $('#jumlah_gaji_display').val(format_jumlah_gaji + ",-");

    $("#interval_gaji_update").text(interval_gaji_ambil);
    $("#metode_bayar_update").val(metode_bayar_ambil).css("color", "black");
    if(metode_bayar_ambil ==="Transfer"){
            $("#text_rekening").show();
            $("#nomor_rekening_update").show();
        }else{
            $("#text_rekening").hide();
            $("#nomor_rekening_update").hide();
        }
    $("#status_pembayaran_update").val(status_pembayaran_ambil).css("color", "black");

    var format_total_gaji = formatRupiah(parseInt(total_gaji_ambil));
    $("#total_gaji_update").val(total_gaji_ambil);
    $('#total_gaji_display').val(format_total_gaji + ",-");

    $("#nama_bank_update").val(nama_bank_ambil);
    $("#nomor_rekening_update").val(nomor_rekening_ambil);
    $("#jumlah_pembayaran_update").val(jumlah_pembayaran_ambil);

    var t = tanggal_cetak_ambil.split("-");
    var tanggal_format = `${t[2]} - ${t[1]} - ${t[0]}`;

    $("#tanggal_cetak_display").val(tanggal_format);
    $("#tanggal_cetak_update").val(tanggal_cetak_ambil);
    $("#id_update_display").text(id_slip_gaji_ambil);

    $("#simpan_update_slip").click(function () {
        $("#form_update_slip").submit();
    })
    $('#jumlah_pembayaran_update').on('input', function () {
        var jumlah = $(this).val();
        var gaji = $("#jumlah_gaji_update").val();
        var total_sekarang = jumlah * gaji;
        var format_total_sekarang = formatRupiah(parseInt(total_sekarang));
        $("#total_gaji_update").val(total_sekarang);
        $('#total_gaji_display').val(format_total_sekarang + ",-");
    });
    $("#metode_bayar_update").change(function(){
        var nilai = $(this).val();
        if(nilai ==="Transfer"){
            $("#text_rekening").show();
            $("#nomor_rekening_update").show();
        }else{
            $("#text_rekening").hide();
            $("#nomor_rekening_update").hide();
        }
    })
})
