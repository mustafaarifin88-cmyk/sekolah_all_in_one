<style>
    .modal-glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 30px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        overflow: hidden;
    }
    .modal-header-gradient {
        background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        padding: 25px 30px;
        border-bottom: none;
    }
    .input-glow {
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        padding: 15px 20px;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        font-size: 1.1rem;
    }
    .input-glow:focus {
        border-color: #4e54c8;
        box-shadow: 0 0 0 5px rgba(78, 84, 200, 0.15);
        outline: none;
        transform: translateY(-2px);
    }
    .input-icon-wrap {
        position: relative;
    }
    .input-icon-wrap i {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
        transition: color 0.3s;
    }
    .input-glow:focus + i, .input-icon-wrap:focus-within i {
        color: #4e54c8;
    }
    .input-glow.with-icon {
        padding-left: 55px;
    }
    .btn-gradient-submit {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        border-radius: 16px;
        padding: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: white;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .btn-gradient-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(0, 242, 254, 0.4);
    }
    .loader-pulse {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #4e54c8;
        margin: 0 auto;
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.8); box-shadow: 0 0 0 0 rgba(78, 84, 200, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 20px rgba(78, 84, 200, 0); }
        100% { transform: scale(0.8); box-shadow: 0 0 0 0 rgba(78, 84, 200, 0); }
    }
    .result-box {
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        animation: slideUp 0.5s ease;
    }
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="modal fade" id="modalKelulusan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-glass">
            <div class="modal-header modal-header-gradient">
                <h4 class="modal-title fw-bolder text-white"><i class="fas fa-fingerprint me-2"></i> Portal Kelulusan</h4>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-graduation-cap fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Verifikasi Data Siswa</h5>
                    <p class="text-secondary mb-0">Masukkan Nomor Ujian dan Tanggal Lahir untuk melihat hasil kelulusan.</p>
                </div>
                
                <form id="form-cek-kelulusan" action="<?= base_url('cek_kelulusan') ?>" method="post">
                    <div class="mb-4 input-icon-wrap">
                        <input type="text" class="form-control input-glow with-icon" name="no_ujian" placeholder="Nomor Ujian Peserta" required autocomplete="off">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="mb-5 input-icon-wrap">
                        <input type="date" class="form-control input-glow with-icon" name="tgl_lahir" required>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <button type="submit" class="btn btn-gradient-submit w-100">
                        PERIKSA HASIL <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </form>

                <div class="loader text-center py-4" style="display: none;">
                    <div class="loader-pulse mb-3"></div>
                    <h6 class="fw-bold text-primary animate__animated animate__pulse animate__infinite">Memproses Data...</h6>
                </div>

                <div class="result-container mt-4 result-box p-4" style="display: none;">
                    <div class="text-center border-bottom pb-3 mb-3">
                        <h6 class="text-uppercase fw-bold text-secondary mb-1">Hasil Keputusan</h6>
                        <div id="res_status" class="display-5 fw-black text-uppercase tracking-wider"></div>
                    </div>
                    <table class="table table-borderless text-dark mb-0 fs-6">
                        <tr><td class="text-muted w-25 pb-2"><i class="fas fa-user text-primary opacity-50 me-2"></i>Nama</td><td class="fw-bold pb-2" id="res_nama"></td></tr>
                        <tr><td class="text-muted w-25 pb-2"><i class="fas fa-hashtag text-primary opacity-50 me-2"></i>NISN</td><td class="fw-bold pb-2" id="res_nisn"></td></tr>
                        <tr><td class="text-muted w-25 pb-0"><i class="fas fa-map-marker-alt text-primary opacity-50 me-2"></i>TTL</td><td class="fw-bold pb-0" id="res_ttl"></td></tr>
                    </table>
                </div>
                
                <div id="error-message" class="alert alert-danger rounded-4 mt-4 border-0 shadow-sm d-flex align-items-center" style="display: none; background: #fff1f2; color: #e11d48;">
                    <i class="fas fa-exclamation-circle fs-3 me-3"></i>
                    <span id="error-text" class="fw-semibold"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('#form-cek-kelulusan').on('submit', function(e) {
        e.preventDefault();
        
        $('#form-cek-kelulusan').slideUp(300);
        $('.result-container, #error-message').hide();
        $('.loader').fadeIn(300);
        
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                setTimeout(function() {
                    $('.loader').hide();
                    
                    if (response.status === 'success') {
                        $('#res_nama').text(response.data.nama);
                        $('#res_nisn').text(response.data.nisn);
                        $('#res_ttl').text(response.data.tempat_lahir + ', ' + response.data.tanggal_lahir);
                        
                        let statusHtml = '';
                        if (response.data.status_kelulusan.toUpperCase() === 'LULUS') {
                            statusHtml = '<span class="text-success" style="text-shadow: 0 2px 10px rgba(34, 197, 94, 0.4);"><i class="fas fa-check-circle me-2"></i>LULUS</span>';
                        } else {
                            statusHtml = '<span class="text-danger" style="text-shadow: 0 2px 10px rgba(239, 68, 68, 0.4);"><i class="fas fa-times-circle me-2"></i>TIDAK LULUS</span>';
                        }
                        $('#res_status').html(statusHtml);
                        $('.result-container').fadeIn(400);
                    } else {
                        $('#error-text').text(response.message);
                        $('#error-message').fadeIn(400);
                        $('#form-cek-kelulusan').slideDown(300);
                    }
                }, 1500); 
            },
            error: function() {
                setTimeout(function() {
                    $('.loader').hide();
                    $('#error-text').text('Terjadi kesalahan koneksi ke server. Silakan coba lagi.');
                    $('#error-message').fadeIn(400);
                    $('#form-cek-kelulusan').slideDown(300);
                }, 1000);
            }
        });
    });

    $('#modalKelulusan').on('hidden.bs.modal', function () {
        $('#form-cek-kelulusan')[0].reset();
        $('#form-cek-kelulusan').show();
        $('.result-container, #error-message, .loader').hide();
    });
});
</script>