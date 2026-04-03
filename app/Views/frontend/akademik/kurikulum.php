<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); border: 1px solid rgba(255,255,255,0.2); padding: 30px; }
    .hover-lift { transition: transform 0.3s, box-shadow 0.3s; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Kurikulum Pendidikan</h1>
        <p class="fs-5 opacity-75 mb-0">Kerangka dasar dan struktur pembelajaran di sekolah kami.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card">
                <div class="row g-4">
                    <?php if(isset($kurikulum) && count($kurikulum) > 0): ?>
                        <?php foreach($kurikulum as $k): ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 rounded-4 border bg-light hover-lift">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 60px; height: 60px;">
                                    <i class="fas fa-book-open fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark m-0"><?= $k['nama_kurikulum'] ?></h5>
                                    <span class="badge bg-success mt-2">Diterapkan</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-folder-open fs-1 text-muted mb-3 opacity-50"></i>
                            <h5 class="text-secondary fw-bold">Data kurikulum belum tersedia.</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>