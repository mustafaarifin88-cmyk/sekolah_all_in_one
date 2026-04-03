<?php
$identitasModel = new \App\Models\IdentitasSekolahModel();
$identitas = $identitasModel->first();
$logoFrontend = ($identitas && !empty($identitas['logo_sekolah'])) ? base_url('uploads/identitas/' . $identitas['logo_sekolah']) : base_url('assets/dist/img/AdminLTELogo.png');
$namaFrontend = ($identitas && !empty($identitas['nama_sekolah'])) ? $identitas['nama_sekolah'] : 'Sistem Informasi Sekolah';

$menuModel = new \App\Models\MenuEksternalModel();
$menuEksternal = $menuModel->orderBy('urutan', 'ASC')->findAll();

$settingKelulusan = new \App\Models\SetKelulusanModel();
$isKelulusanAktif = $settingKelulusan->where('status', 'Aktif')->first();

$tema = $identitas['tema_header'] ?? 'theme-blue';
$gradienTop = 'linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%)';
$gradienBottom = 'linear-gradient(135deg, #2563eb 0%, #4f46e5 100%)';
if($tema == 'theme-dark') $gradienBottom = 'linear-gradient(135deg, #1e293b 0%, #0f172a 100%)';
elseif($tema == 'theme-animated') $gradienBottom = 'linear-gradient(-45deg, #4e54c8, #8f94fb, #11998e, #38ef7d)';
?>

<style>
    .top-header {
        background: <?= $gradienTop ?>;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        z-index: 1040;
        position: relative;
    }
    .top-header .brand-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .btn-top-action {
        border-radius: 8px;
        padding: 6px 15px;
        font-size: 0.85rem;
        font-weight: 700;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-top-action:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
    
    .bottom-navbar {
        background: <?= $gradienBottom ?>;
        <?php if($tema == 'theme-animated'): ?> background-size: 400% 400%; animation: gradientMove 15s ease infinite; <?php endif; ?>
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        z-index: 1030;
        transition: all 0.3s ease;
    }
    .bottom-navbar.sticky-top {
        position: sticky;
        top: 0;
    }
    .nav-custom .nav-item { margin: 0 2px; }
    .nav-custom .nav-link {
        color: rgba(255,255,255,0.9) !important;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 12px 18px !important;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .nav-custom .nav-link:hover, .nav-custom .nav-link.active {
        background: rgba(255,255,255,0.15);
        color: #fff !important;
    }
    
    @media all and (min-width: 992px) {
        .navbar .nav-item.dropdown:hover .dropdown-menu { display: block; opacity: 1; transform: translateY(0); }
        .navbar .nav-item.dropdown .dropdown-menu {
            display: block; opacity: 0; transform: translateY(10px); transition: all 0.3s ease; pointer-events: none;
            margin-top: 0; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 10px;
        }
        .navbar .nav-item.dropdown:hover .dropdown-menu { pointer-events: auto; }
    }
    .dropdown-menu .dropdown-item {
        border-radius: 8px; padding: 10px 15px; font-weight: 600; color: #475569; transition: all 0.2s;
    }
    .dropdown-menu .dropdown-item:hover { background: #f1f5f9; color: #2563eb; padding-left: 20px; }
</style>

<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                <img src="<?= $logoFrontend ?>" alt="Logo" class="rounded-circle shadow-sm bg-white p-1 me-3" style="width:55px; height:55px; object-fit:cover;">
                <span class="brand-text"><?= strtoupper($namaFrontend) ?></span>
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center justify-content-lg-end gap-2 flex-wrap">
                <?php if(isset($menuEksternal) && count($menuEksternal) > 0): foreach($menuEksternal as $m): ?>
                    <a href="<?= $m['link_eksternal'] ?>" target="_blank" class="btn btn-sm btn-outline-light btn-top-action"><i class="fas fa-external-link-alt me-1"></i> <?= $m['nama_menu'] ?></a>
                <?php endforeach; endif; ?>
                
                <?php if($isKelulusanAktif): ?>
                    <button type="button" class="btn btn-sm btn-warning text-dark btn-top-action" data-bs-toggle="modal" data-bs-target="#modalKelulusan">
                        <i class="fas fa-graduation-cap me-1"></i> Cek Kelulusan
                    </button>
                <?php endif; ?>
                
                <a href="<?= base_url('login') ?>" class="btn btn-sm btn-light text-primary btn-top-action shadow-sm">
                    <i class="fas fa-sign-in-alt me-1"></i> Portal Login
                </a>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bottom-navbar sticky-top py-1 py-lg-0">
    <div class="container">
        <button class="navbar-toggler border-0 shadow-none text-white w-100 d-lg-none py-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <i class="fas fa-bars me-2"></i> Menu Navigasi
        </button>
        
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto nav-custom py-2 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-graduation-cap me-1"></i> Akademik</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('akademik/kurikulum') ?>"><i class="fas fa-book-open me-2 text-primary"></i> Data Kurikulum</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('akademik/kelas') ?>"><i class="fas fa-door-open me-2 text-success"></i> Data Kelas</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('akademik/siswa') ?>"><i class="fas fa-users me-2 text-info"></i> Data Siswa</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('akademik/guru') ?>"><i class="fas fa-chalkboard-teacher me-2 text-warning"></i> Data Guru</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('akademik/visimisi') ?>"><i class="fas fa-bullseye me-2 text-danger"></i> Visi Misi Sekolah</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('akademik/prestasi') ?>"><i class="fas fa-trophy me-2 text-warning"></i> Prestasi Siswa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-info-circle me-1"></i> Pusat Informasi</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('berita') ?>"><i class="fas fa-newspaper me-2 text-primary"></i> Berita & Artikel</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('pengumuman') ?>"><i class="fas fa-bullhorn me-2 text-danger"></i> Papan Pengumuman</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-building me-1"></i> Sarana & Prasarana</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('sarpras/fasilitas') ?>"><i class="fas fa-boxes me-2 text-success"></i> Inventaris & Ruangan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-chart-pie me-1"></i> Transparansi</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('transparansi/bos') ?>"><i class="fas fa-hand-holding-usd me-2 text-success"></i> Penerimaan Dana BOS</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('transparansi/pengeluaran') ?>"><i class="fas fa-file-invoice-dollar me-2 text-danger"></i> Laporan Pengeluaran</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-folder-open me-1"></i> Arsip Digital</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('arsip/dokumen') ?>"><i class="fas fa-file-alt me-2 text-primary"></i> Arsip Dokumen Publik</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>