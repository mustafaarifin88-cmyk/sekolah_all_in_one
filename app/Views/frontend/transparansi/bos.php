<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Transparansi Dana BOS</h1>
        <p class="fs-5 opacity-75 mb-0">Laporan pemasukan Dana Bantuan Operasional Sekolah.</p>
    </div>

    <div class="glass-card">
        <div class="alert alert-info border-0 rounded-4 shadow-sm mb-4 bg-primary bg-opacity-10 d-flex align-items-center">
            <i class="fas fa-info-circle fs-3 text-primary me-3"></i>
            <span class="text-dark fw-semibold">Sekolah kami berkomitmen untuk selalu transparan dalam pengelolaan dana pendidikan demi kemajuan bersama.</span>
        </div>

        <div class="table-responsive rounded-4 border">
            <table class="table table-hover table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center bg-light">No</th>
                        <th class="bg-light">Tanggal Diterima</th>
                        <th class="text-center bg-light">Tahun Anggaran</th>
                        <th class="text-end bg-light">Jumlah Dana Masuk (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($bos) && count($bos) > 0): ?>
                        <?php $total = 0; foreach($bos as $key => $row): $total += $row['jumlah_dana_masuk']; ?>
                        <tr>
                            <td class="text-center text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><i class="far fa-calendar-check me-2 text-success"></i><?= date('d M Y', strtotime($row['tanggal_terima'])) ?></td>
                            <td class="text-center"><span class="badge bg-secondary rounded-pill px-3 py-1">T.A <?= $row['tahun_anggaran'] ?></span></td>
                            <td class="text-end fw-bolder text-primary fs-6">Rp <?= number_format($row['jumlah_dana_masuk'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="bg-light">
                            <td colspan="3" class="text-end fw-bold text-dark text-uppercase">Total Akumulasi Dana Masuk:</td>
                            <td class="text-end fw-bolder text-success fs-5">Rp <?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    <?php else: ?>
                    <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-wallet fs-1 mb-3 opacity-50 d-block"></i>Belum ada catatan penerimaan dana BOS.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>