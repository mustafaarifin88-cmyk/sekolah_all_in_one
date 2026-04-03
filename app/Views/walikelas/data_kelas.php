<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
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
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                    <i class="fas fa-door-open fs-3"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold mb-1">Informasi Kelas Binaan</h4>
                    <p class="mb-0 opacity-75 fs-7">Data ruang kelas yang menjadi tanggung jawab Anda sebagai Wali Kelas.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center rounded-start">No</th>
                            <th>Status Penugasan</th>
                            <th>Nama Kelas Binaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($kelas) && count($kelas) > 0): foreach($kelas as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill"><i class="fas fa-check me-1"></i> Aktif Bertugas</span></td>
                            <td><span class="fw-bold text-dark fs-5"><?= $row['nama_kelas'] ?></span></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center py-5 text-muted"><i class="fas fa-ban fs-1 mb-3 opacity-50 d-block"></i>Admin belum menetapkan kelas binaan untuk Anda.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>