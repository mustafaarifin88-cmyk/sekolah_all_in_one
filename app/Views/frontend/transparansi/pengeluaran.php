<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(239, 68, 68, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Transparansi Pengeluaran</h1>
        <p class="fs-5 opacity-75 mb-0">Rincian biaya operasional dan pengeluaran sekolah secara terbuka.</p>
    </div>

    <div class="glass-card">
        <div class="table-responsive rounded-4 border">
            <table class="table table-hover table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center bg-light">No</th>
                        <th class="bg-light">Tanggal Transaksi</th>
                        <th class="bg-light">Nama Pengeluaran / Keterangan</th>
                        <th class="text-end bg-light">Jumlah Keluar (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($pengeluaran) && count($pengeluaran) > 0): ?>
                        <?php $total = 0; foreach($pengeluaran as $key => $row): $total += $row['jumlah_pengeluaran']; ?>
                        <tr>
                            <td class="text-center text-muted"><?= $key + 1 ?></td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal'])) ?></span></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_pengeluaran'] ?></div>
                                <span class="text-muted fs-7"><?= $row['keterangan'] ?: '-' ?></span>
                            </td>
                            <td class="text-end fw-bolder text-danger fs-6">Rp <?= number_format($row['jumlah_pengeluaran'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="bg-light border-top">
                            <td colspan="3" class="text-end fw-bold text-dark text-uppercase pt-3">Total Seluruh Pengeluaran:</td>
                            <td class="text-end fw-bolder text-danger fs-5 pt-3">Rp <?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    <?php else: ?>
                    <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-file-invoice-dollar fs-1 mb-3 opacity-50 d-block"></i>Belum ada laporan pengeluaran tercatat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>