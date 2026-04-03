<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(236, 72, 153, 0.2); }
    .teacher-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.04); text-align: center; padding: 30px 20px; transition: all 0.3s; border: 1px solid #f1f5f9; height: 100%; }
    .teacher-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: #ec4899; }
    .teacher-img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 20px; border: 4px solid #fdf2f8; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Tenaga Pendidik</h1>
        <p class="fs-5 opacity-75 mb-0">Profil guru dan tenaga kependidikan profesional kami.</p>
    </div>

    <div class="row g-4">
        <?php if(isset($guru) && count($guru) > 0): ?>
            <?php foreach($guru as $g): ?>
            <?php 
                $foto = base_url('assets/dist/img/avatar4.png');
                if (isset($g['jenis_kelamin']) && $g['jenis_kelamin'] == 'Perempuan') {
                    $foto = base_url('assets/dist/img/avatar3.png');
                }
                if (!empty($g['foto']) && $g['foto'] != 'default.png') {
                    $foto = base_url('uploads/profil/' . $g['foto']);
                }
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="teacher-card">
                    <img src="<?= $foto ?>" alt="Teacher" class="teacher-img">
                    <h6 class="fw-bolder text-dark mb-1"><?= $g['gelar_depan'] ?> <?= $g['nama_lengkap'] ?> <?= $g['gelar_belakang'] ?></h6>
                    <p class="text-muted fs-7 mb-3"><?= $g['status_pegawai'] ?></p>
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1">Pendidik</span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-chalkboard-teacher fs-1 text-muted mb-3 opacity-50"></i>
                <h5 class="text-secondary fw-bold">Data guru belum tersedia.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>