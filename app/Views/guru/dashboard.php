<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .dashboard-banner {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(17, 153, 142, 0.2);
    }
    .dashboard-banner::after {
        content: '\f19d';
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: -10px;
        bottom: -30px;
        font-size: 15rem;
        color: rgba(255,255,255,0.1);
        transform: rotate(-15deg);
    }
    .stat-card {
        border-radius: 20px;
        border: none;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }
    .greeting-text { font-size: 2.2rem; letter-spacing: -0.5px; }
</style>

<div class="row">
    <div class="col-12 mb-4">
        <div class="dashboard-banner p-5 text-white">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-md-8">
                    <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm fw-bold">PANEL GURU</span>
                    <h1 class="fw-bolder greeting-text mb-2">Selamat Datang, <?= $nama_lengkap_guru ?>!</h1>
                    <p class="fs-5 opacity-75 mb-0">Mari mulai aktivitas akademik Anda hari ini dengan penuh semangat.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Siswa Diajar</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_siswa ?></h3>
                </div>
                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Kelas Diampu</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_kelas ?></h3>
                </div>
                <div class="icon-wrapper bg-success bg-opacity-10 text-success">
                    <i class="fas fa-door-open"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Jam/Minggu</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_jam ?></h3>
                </div>
                <div class="icon-wrapper bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Berita Anda</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_berita ?></h3>
                </div>
                <div class="icon-wrapper bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>