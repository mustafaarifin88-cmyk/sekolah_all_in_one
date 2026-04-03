$(document).ready(function() {
    $('#form-cek-kelulusan').on('submit', function(e) {
        e.preventDefault();
        let noUjian = $('#no_ujian').val();
        let tglLahir = $('#tgl_lahir').val();
        let actionUrl = $(this).attr('action');

        $('.loader').show();
        $('.result-container').hide();
        $('#error-message').hide();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: {
                no_ujian: noUjian,
                tgl_lahir: tglLahir
            },
            dataType: 'json',
            success: function(response) {
                $('.loader').hide();
                if(response.status === 'success') {
                    $('.result-container').show();
                    $('#res_nama').text(response.data.nama);
                    $('#res_nisn').text(response.data.nisn);
                    $('#res_ttl').text(response.data.tempat_lahir + ', ' + response.data.tanggal_lahir);
                    $('#res_kelas').text(response.data.kelas);
                    
                    let statusText = response.data.status_kelulusan;
                    let statusClass = (statusText === 'LULUS') ? 'status-lulus' : 'status-tidak-lulus';
                    $('#res_status').html('<div class="' + statusClass + '">' + statusText + '</div>');
                } else {
                    $('#error-message').html(response.message).show();
                }
            },
            error: function() {
                $('.loader').hide();
                $('#error-message').html('Terjadi kesalahan koneksi ke server. Silakan coba lagi.').show();
            }
        });
    });

    $('#modalKelulusan').on('hidden.bs.modal', function () {
        $('#form-cek-kelulusan')[0].reset();
        $('.result-container').hide();
        $('#error-message').hide();
    });
});