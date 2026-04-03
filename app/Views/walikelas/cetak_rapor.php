<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
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
                <div class="text-dark">
                    <h4 class="fw-bold mb-1"><i class="fas fa-print me-2"></i> Cetak Rapor Digital Kelas</h4>
                    <p class="mb-0 opacity-75 fs-7 fw-semibold">Cetak atau export dokumen rapor untuk seluruh siswa di kelas binaan Anda.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0 text-dark">Data Rapor Siswa Kelas</h5>
                <div>
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm hover-lift fw-bold me-2"><i class="fas fa-file-pdf me-2 text-danger"></i>Cetak Semua (PDF)</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Identitas Siswa</th>
                            <th class="text-center">Kelas</th>
                            <th width="20%" class="text-center rounded-end">Aksi Cetak Mandiri</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></div>
                                <span class="text-muted fs-7">NISN: <?= $row['nisn'] ?></span>
                            </td>
                            <td class="text-center"><span class="badge bg-warning text-dark border px-3 py-1 rounded-pill"><?= $row['nama_kelas'] ?></span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #e74c3c;"><i class="fas fa-file-pdf me-1"></i> PDF</button>
                                    <button class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #27ae60;"><i class="fas fa-file-excel me-1"></i> Excel</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan=\"4\" class=\"text-center py-5 text-muted\"><i class=\"fas fa-user-graduate fs-1 mb-3 opacity-50 d-block\"></i>Tidak ada data siswa untuk dicetak.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>