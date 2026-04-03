<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-0 px-4 text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                    <i class="fas fa-paint-roller fs-2"></i>
                </div>
                <h4 class="fw-bold text-dark m-0">Pengaturan Tema Website</h4>
                <p class="text-muted text-sm mt-2">Pilih warna gradasi utama untuk tampilan depan (Frontend) website sekolah Anda.</p>
            </div>
            <div class="card-body p-5 pt-3">
                <form action="<?= base_url('admin/aplikasi/update_tema') ?>" method="post">
                    <div class="row g-3 justify-content-center mt-3">
                        
                        <div class="col-md-4 col-6 text-center">
                            <label class="w-100 cursor-pointer">
                                <input type="radio" name="tema_header" value="theme-blue" class="d-none theme-selector" <?= (isset($tema['tema_header']) && $tema['tema_header'] == 'theme-blue') ? 'checked' : '' ?>>
                                <div class="theme-card rounded-4 p-3 border shadow-sm transition-all mb-2" style="background: linear-gradient(-45deg, #1e3c72, #2a5298); height: 80px;"></div>
                                <span class="fw-bold text-dark">Ocean Blue</span>
                            </label>
                        </div>
                        
                        <div class="col-md-4 col-6 text-center">
                            <label class="w-100 cursor-pointer">
                                <input type="radio" name="tema_header" value="theme-green" class="d-none theme-selector" <?= (isset($tema['tema_header']) && $tema['tema_header'] == 'theme-green') ? 'checked' : '' ?>>
                                <div class="theme-card rounded-4 p-3 border shadow-sm transition-all mb-2" style="background: linear-gradient(-45deg, #11998e, #38ef7d); height: 80px;"></div>
                                <span class="fw-bold text-dark">Nature Green</span>
                            </label>
                        </div>
                        
                        <div class="col-md-4 col-6 text-center">
                            <label class="w-100 cursor-pointer">
                                <input type="radio" name="tema_header" value="theme-purple" class="d-none theme-selector" <?= (isset($tema['tema_header']) && $tema['tema_header'] == 'theme-purple') ? 'checked' : '' ?>>
                                <div class="theme-card rounded-4 p-3 border shadow-sm transition-all mb-2" style="background: linear-gradient(-45deg, #6a11cb, #2575fc); height: 80px;"></div>
                                <span class="fw-bold text-dark">Royal Purple</span>
                            </label>
                        </div>

                        <div class="col-md-4 col-6 text-center mt-4">
                            <label class="w-100 cursor-pointer">
                                <input type="radio" name="tema_header" value="theme-red" class="d-none theme-selector" <?= (isset($tema['tema_header']) && $tema['tema_header'] == 'theme-red') ? 'checked' : '' ?>>
                                <div class="theme-card rounded-4 p-3 border shadow-sm transition-all mb-2" style="background: linear-gradient(-45deg, #FF416C, #FF4B2B); height: 80px;"></div>
                                <span class="fw-bold text-dark">Crimson Red</span>
                            </label>
                        </div>
                        
                        <div class="col-md-4 col-6 text-center mt-4">
                            <label class="w-100 cursor-pointer">
                                <input type="radio" name="tema_header" value="theme-dark" class="d-none theme-selector" <?= (isset($tema['tema_header']) && $tema['tema_header'] == 'theme-dark') ? 'checked' : '' ?>>
                                <div class="theme-card rounded-4 p-3 border shadow-sm transition-all mb-2" style="background: linear-gradient(-45deg, #232526, #414345); height: 80px;"></div>
                                <span class="fw-bold text-dark">Elegant Dark</span>
                            </label>
                        </div>

                    </div>
                    
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm bg-gradient-animated border-0 hover-lift w-100"><i class="fas fa-check-circle me-2"></i> TERAPKAN TEMA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.3s ease; }
    .theme-selector:checked + .theme-card { transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important; border: 3px solid #ffffff !important; outline: 3px solid #007bff; }
    .theme-selector:not(:checked) + .theme-card { opacity: 0.6; }
    .theme-selector:not(:checked):hover + .theme-card { opacity: 0.9; transform: scale(1.02); }
</style>
<?= $this->endSection() ?>