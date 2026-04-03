<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        --theme-shadow: rgba(0, 198, 255, 0.2);
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
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-briefcase fs-3 text-white"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold mb-1">Informasi Beban Kerja</h4>
                    <p class="mb-0 opacity-75 fs-7">Rincian total jam mengajar Anda per minggu.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center rounded-start">No</th>
                            <th>Status Data</th>
                            <th class="text-center">Total Jam Kerja</th>
                            <th width="20%" class="text-center rounded-end">Terakhir Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($beban) && count($beban) > 0): foreach($beban as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill border border-success border-opacity-25"><i class="fas fa-check-circle me-1"></i> Data Valid</span></td>
                            <td class="text-center"><span class="fw-bolder fs-5 text-primary"><?= $row['jumlah_jam_kerja'] ?> <small class="text-muted fs-7 fw-normal">Jam/Minggu</small></span></td>
                            <td class="text-center text-muted fs-7"><?= date('d M Y H:i', strtotime($row['updated_at'] ?? $row['created_at'])) ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-inbox fs-1 mb-3 opacity-50 d-block"></i>Data beban kerja Anda belum diinput oleh Admin.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>