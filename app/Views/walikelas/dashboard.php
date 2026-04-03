<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .bg-animated-gradient {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        background-size: 200% 200%;
        animation: gradientMove 10s ease infinite;
    }
    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .dashboard-banner {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(17, 153, 142, 0.2);
    }
    .dashboard-banner::after {
        content: '\f549';
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: -10px;
        bottom: -30px;
        font-size: 15rem;
        color: rgba(255,255,255,0.15);
        transform: rotate(-10deg);
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
</style>

<div class="row">
    <div class="col-12 mb-4">
        <div class="dashboard-banner bg-animated-gradient p-5 text-white">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-md-8">
                    <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm fw-bold">PANEL WALI KELAS</span>
                    <h1 class="fw-bolder mb-2" style="font-size: 2.5rem;">Selamat Datang, <?= $nama_lengkap_guru ?>!</h1>
                    <p class="fs-5 opacity-75 mb-0">Pantau dan bimbing siswa kelas Anda untuk meraih prestasi terbaik.</p>
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
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Siswa di Kelas</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_siswa ?></h3>
                </div>
                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Mapel Diajar</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_mapel ?></h3>
                </div>
                <div class="icon-wrapper bg-danger bg-opacity-10 text-danger"><i class="fas fa-book"></i></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Jam/Mgg</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_jam ?></h3>
                </div>
                <div class="icon-wrapper bg-warning bg-opacity-10 text-warning"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold text-uppercase fs-7 mb-1">Pengumuman</p>
                    <h3 class="fw-black text-dark m-0"><?= $total_pengumuman ?></h3>
                </div>
                <div class="icon-wrapper bg-success bg-opacity-10 text-success"><i class="fas fa-bullhorn"></i></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>