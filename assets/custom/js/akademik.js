$(document).ready(function() {
    $('#select_kelas').on('change', function() {
        let idKelas = $(this).val();
        let getSiswaUrl = $(this).data('url');

        if(idKelas) {
            $.ajax({
                url: getSiswaUrl,
                type: 'POST',
                data: { id_kelas: idKelas },
                dataType: 'json',
                success: function(data) {
                    $('#select_siswa').empty();
                    $('#select_siswa').append('<option value="">-- Pilih Siswa --</option>');
                    $.each(data, function(key, value) {
                        $('#select_siswa').append('<option value="'+ value.id_siswa +'">'+ value.nama_siswa +' ('+ value.nis +')</option>');
                    });
                }
            });
        } else {
            $('#select_siswa').empty();
            $('#select_siswa').append('<option value="">-- Pilih Siswa --</option>');
        }
    });

    $('#jenis_pendaftaran').on('change', function() {
        let jenis = $(this).val();
        if(jenis === 'Siswa Baru') {
            $('#form_siswa_baru').show();
            $('#form_mutasi_masuk').hide();
        } else if(jenis === 'Mutasi Masuk') {
            $('#form_siswa_baru').hide();
            $('#form_mutasi_masuk').show();
        } else {
            $('#form_siswa_baru').hide();
            $('#form_mutasi_masuk').hide();
        }
    });

    $('#pilih_riwayat').on('change', function() {
        let pilihan = $(this).val();
        if(pilihan === 'pendidikan') {
            $('#form_riwayat_pendidikan').show();
            $('#form_riwayat_pangkat').hide();
        } else if(pilihan === 'kepangkatan') {
            $('#form_riwayat_pendidikan').hide();
            $('#form_riwayat_pangkat').show();
        } else {
            $('#form_riwayat_pendidikan').hide();
            $('#form_riwayat_pangkat').hide();
        }
    });
});