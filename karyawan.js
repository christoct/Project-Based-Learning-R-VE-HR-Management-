$(document).ready(function () {
    $("#ubah_profil").click(function () {
        window.location.href = "update_karyawan.php";
    })
    $("#hapus_profil").click(function () {
    if ($("#hapus_popup").length) {
        $("#hapus_popup,.overlay").fadeIn();
    }
});
    $("#new_departemen").click(function () {
        $("#input_departemen,.overlay").fadeIn();
    })
    $("#ubah_departemen").click(function () {
        $("#update_departemen,.overlay").fadeIn();
    })
    $("#hapus_divisi").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#ubah_divisi").click(function () {
        $("#update_divisi,.overlay").fadeIn();
    })
    $("#new_divisi").click(function () {
        $("#input_divisi,.overlay").fadeIn();
    })
    $("#hapus_spec").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $("#ubah_spec").click(function () {
        $("#update_spec,.overlay").fadeIn();
    })
    $("#new_spesifikasi").click(function () {
        $("#input_spec,.overlay").fadeIn();
    })
    $("#hapus_pekerjaan").click(function () {
        $("#hapus_popup,.overlay").fadeIn();
    })
    $(".data_skill").click(function () {
        $("#update_skill,.overlay").fadeIn();
    })
    $(".heading_skill").click(function () {
        $("#update_bidang,.overlay").fadeIn();
    })
    $(".x_bidang").click(function () {
        $("#update_bidang,.overlay").fadeOut();
    })
    $("#hapus_jenis").click(function () {
        $("#hapus_kemampuan_popup,.overlay").fadeIn();
    })
    $("#hapus_bidang").click(function () {
        $("#hapus_bidang_popup,.overlay").fadeIn();
        $("#update_bidang").fadeOut();
    })
    $("#simpan_input_departemen").click(function () {
        $("#form_input_departemen").submit();
    })
    $("#simpan_input_divisi").click(function () {
        $("#form_input_divisi").submit();
    })
    $("#simpan_input_spec").click(function () {
        $("#form_input_spec").submit();
    })
    $("#baris_divisi").hide();
    $('#departemen_pilih').on('change', function () {
        var idDepartemen = $(this).val();
        $('#divisi_dipilih option').each(function () {
            var option = $(this);
            var dataDepartemen = option.data('id-departemen');

            if (!dataDepartemen) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataDepartemen == idDepartemen) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
            $("#baris_divisi").show();
        })
    })

    $('#text_departemen').on('change', function () {
        var idDepartemen = $(this).val();
        $('#text_divisi option').each(function () {
            var option = $(this);
            var dataDepartemen = option.data('id-departemen');
            if (!dataDepartemen) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataDepartemen == idDepartemen) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })
    $('#text_divisi').on('change', function () {
        var idDivisi = $(this).val();
        $('#text_spec option').each(function () {
            var option = $(this);
            var dataDivisi = option.data('id-divisi');
            if (!dataDivisi) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataDivisi == idDivisi) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })
    $('#bidang_kemampuan_popup').on('change', function () {
        var idBidang = $(this).val();
        $('#jenis_kemampuan_popup option').each(function () {
            var option = $(this);
            var dataBidang = option.data('id-bidang');
            if (!dataBidang) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataBidang == idBidang) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
        $('#jenis_kemampuan_popup').css("color","grey");
    })

    $('#text_spec').on('change', function () {
        var namaPJ = $('#text_spec option:selected').data('nama-penanggung');
        var idPJ = $('#text_spec option:selected').data('id-penanggung');

        $('#nama_pj_display').val(namaPJ);

        $('#text_PN').val(idPJ);

        $("#nama_kerja").prop("disabled", false);
        var idSpec = $(this).val();

        $('#nama_kerja option').each(function () {
            var option = $(this);
            var dataSpec = option.data('id-spec');
            if (!dataSpec) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataSpec == idSpec) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        })
    })

    $("#simpan_bidang").click(function () {
        $("#form_input_bidang").submit();
    })
    $("#simpan_jenis").click(function () {
        $("#form_input_skill").submit();
    })

    let kemampuanList = [];

    $('#simpan_skill').on('click', function () {

        var bidangVal = $('#bidang_kemampuan_popup').val();
        var jenisVal = $('#jenis_kemampuan_popup').val();
        var tingkatVal = $('#tingkat_kemampuan_popup').val();

        var bidangText = $('#bidang_kemampuan_popup option:selected').text();
        var jenisText = $('#jenis_kemampuan_popup option:selected').text();
        var tingkatText = $('#tingkat_kemampuan_popup option:selected').text();

        if (!bidangVal || !jenisVal || !tingkatVal) {
            alert('Silakan lengkapi semua pilihan');
            return;
        }

        kemampuanList.push([bidangVal, jenisVal, tingkatVal]);

        var row = '<tr class="body_skill">' +
            '<td class="data_skill">' + bidangText + '</td>' +
            '<td class="data_skill">' + jenisText + '</td>' +
            '<td class="data_skill">' + tingkatText + '</td>' +
            '</tr>';
        $('.table_skill:last').append(row);

        var stringData = '';
        for (var i = 0; i < kemampuanList.length; i++) {
            stringData += kemampuanList[i].join('|') + ';';
        }
        $('#daftar_kemampuan').val(stringData);
        $('#bidang_kemampuan_popup').val('').css("color", "grey");
        $('#jenis_kemampuan_popup').val('').css("color", "grey");
        $('#tingkat_kemampuan_popup').val('').css("color", "grey");
    })
    $(".ubah_karyawan").click(function () {
        var container = $(this).closest(".data_karyawan");
        container.find(".update_karyawan").submit();
    })

    $(document).on("click", ".body_skill", function () {
        var index = $(this).index() - 1;
        var data = kemampuanList[index];

        if (data) {
            $('#edit_skill #bidang_kemampuan_update').val(data[0]);
            $('#edit_skill #bidang_kemampuan_update').trigger('change');
            $('#edit_skill #jenis_kemampuan_update').trigger('change');
            $('#edit_skill #tingkat_kemampuan_update').trigger('change');
            setTimeout(function () {
                $('#edit_skill #jenis_kemampuan_update').val(data[1]);
            }, 100);

            $('#edit_skill #tingkat_kemampuan_update').val(data[2]);

            $('#edit_skill').data('index', index);

            $(".overlay, #edit_skill").fadeIn();
        }
    });

    $("#edit_skill .save").click(function () {
        var index = $('#edit_skill').data('index');

        var bidangVal = $('#bidang_kemampuan_update').val();
        var jenisVal = $('#jenis_kemampuan_update').val();
        var tingkatVal = $('#tingkat_kemampuan_update').val();

        var bidangText = $('#bidang_kemampuan_update option:selected').text();
        var jenisText = $('#jenis_kemampuan_update option:selected').text();
        var tingkatText = $('#tingkat_kemampuan_update option:selected').text();

        if (!bidangVal || !jenisVal || !tingkatVal) {
            alert('Silakan lengkapi semua pilihan');
            return;
        }
        kemampuanList[index] = [bidangVal, jenisVal, tingkatVal];

        var row = $('.table_skill tr.body_skill').eq(index);
        row.find('td').eq(0).text(bidangText);
        row.find('td').eq(1).text(jenisText);
        row.find('td').eq(2).text(tingkatText);
        var stringData = '';
        for (var i = 0; i < kemampuanList.length; i++) {
            stringData += kemampuanList[i].join('|') + ';';
        }
        $('#daftar_kemampuan').val(stringData);

        $('#edit_skill, .overlay').fadeOut();
    });

    $("#hapus_kemampuan").click(function () {
        var index = $('#edit_skill').data('index');

        kemampuanList.splice(index, 1);

        $('.table_skill tr.body_skill').eq(index).remove();

        var stringData = '';
        for (var i = 0; i < kemampuanList.length; i++) {
            stringData += kemampuanList[i].join('|') + ';';
        }
        $('#daftar_kemampuan').val(stringData);
        $('#edit_skill, .overlay').fadeOut();
    });

    $('#bidang_kemampuan_update').on('change', function () {
        var idBidang = $(this).val();
        $('#jenis_kemampuan_update option').each(function () {
            var option = $(this);
            var dataBidang = option.data('id-bidang');
            if (!dataBidang) {
                option.prop('hidden', false);
                option.prop('selected', true);
            } else if (dataBidang == idBidang) {
                option.prop('hidden', false);
            } else {
                option.prop('hidden', true);
            }
        });
        $('#jenis_kemampuan_update').css("color","grey");
    });

    $(".data_desc").click(function () {
        var container = $(this).closest(".data_desc");
        container.find(".update_deskripsi").submit();
    })

});