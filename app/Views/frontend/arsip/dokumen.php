<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; }
    .hover-lift { transition: transform 0.3s, box-shadow 0.3s; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Arsip Dokumen Publik</h1>
        <p class="fs-5 opacity-75 mb-0">Akses dokumen publik, edaran, dan surat keluar resmi dari sekolah.</p>
    </div>

    <div class="glass-card">
        <div class="table-responsive rounded-4 border">
            <table class="table table-hover table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center bg-light">No</th>
                        <th width="15%" class="bg-light">Tanggal</th>
                        <th class="bg-light">Nomor & Perihal Dokumen</th>
                        <th width="15%" class="text-center bg-light">Tujuan</th>
                        <th width="15%" class="text-center bg-light">Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($dokumen) && count($dokumen) > 0): foreach($dokumen as $key => $row): ?>
                    <tr>
                        <td class="text-center text-muted"><?= $key + 1 ?></td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal_surat'])) ?></span></td>
                        <td>
                            <div class="fw-bold text-dark fs-6 mb-1"><?= $row['perihal'] ?></div>
                            <span class="text-muted fs-7"><i class="fas fa-hashtag me-1 opacity-50"></i> <?= $row['nomor_surat'] ?></span>
                        </td>
                        <td class="text-center text-secondary"><?= $row['tujuan_surat'] ?></td>
                        <td class="text-center">
                            <?php if($row['lampiran']): ?>
                                <a href="<?= base_url('uploads/surat_keluar/' . $row['lampiran']) ?>" target="_blank" class="btn btn-sm btn-light text-primary border rounded-pill px-3 shadow-sm hover-lift"><i class="fas fa-download me-1"></i> Unduh</a>
                            <?php else: ?>
                                <span class="text-muted fs-7 fst-italic">Tanpa Lampiran</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-folder-open fs-1 mb-3 opacity-50 d-block"></i>Belum ada arsip dokumen publik.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>