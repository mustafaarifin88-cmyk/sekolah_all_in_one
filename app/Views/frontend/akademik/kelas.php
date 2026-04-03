<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .hover-lift { transition: transform 0.3s, box-shadow 0.3s; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Daftar Kelas</h1>
        <p class="fs-5 opacity-75 mb-0">Informasi penyebaran dan penamaan ruang kelas akademik.</p>
    </div>

    <div class="glass-card">
        <div class="row g-4">
            <?php if(isset($kelas) && count($kelas) > 0): ?>
                <?php foreach($kelas as $k): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="p-4 text-center rounded-4 border bg-white shadow-sm hover-lift">
                        <i class="fas fa-door-open fs-1 text-success mb-3 opacity-75"></i>
                        <h5 class="fw-bolder text-dark m-0"><?= $k['nama_kelas'] ?></h5>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-school fs-1 text-muted mb-3 opacity-50"></i>
                    <h5 class="text-secondary fw-bold">Data kelas belum tersedia.</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>