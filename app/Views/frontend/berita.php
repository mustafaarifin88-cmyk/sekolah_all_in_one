<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<?php helper('text'); ?>
<div class="bg-gradient-animated py-5 position-relative overflow-hidden" style="margin-top: -70px; padding-top: 100px !important;">
    <div class="container position-relative z-1 py-4 text-center text-white">
        <h1 class="fw-bold display-5 mb-3">Berita & Artikel</h1>
        <p class="fs-5 opacity-75">Kumpulan informasi, berita, dan kegiatan terbaru dari sekolah kami.</p>
    </div>
</div>

<div class="container my-5 position-relative z-2" style="margin-top: -40px !important;">
    <div class="row g-4">
        <?php if(isset($berita) && count($berita) > 0): ?>
            <?php foreach($berita as $b): ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden news-card hover-lift bg-white">
                    <div class="position-relative">
                        <img src="<?= base_url('uploads/berita/' . $b['thumbnail']) ?>" class="card-img-top news-img object-fit-cover" alt="Berita" style="height: 220px;">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white px-3 py-1 rounded-tr-3 fw-semibold text-sm shadow-sm">
                            <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($b['tanggal_publish'])) ?>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-dark mb-3 line-clamp-2"><?= $b['judul_berita'] ?></h5>
                        <p class="card-text text-secondary mb-4 line-clamp-3">
                            <?= strip_tags(word_limiter($b['isi_berita'], 20)) ?>
                        </p>
                        <a href="<?= base_url('berita/detail/' . $b['id_berita']) ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold w-100 hover-lift">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="col-12 mt-5">
                <div class="d-flex justify-content-center custom-pagination">
                    <?= $pager->links('default', 'default_full') ?? $pager->links() ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center p-5 bg-white rounded-4 shadow-sm text-muted">
                    <i class="fas fa-newspaper fs-1 mb-3 text-light"></i>
                    <h4>Belum ada berita yang diterbitkan.</h4>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .rounded-tr-3 { border-top-right-radius: 1rem; }
    
    /* Pagination Styling */
    .custom-pagination nav { width: 100%; display: flex; justify-content: center; }
    .custom-pagination .pagination { margin-bottom: 0; gap: 8px; }
    .custom-pagination .page-item .page-link { border: none; color: #4e54c8; border-radius: 50% !important; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-weight: 600; box-shadow: 0 2px 10px rgba(0,0,0,0.05); background: white; transition: 0.3s; }
    .custom-pagination .page-item .page-link:hover { background: #f8fafc; color: #1e3c72; transform: translateY(-2px); }
    .custom-pagination .page-item.active .page-link { background: linear-gradient(-45deg, #4e54c8, #8f94fb); color: white; box-shadow: 0 5px 15px rgba(78, 84, 200, 0.4); }
</style>
<?= $this->endSection() ?>