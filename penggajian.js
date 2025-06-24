$(document).ready(function () {
    $("#ubah_struktur").click(function () {
        $("#update_struktur,.overlay").fadeIn();
    })
    $("#hapus_struktur").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_struktur").click(function () {
        $("#input_struktur,.overlay").fadeIn();
    })

    $("#ubah_rekening").click(function () {
        $("#update_rekening,.overlay").fadeIn();
    })
    $("#hapus_rekening").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_rekening").click(function () {
        $("#input_rekening,.overlay").fadeIn();
    })

    $("#ubah_kontrak").click(function () {
        $("#update_kontrak,.overlay").fadeIn();
    })
    $("#hapus_kontrak").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#new_kontrak").click(function () {
        $("#input_kontrak,.overlay").fadeIn();
    })
    $("#ubah_slip").click(function () {
        window.location.href = "update_slip.php"
    })
    $("#hapus_slip").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#simpan_perubahan_slip").click(function () {
        window.location.href = "slip_gaji.php"
    })
    $("#kembali_slip").click(function () {
        window.location.href = "slip_gaji.php"
    })
    $("#update_kalkulasi").show();
    $("#update_keterangan").show();

    $("#simpan_struktur_gaji").click(function () {
        $("#form_input_struktur_gaji").submit();
    })
    $("#simpan_rekening").click(function () {
        $("#form_input_rekening").submit();
    })
    $("#simpan_kontrak").click(function () {
        $("#form_input_kontrak").submit();
    })

    $('#id_karyawan').on('change', function () {
        var nama = $('#id_karyawan option:selected').data('nama-karyawan');
        $('#nama_karyawan').val(nama);
    })

    $("#confirm_slip").hide();
    $("#kembali_confirm").hide();
    $("#simpan_slip").hide();
    $("#kembali_save").hide();
    $("#generate_slip").click(function () {
        var jumlah = $("#satuan_interval").val();
        let karyawan = $("#karyawan_slip").val();
        if (jumlah === "" || isNaN(jumlah)) {
            alert("Masukkan jumlah gaji yang akan dibayar!");
            return;
        }
        if (!karyawan) {
            alert("Pilih karyawan terlebih dahulu!");
            return;
        }
        var nominal_gaji = $('#karyawan_slip option:selected').data('jumlah-gaji');
        var total_gaji = jumlah * nominal_gaji;
        let total_gaji_format = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total_gaji);
        $('#total_gaji').val(total_gaji_format + ",-");
        $('#total_gaji_raw').val(total_gaji);
        $("#generate_slip").hide();
        $("#confirm_slip").show();
        $("#kembali_confirm").show();
        $(".kalkulasi_pembayaran").show();
        $("#satuan_interval").prop("readonly", true);
    })

    $("#text_rekening").hide();
    $("#input_rekening").hide();
    $("#metode_bayar").change(function () {
        var nilai = $(this).val();
        if (nilai === "Transfer") {
            var rekening = $('#karyawan_slip option:selected').data('nomor-rekening');
            var bank = $('#karyawan_slip option:selected').data('nama-bank');
            var rekening_bank = rekening + " (" + bank + ")";
            $('#input_rekening').val(rekening_bank);
            $("#text_rekening").show();
            $("#input_rekening").show();
        } else {
            $("#text_rekening").hide();
            $("#input_rekening").hide();
        }
    })

    $("#kembali_confirm").click(function () {
        $("#kembali_confirm").hide();
        $("#confirm_slip").hide();
        $("#generate_slip").show();
        $(".kalkulasi_pembayaran").hide();
    })
    $("#confirm_slip").click(function () {
        var nilai = $("#metode_bayar").val();
        if (!nilai) {
            alert("Pilih metode bayar terlebih dahulu !")
            return;
        }
        $("#kembali_confirm").hide();
        $("#confirm_slip").hide();
        $("#generate_slip").hide();
        $(".keterangan_slip").show();
        $("#simpan_slip").show();
        $("#kembali_save").show();
    })
    $("#kembali_save").click(function () {
        $("#kembali_confirm").show();
        $("#confirm_slip").show();
        $("#generate_slip").hide();
        $(".keterangan_slip").hide();
        $("#simpan_slip").hide();
        $("#kembali_save").hide();
    })
    $("#keluar_slip").click(function () {
        window.location.href = "slip_gaji.php"
    })
    $("#simpan_slip").click(function () {
        var nilai = $("#status_pembayaran").val();
        if(!nilai){
            alert("Pilih Status Pembayaran !")
            return;
        }
        $("#form_input_slip").submit();
    })
    $('#karyawan_slip').on('change', function () {
        var nama_kontrak = $('#karyawan_slip option:selected').data('nama-kontrak');
        var nama_struktur = $('#karyawan_slip option:selected').data('nama-struktur');
        var nominal_gaji = $('#karyawan_slip option:selected').data('jumlah-gaji');
        var interval_gaji = $('#karyawan_slip option:selected').data('interval-gaji');
        let nominal_gaji_format = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(nominal_gaji);

        var hari_ini = new Date();
        var tanggal_format = hari_ini.getDate().toString().padStart(2, '0') + ' - ' +
            (hari_ini.getMonth() + 1).toString().padStart(2, '0') + ' - ' +
            hari_ini.getFullYear();

        var tahun = hari_ini.getFullYear();
        var bulan = String(hari_ini.getMonth() + 1).padStart(2, '0'); // bulan dari 0–11
        var tanggal = String(hari_ini.getDate()).padStart(2, '0');
        var tanggal_sql = `${tahun}-${bulan}-${tanggal}`;

        $('#tanggal_cetak').val(tanggal_format);
        $('#tanggal_sql').val(tanggal_sql);
        $('#kontrak_karyawan').val(nama_kontrak);
        $('#nama_struktur_gaji').val(nama_struktur);
        $('#nominal_gaji').val(nominal_gaji_format + ",-");
        $('#interval_gaji').text(interval_gaji);
    })
    $(".ubah_penggajian").click(function () {
        var container = $(this).closest(".data_slip");
        container.find(".update_slip").submit();
    })
})