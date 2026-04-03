<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<div class="bg-gradient-animated py-5 position-relative overflow-hidden" style="margin-top: -70px; padding-top: 120px !important;">
    <div class="container position-relative z-1 text-center text-white py-5">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 shadow-sm fw-bold">Berita & Artikel</span>
        <h1 class="fw-bold display-5 mb-3 mx-auto" style="max-width: 800px;"><?= $berita['judul_berita'] ?? 'Judul Berita' ?></h1>
        <div class="d-flex justify-content-center align-items-center opacity-75 fs-6">
            <i class="far fa-calendar-alt me-2"></i> <?= isset($berita['tanggal_publish']) ? date('d F Y', strtotime($berita['tanggal_publish'])) : date('d F Y') ?>
        </div>
    </div>
</div>

<div class="container my-5" style="margin-top: -50px !important; position: relative; z-index: 2;">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <?php if(isset($berita['thumbnail']) && $berita['thumbnail'] != ''): ?>
                    <img src="<?= base_url('uploads/berita/' . $berita['thumbnail']) ?>" class="img-fluid w-100 object-fit-cover" style="max-height: 500px;" alt="Thumbnail">
                <?php endif; ?>
                <div class="card-body p-5 bg-white">
                    <div class="berita-content text-dark lh-lg fs-5 text-justify" style="color: #4a5568 !important;">
                        <?= $berita['isi_berita'] ?? '<p>Konten tidak tersedia.</p>' ?>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                        <a href="<?= base_url('berita') ?>" class="btn btn-light rounded-pill px-4 text-primary fw-bold shadow-sm hover-lift"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                        <div class="d-flex gap-2">
                            <span class="text-muted fw-semibold align-self-center me-2">Bagikan:</span>
                            <a href="#" class="btn btn-primary rounded-circle btn-sm shadow-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-info text-white rounded-circle btn-sm shadow-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-success rounded-circle btn-sm shadow-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .berita-content img, .berita-content iframe { max-width: 100%; border-radius: 12px; height: auto; margin: 20px 0; }
    .hover-lift { transition: transform 0.2s; }
    .hover-lift:hover { transform: translateY(-3px); }
</style>
<?= $this->endSection() ?>