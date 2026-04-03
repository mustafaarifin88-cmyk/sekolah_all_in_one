<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #eab308 0%, #b45309 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(234, 179, 8, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .hover-lift { transition: transform 0.3s, box-shadow 0.3s; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Prestasi Siswa</h1>
        <p class="fs-5 opacity-75 mb-0">Kebanggaan dan pencapaian luar biasa siswa siswi kami.</p>
    </div>

    <div class="glass-card">
        <div class="row g-4">
            <?php if(isset($prestasi) && count($prestasi) > 0): ?>
                <?php foreach($prestasi as $p): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center p-4 rounded-4 border bg-white shadow-sm hover-lift">
                        <div class="bg-warning bg-opacity-25 text-warning rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 50px; height: 50px;">
                            <i class="fas fa-trophy fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark m-0 lh-base"><?= $p['nama_prestasi'] ?></h6>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-medal fs-1 text-muted mb-3 opacity-50"></i>
                    <h5 class="text-secondary fw-bold">Data prestasi belum tersedia.</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>