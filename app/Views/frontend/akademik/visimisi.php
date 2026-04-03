<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(14, 165, 233, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 50px; font-size: 1.1rem; line-height: 1.8; color: #475569; }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Visi & Misi Sekolah</h1>
        <p class="fs-5 opacity-75 mb-0">Tujuan dan komitmen kami dalam membangun generasi bangsa.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card">
                <?php if(isset($identitas['visi_misi']) && !empty($identitas['visi_misi'])): ?>
                    <div class="visi-misi-content text-justify">
                        <?= $identitas['visi_misi'] ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-bullseye fs-1 text-muted mb-3 opacity-50"></i>
                        <h5 class="text-secondary fw-bold">Visi dan misi belum diatur.</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>