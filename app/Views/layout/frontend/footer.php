<footer class="footer-modern text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Sistem Informasi Sekolah</h5>
                <p class="text-light opacity-75">Memberikan layanan informasi terpadu, modern, dan transparan untuk seluruh civitas akademika.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Tautan Penting</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none opacity-75">Profil Sekolah</a></li>
                    <li><a href="<?= base_url('berita') ?>" class="text-light text-decoration-none opacity-75">Berita & Artikel</a></li>
                    <li><a href="<?= base_url('pengumuman') ?>" class="text-light text-decoration-none opacity-75">Pengumuman</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Kontak</h5>
                <p class="text-light opacity-75 mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 1, Kota</p>
                <p class="text-light opacity-75 mb-1"><i class="fas fa-phone me-2"></i> (021) 1234567</p>
                <p class="text-light opacity-75"><i class="fas fa-envelope me-2"></i> info@sekolah.sch.id</p>
            </div>
        </div>
        <hr class="border-light opacity-25">
        <div class="text-center opacity-75">
            <small>&copy; <?= date('Y') ?> Sistem Informasi Sekolah. All rights reserved.</small>
        </div>
    </div>
</footer>

<div class="modal fade" id="modalKelulusan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 glass-card-dark text-white">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Cek Status Kelulusan</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-cek-kelulusan" action="<?= base_url('cek_kelulusan') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label opacity-75">Nomor Ujian</label>
                        <input type="text" class="form-control form-control-lg rounded-pill bg-white bg-opacity-10 text-white border-0 shadow-none" id="no_ujian" name="no_ujian" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label opacity-75">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-lg rounded-pill bg-white bg-opacity-10 text-white border-0 shadow-none" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <button type="submit" class="btn btn-light w-100 rounded-pill fw-bold text-primary py-2 shadow-sm">Cek Sekarang</button>
                </form>
                <div class="loader mt-3 text-center" style="display: none;">
                    <div class="spinner-border text-light" role="status"></div>
                </div>
                <div class="result-container mt-4 p-3 rounded-4 bg-white bg-opacity-10" style="display: none;">
                    <table class="table table-borderless text-white mb-0">
                        <tr><th class="ps-0">Nama</th><td id="res_nama"></td></tr>
                        <tr><th class="ps-0">NISN</th><td id="res_nisn"></td></tr>
                        <tr><th class="ps-0">TTL</th><td id="res_ttl"></td></tr>
                        <tr><th class="ps-0">Status</th><td id="res_status" class="fw-bold fs-5"></td></tr>
                    </table>
                </div>
                <div id="error-message" class="alert alert-danger rounded-4 mt-3 border-0" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/custom/js/frontend.js') ?>"></script>
<script src="<?= base_url('assets/custom/js/kelulusan.js') ?>"></script>