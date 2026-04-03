<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-award me-2"></i> Hasil Rapor Pembelajaran</h4>
                    <p class="mb-0 opacity-75 fs-7">Unduh dan cetak nilai akademik Anda secara mandiri.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0 text-dark">Data Nilai Tersedia</h5>
                <div>
                    <button class="btn btn-danger rounded-pill px-4 shadow-sm hover-lift fw-bold me-2"><i class="fas fa-file-pdf me-2"></i>Cetak Full PDF</button>
                    <button class="btn btn-success rounded-pill px-4 shadow-sm hover-lift fw-bold"><i class="fas fa-file-excel me-2"></i>Export Excel</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Mata Pelajaran</th>
                            <th>Tahun Ajaran & Semester</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($rapor) && count($rapor) > 0): foreach($rapor as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark fs-6">ID Mapel: <?= $row['id_mapel'] ?></td>
                            <td>
                                <span class="fw-semibold text-secondary"><?= $row['tahun_ajaran'] ?></span><br>
                                <span class="badge bg-light text-dark border mt-1">Semester <?= $row['semester'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $row['nilai'] >= 75 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-4 py-2 fs-5 shadow-sm"><?= $row['nilai'] ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($row['nilai'] >= 75): ?>
                                    <span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> Tuntas</span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="fas fa-times-circle me-1"></i> Belum Tuntas</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-file-invoice fs-1 mb-3 opacity-50 d-block"></i>Nilai Anda belum diterbitkan oleh pihak sekolah.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>