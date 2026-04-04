<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                    <i class="fas fa-file-invoice fs-3"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold m-0">Cetak Rapor Digital</h4>
                    <p class="mt-1 mb-0 fs-7 opacity-75">Filter berdasarkan kelas untuk mencetak rapor siswa.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-4 mb-4 border">
            <form action="" method="get">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Kelas / Rombel</label>
                        <select name="id_kelas" class="form-control modern-input" onchange="this.form.submit()">
                            <option value="">-- Silakan Pilih Kelas --</option>
                            <?php if(isset($kelas_list)): foreach($kelas_list as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>" <?= ($id_kelas_selected == $k['id_kelas']) ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th width="40%">Identitas Siswa</th>
                            <th width="20%" class="text-center">Kelas</th>
                            <th width="35%" class="text-center rounded-end">Aksi Cetak</th>
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
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill"><?= $row['nama_kelas'] ?></span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('admin/akademik/cetak_rapor_pdf/'.$row['id_siswa']) ?>" target="_blank" class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #e74c3c;"><i class="fas fa-file-pdf me-1"></i> Cetak PDF</a>
                                    <a href="<?= base_url('admin/akademik/cetak_rapor_excel/'.$row['id_siswa']) ?>" class="btn btn-sm text-white rounded-pill px-3 shadow-sm hover-lift fw-semibold" style="background: #27ae60;"><i class="fas fa-file-excel me-1"></i> Unduh Excel</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-user-graduate fs-1 mb-3 opacity-50 d-block"></i>Silakan pilih kelas terlebih dahulu.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>