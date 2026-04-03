<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<div class="bg-gradient-animated py-5 position-relative overflow-hidden" style="margin-top: -70px; padding-top: 100px !important;">
    <div class="container position-relative z-1 py-4 text-center text-white">
        <h1 class="fw-bold display-5 mb-3">Pengumuman Sekolah</h1>
        <p class="fs-5 opacity-75">Informasi dan pemberitahuan resmi dari pihak sekolah.</p>
    </div>
</div>

<div class="container my-5 position-relative z-2" style="margin-top: -40px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="accordion accordion-flush" id="accordionPengumuman">
                    <?php if(isset($pengumuman) && count($pengumuman) > 0): ?>
                        <?php foreach($pengumuman as $key => $p): ?>
                        <div class="accordion-item border-0 mb-3 bg-light rounded-4 overflow-hidden shadow-sm">
                            <h2 class="accordion-header" id="heading<?= $key ?>">
                                <button class="accordion-button <?= $key == 0 ? '' : 'collapsed' ?> bg-white fw-bold text-dark p-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?= $key == 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $key ?>">
                                    <div class="d-flex flex-column">
                                        <span class="text-primary text-sm fw-semibold mb-1"><i class="fas fa-bullhorn me-2"></i> <?= date('d M Y', strtotime($p['created_at'])) ?></span>
                                        <span class="fs-5"><?= $p['judul_pengumuman'] ?></span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?= $key == 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionPengumuman">
                                <div class="accordion-body p-4 bg-white border-top text-secondary lh-lg fs-6 text-justify">
                                    <?= $p['isi_pengumuman'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center p-5 text-muted">
                            <i class="fas fa-info-circle fs-1 mb-3 text-light"></i>
                            <h4>Belum ada pengumuman saat ini.</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .accordion-button:not(.collapsed) { background-color: #ffffff; color: #000; box-shadow: none; }
    .accordion-button::after { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%234a5568'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e"); }
    .accordion-button:not(.collapsed)::after { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%234e54c8'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e"); }
</style>
<?= $this->endSection() ?>