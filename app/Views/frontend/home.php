<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<?php helper('text'); ?>
<style>
    body { background-color: #f8fafc; }
    
    /* Hero Carousel Full Width */
    .hero-carousel-full { width: 100%; position: relative; margin-bottom: 50px; background: #000; }
    .hero-carousel-full .carousel-item img { height: 70vh; min-height: 450px; max-height: 600px; object-fit: cover; filter: brightness(0.5); width: 100%; }
    .hero-carousel-full .carousel-caption { bottom: 25%; left: 0; right: 0; text-align: left; }
    .hero-title { font-weight: 800; font-size: 3rem; text-shadow: 0 4px 15px rgba(0,0,0,0.6); margin-bottom: 15px; letter-spacing: -0.5px; }
    .caption-container { max-width: 1140px; margin: 0 auto; padding: 0 15px; }
    
    /* Content & Widgets */
    .content-block { background: #fff; border-radius: 20px; padding: 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-bottom: 40px; border: 1px solid #f1f5f9; }
    .kepsek-img { width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 5px solid #f8fafc; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    
    .widget-box { background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); padding: 25px; margin-bottom: 25px; border: 1px solid #f1f5f9; position: sticky; top: 90px; }
    .widget-title { font-size: 1.05rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #1e293b; border-bottom: 3px solid #2563eb; padding-bottom: 12px; margin-bottom: 20px; display: inline-block; }
    .widget-item { display: flex; gap: 15px; margin-bottom: 15px; border-bottom: 1px dashed #e2e8f0; padding-bottom: 15px; transition: all 0.3s; }
    .widget-item:hover { transform: translateX(5px); }
    .widget-item:last-child { margin-bottom: 0; border-bottom: none; padding-bottom: 0; }
    .widget-img { width: 70px; height: 70px; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .widget-text h6 { font-size: 0.9rem; font-weight: 700; margin-bottom: 5px; line-height: 1.4; color: #334155; transition: color 0.3s; }
    .widget-text h6:hover { color: #2563eb; }
    .widget-date { font-size: 0.75rem; color: #64748b; font-weight: 500; }
    
    .archive-list { list-style: none; padding: 0; margin: 0; }
    .archive-list li { margin-bottom: 10px; }
    .archive-list a { display: flex; justify-content: space-between; align-items: center; color: #475569; text-decoration: none; font-weight: 600; padding: 10px 15px; border-radius: 10px; background: #f8fafc; transition: all 0.3s; font-size: 0.85rem; border: 1px solid #e2e8f0; }
    .archive-list a:hover { background: #2563eb; color: #fff; border-color: #2563eb; transform: translateX(5px); box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2); }
    .archive-list a:hover .badge { background: #fff !important; color: #2563eb !important; }
</style>

<div class="container-fluid p-0">
    <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel-full" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner h-100">
            <?php if(isset($slider) && count($slider) > 0): ?>
                <?php foreach($slider as $key => $s): ?>
                <div class="carousel-item h-100 <?= $key == 0 ? 'active' : '' ?>">
                    <img src="<?= base_url('uploads/slider/' . $s['foto']) ?>" class="d-block w-100" alt="Slider">
                    <div class="carousel-caption">
                        <div class="caption-container">
                            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fs-6 shadow-sm border border-white border-opacity-25" style="backdrop-filter: blur(5px);">INFO SEKOLAH TERKINI</span>
                            <h1 class="hero-title text-white"><?= $s['judul'] ?></h1>
                            <p class="text-white opacity-75 fs-5 mb-0 w-75 d-none d-md-block" style="line-height: 1.6; text-shadow: 0 2px 5px rgba(0,0,0,0.5);"><?= word_limiter($s['keterangan'], 25) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="carousel-item h-100 active bg-dark">
                    <img src="<?= base_url('assets/dist/img/photo1.png') ?>" class="d-block w-100" alt="Default Slider">
                    <div class="carousel-caption">
                        <div class="caption-container text-center">
                            <h1 class="hero-title text-white">Selamat Datang di Website Resmi Sekolah</h1>
                            <p class="text-white opacity-75 fs-5">Membangun Generasi Cerdas, Berkarakter, dan Berprestasi.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true" style="width: 50px; height: 50px;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true" style="width: 50px; height: 50px;"></span>
        </button>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-9">
            <div class="content-block">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <?php $fotoKepsek = (isset($identitas['foto_kepsek']) && $identitas['foto_kepsek']) ? base_url('uploads/identitas/' . $identitas['foto_kepsek']) : base_url('assets/dist/img/avatar5.png'); ?>
                        <img src="<?= $fotoKepsek ?>" alt="Kepala Sekolah" class="kepsek-img mb-3">
                        <h6 class="fw-bold text-dark m-0"><?= $identitas['nama_kepsek'] ?? 'Nama Kepala Sekolah' ?></h6>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3 mt-2 fs-7">Kepala Sekolah</span>
                    </div>
                    <div class="col-md-9 border-start ps-md-4">
                        <h3 class="fw-bolder text-dark mb-3" style="letter-spacing: -0.5px;">Visi & Misi Sekolah</h3>
                        <div class="text-secondary lh-lg fs-6 position-relative" style="max-height: 180px; overflow: hidden;">
                            <?php if(isset($identitas['visi_misi']) && !empty($identitas['visi_misi'])): ?>
                                <?= $identitas['visi_misi'] ?>
                            <?php else: ?>
                                <p>Visi dan misi sekolah belum diatur oleh administrator.</p>
                            <?php endif; ?>
                            <div style="position: absolute; bottom: 0; width: 100%; height: 60px; background: linear-gradient(transparent, #fff);"></div>
                        </div>
                        <a href="<?= base_url('akademik/visimisi') ?>" class="btn btn-outline-primary rounded-pill px-4 mt-3 fw-bold shadow-sm hover-lift"><i class="fas fa-book-reader me-2"></i>Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            
            <div class="content-block">
                <h4 class="fw-bolder text-dark mb-4 border-bottom pb-3"><i class="fas fa-newspaper text-primary me-2"></i> Berita Sekolah Terbaru</h4>
                <div class="row g-4">
                    <?php if(isset($berita_terbaru) && count($berita_terbaru) > 0): ?>
                        <?php foreach(array_slice($berita_terbaru, 0, 4) as $b): ?>
                        <div class="col-md-6">
                            <div class="d-flex flex-column h-100 border rounded-4 overflow-hidden shadow-sm" style="transition: all 0.3s ease; cursor: pointer; background: #fff;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.05)';" onclick="window.location.href='<?= base_url('berita/detail/' . $b['id_berita']) ?>'">
                                <img src="<?= base_url('uploads/berita/' . $b['thumbnail']) ?>" alt="News" style="height: 200px; object-fit: cover;">
                                <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="text-primary fw-semibold fs-7 mb-2"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($b['tanggal_publish'])) ?></div>
                                        <h5 class="fw-bold text-dark mb-3 lh-base" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= $b['judul_berita'] ?></h5>
                                        <p class="text-secondary fs-7 mb-0" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.6;"><?= strip_tags($b['isi_berita']) ?></p>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <span class="text-primary fw-bold fs-7">Baca Detail <i class="fas fa-arrow-right ms-1 fs-8"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="text-center mt-5">
                    <a href="<?= base_url('berita') ?>" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift text-white" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;"><i class="fas fa-bars me-2"></i> Indeks Berita Sekolah</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="widget-box">
                <div class="widget-title">Berita Populer</div>
                <?php if(isset($berita_terbaru) && count($berita_terbaru) > 0): ?>
                    <?php foreach($berita_terbaru as $b): ?>
                    <div class="widget-item align-items-center">
                        <img src="<?= base_url('uploads/berita/' . $b['thumbnail']) ?>" class="widget-img shadow-sm" alt="Thumb">
                        <div class="widget-text w-100">
                            <a href="<?= base_url('berita/detail/' . $b['id_berita']) ?>" class="text-decoration-none">
                                <h6 class="mb-1"><?= word_limiter($b['judul_berita'], 5) ?></h6>
                            </a>
                            <div class="widget-date"><i class="far fa-clock me-1"></i> <?= date('d M Y', strtotime($b['tanggal_publish'])) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center fs-7 mb-0">Belum ada berita.</p>
                <?php endif; ?>
            </div>

            <div class="widget-box">
                <div class="widget-title" style="border-color: #ef4444;">Papan Pengumuman</div>
                <?php if(isset($pengumuman_terbaru) && count($pengumuman_terbaru) > 0): ?>
                    <?php foreach($pengumuman_terbaru as $p): ?>
                    <div class="widget-item align-items-center">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-bullhorn fs-5"></i>
                        </div>
                        <div class="widget-text w-100">
                            <a href="<?= base_url('pengumuman') ?>" class="text-decoration-none">
                                <h6 class="mb-1 text-dark"><?= word_limiter($p['judul_pengumuman'], 6) ?></h6>
                            </a>
                            <div class="widget-date text-danger fw-semibold"><i class="far fa-calendar-check me-1"></i> <?= date('d M Y', strtotime($p['created_at'])) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center fs-7 mb-0">Belum ada pengumuman.</p>
                <?php endif; ?>
            </div>

            <div class="widget-box">
                <div class="widget-title" style="border-color: #10b981;">Arsip Dokumen</div>
                <?php if(isset($arsip_terbaru) && count($arsip_terbaru) > 0): ?>
                    <ul class="archive-list">
                        <?php foreach($arsip_terbaru as $arsip): ?>
                        <li>
                            <a href="<?= base_url('arsip/dokumen') ?>">
                                <span class="text-truncate me-2" style="max-width: 140px;"><i class="fas fa-file-pdf me-2 text-danger"></i><?= $arsip['perihal'] ?></span>
                                <span class="badge bg-light text-secondary border border-secondary border-opacity-25"><?= date('Y', strtotime($arsip['tanggal_surat'])) ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted text-center fs-7 mb-0">Belum ada arsip.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('frontend/kelulusan_popup') ?>
<?= $this->endSection() ?>