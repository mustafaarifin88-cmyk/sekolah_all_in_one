<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-print me-2"></i> Pusat Cetak Dokumen Rapor</h4>
                    <p class="mb-0 opacity-75 fs-6">Filter berdasarkan kelas dan cetak rapor (PDF/Excel) secara massal atau individu.</p>
                </div>
                <i class="fas fa-file-invoice fs-1 text-white opacity-25" style="transform: rotate(15deg) scale(1.5);"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 border-top border-5" style="border-color: #00b09b !important;">
            <div class="row mb-4 bg-light p-3 rounded-4 mx-0 align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase">Tahun Ajaran & Semester</label>
                    <select class="form-control modern-input fw-bold">
                        <option>2025/2026 - Genap</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase">Pilih Rombel / Kelas</label>
                    <select class="form-control modern-input select2">
                        <option value="">-- Semua Kelas --</option>
                    </select>
                </div>
                <div class="col-md-4 text-end mt-4">
                    <button class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift"><i class="fas fa-search me-2"></i> Tampilkan Data</button>
                </div>
            </div>
            
            <div class="table-responsive mt-2">
                <table class="table table-hover table-modern datatable w-100">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>NIS / NISN</th>
                            <th>Nama Lengkap Siswa</th>
                            <th class="text-center">Kelas</th>
                            <th width="20%" class="text-center rounded-end">Opsi Cetak Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <span class="fw-bold text-dark d-block"><?= $row['nis'] ?></span>
                                <span class="text-muted fs-7"><?= $row['nisn'] ?></span>
                            </td>
                            <td class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill"><?= $row['id_kelas'] ?></span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #e74c3c;"><i class="fas fa-file-pdf me-1"></i> PDF</button>
                                    <button class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #27ae60;"><i class="fas fa-file-excel me-1"></i> Excel</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-user-graduate fs-1 mb-3 opacity-50 d-block"></i>Silakan filter kelas terlebih dahulu.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>