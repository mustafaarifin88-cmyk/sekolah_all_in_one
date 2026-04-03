<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .bg-animated-gradient {
        background: linear-gradient(-45deg, #4e54c8, #8f94fb, #11998e, #38ef7d);
        background-size: 400% 400%;
        animation: gradientMove 15s ease infinite;
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
        box-shadow: 0 15px 30px rgba(78, 84, 200, 0.2);
    }
    .dashboard-banner::after {
        content: '\f19d';
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: -20px;
        bottom: -40px;
        font-size: 16rem;
        color: rgba(255,255,255,0.1);
        transform: rotate(-15deg);
    }
    .stat-card {
        border-radius: 20px;
        border: none;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
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
                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 shadow-sm fw-bold">PANEL SISWA</span>
                    <h1 class="fw-bolder mb-2" style="font-size: 2.5rem;">Halo, <?= session()->get('username') ?>!</h1>
                    <p class="fs-5 opacity-75 mb-0">Selamat datang di portal akademik Anda. Tetap semangat belajar!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="stat-card p-4 h-100 d-flex align-items-center justify-content-between">
            <div>
                <p class="text-muted fw-bold text-uppercase fs-7 mb-2">Akses Cepat</p>
                <h4 class="fw-bold text-dark m-0">Lihat Rapor Digital</h4>
                <p class="text-secondary fs-7 mt-2 mb-0">Pantau perkembangan nilai akademik Anda semester ini.</p>
            </div>
            <a href="<?= base_url('siswa/rapor/cetak_rapor') ?>" class="icon-wrapper bg-success bg-opacity-10 text-success text-decoration-none hover-lift">
                <i class="fas fa-file-invoice"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="stat-card p-4 h-100 d-flex align-items-center justify-content-between">
            <div>
                <p class="text-muted fw-bold text-uppercase fs-7 mb-2">Pengaturan</p>
                <h4 class="fw-bold text-dark m-0">Profil Akun</h4>
                <p class="text-secondary fs-7 mt-2 mb-0">Perbarui foto profil atau ganti password akun Anda.</p>
            </div>
            <a href="<?= base_url('siswa/profil') ?>" class="icon-wrapper bg-primary bg-opacity-10 text-primary text-decoration-none hover-lift">
                <i class="fas fa-user-cog"></i>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>