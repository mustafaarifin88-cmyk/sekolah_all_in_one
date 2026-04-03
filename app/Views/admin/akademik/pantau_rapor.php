<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="modern-card p-4 text-center hover-lift" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <h6 class="text-white fw-bold text-uppercase mb-2">Total Kelas Tuntas</h6>
            <h2 class="display-5 fw-bold text-white mb-0">12<span class="fs-5 fw-normal">/36</span></h2>
        </div>
    </div>
    <div class="col-md-8">
        <div class="modern-card p-4 h-100 d-flex flex-column justify-content-center">
            <h5 class="fw-bold text-dark mb-2"><i class="fas fa-chart-line text-primary me-2"></i> Progress Input Nilai Rapor Guru</h5>
            <p class="text-muted fs-7 mb-0">Pantau secara real-time kepatuhan dan kelengkapan input nilai akhir semester oleh dewan guru untuk setiap kelas dan mata pelajaran yang diampu.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h6 class="fw-bold m-0 text-dark text-uppercase tracking-wider">Log Riwayat Input Terakhir</h6>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold"><i class="fas fa-filter me-1"></i> Filter Semester</button>
                    <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold bg-gradient-animated border-0"><i class="fas fa-sync-alt me-1"></i> Refresh</button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-modern datatable w-100">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengampu</th>
                            <th class="text-center">T.A / SMT</th>
                            <th class="text-center rounded-end">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($rapor) && count($rapor) > 0): foreach($rapor as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['id_siswa'] ?></td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill"><?= $row['id_kelas'] ?></span></td>
                            <td class="text-primary fw-semibold"><?= $row['id_mapel'] ?></td>
                            <td><?= $row['id_guru'] ?></td>
                            <td class="text-center text-muted fs-7"><?= $row['tahun_ajaran'] ?> - SMT <?= $row['semester'] ?></td>
                            <td class="text-center">
                                <span class="badge <?= $row['nilai'] >= 75 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-3 py-2 fs-6 shadow-sm"><?= $row['nilai'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-file-signature fs-1 mb-3 opacity-50 d-block"></i>Belum ada log nilai yang diinput.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>