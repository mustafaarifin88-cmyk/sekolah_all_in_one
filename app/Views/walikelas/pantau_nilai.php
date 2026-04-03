<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                    <i class="fas fa-binoculars fs-3"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold mb-1">Pantau Input Nilai Guru Lain</h4>
                    <p class="mb-0 opacity-75 fs-7">Melihat perkembangan pengisian rapor oleh seluruh guru untuk kelas Anda.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Siswa</th>
                            <th>Mapel & Pengampu</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center rounded-end">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($rapor) && count($rapor) > 0): foreach($rapor as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></td>
                            <td>
                                <span class="fw-bold text-primary"><?= $row['nama_mapel'] ?></span><br>
                                <span class="text-muted fs-7"><i class="fas fa-chalkboard-teacher me-1 text-success"></i> <?= $row['nama_guru'] ?></span>
                            </td>
                            <td class="text-center text-secondary fs-7 fw-semibold"><?= $row['tahun_ajaran'] ?> <br> SMT <?= $row['semester'] ?></td>
                            <td class="text-center">
                                <span class="badge <?= $row['nilai'] >= 75 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-4 py-2 fs-5 shadow-sm"><?= $row['nilai'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-search fs-1 mb-3 opacity-50 d-block"></i>Belum ada data nilai masuk dari guru mapel.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>