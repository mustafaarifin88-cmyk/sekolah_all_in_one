<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #6a11cb;
        --theme-shadow: rgba(106, 17, 203, 0.15);
        --theme-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .day-header { background: var(--theme-gradient); color: #fff; padding: 15px 25px; border-radius: 20px 20px 0 0; font-weight: 700; font-size: 1.1rem; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="modern-card p-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 55px; height: 55px;">
                    <i class="fas fa-calendar-alt fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark m-0">Jadwal Pelajaran Sekolah</h4>
                    <p class="text-muted mt-1 mb-0 fs-7">Terintegrasi otomatis dengan Pengaturan Mata Pelajaran Guru.</p>
                </div>
            </div>
            <a href="<?= base_url('admin/aplikasi/set_mapel') ?>" class="btn text-white rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift" style="background: var(--theme-gradient);">
                <i class="fas fa-cog me-2"></i> Kelola Jadwal
            </a>
        </div>
    </div>
</div>

<div class="row">
    <?php if(!empty($jadwal_grouped)): ?>
        <?php foreach($jadwal_grouped as $hari => $jadwals): ?>
        <div class="col-12 mb-4">
            <div class="modern-card p-0 overflow-hidden border">
                <div class="day-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-calendar-day me-2 opacity-75"></i> HARI <?= strtoupper($hari) ?></span>
                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm"><?= count($jadwals) ?> Sesi PBM</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%" class="text-center">Waktu PBM</th>
                                <th width="20%" class="text-center">Kelas</th>
                                <th width="30%">Mata Pelajaran</th>
                                <th width="30%">Guru Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jadwals as $key => $row): ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                                <td class="text-center fw-semibold text-danger">
                                    <i class="far fa-clock me-1"></i> <?= substr($row['jam_mulai'], 0, 5) ?> - <?= substr($row['jam_selesai'], 0, 5) ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">
                                        <?= $row['nama_kelas'] ?? '-' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-6"><?= $row['nama_mapel'] ?? '-' ?></span>
                                </td>
                                <td class="text-secondary">
                                    <i class="fas fa-chalkboard-teacher text-primary me-2"></i> <?= $row['nama_guru'] ?? '-' ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="modern-card p-5 text-center">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="far fa-calendar-times fs-1 text-muted opacity-50"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Belum ada jadwal pelajaran yang diatur.</h5>
                <p class="text-muted mb-4">Silakan atur jadwal dan mata pelajaran guru di menu Pengaturan Aplikasi.</p>
                <a href="<?= base_url('admin/aplikasi/set_mapel') ?>" class="btn btn-outline-primary rounded-pill px-4 fw-semibold hover-lift">
                    <i class="fas fa-arrow-right me-2"></i> Ke Pengaturan Mapel Guru
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>