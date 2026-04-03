<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        --theme-shadow: rgba(246, 211, 101, 0.2);
        --theme-color: #fda085;
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: var(--theme-color); background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: var(--theme-gradient); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="modern-card bg-white p-4 h-100 border">
            <div class="d-flex align-items-center mb-4">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3 text-dark" style="width: 45px; height: 45px; background: var(--theme-gradient);">
                    <i class="fas fa-certificate fs-5"></i>
                </div>
                <h5 class="fw-bold m-0 text-dark">Tambah Sertifikasi</h5>
            </div>
            <form action="<?= base_url('walikelas/kepegawaian/simpan_sertifikasi') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Sertifikasi</label>
                    <input type="text" class="form-control modern-input" name="nama_sertifikasi" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Didapat</label>
                    <input type="number" class="form-control modern-input" name="tahun" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Keterangan / Nomor</label>
                    <input type="text" class="form-control modern-input" name="keterangan">
                </div>
                <button type="submit" class="btn text-dark w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);">
                    <i class="fas fa-save me-2"></i> Simpan Sertifikasi
                </button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="modern-card bg-white p-0 h-100 overflow-hidden border">
            <div class="p-4 border-bottom border-light bg-light">
                <h5 class="fw-bold m-0 text-dark"><i class="fas fa-medal me-2 text-warning"></i> Data Sertifikasi Keahlian</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Sertifikat</th>
                            <th>Tahun & Keterangan</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($sertifikasi) && count($sertifikasi) > 0): foreach($sertifikasi as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark fs-6"><?= $row['nama_sertifikasi'] ?></td>
                            <td>
                                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill mb-1">Tahun <?= $row['tahun'] ?></span><br>
                                <span class="text-muted fs-7"><?= $row['keterangan'] ?: '-' ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_sertifikasi'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('walikelas/kepegawaian/hapus_sertifikasi/' . $row['id_sertifikasi']) ?>" onclick="return confirm('Hapus sertifikasi ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-certificate fs-1 mb-3 opacity-50 d-block"></i>Belum ada sertifikasi yang diinput.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($sertifikasi) && count($sertifikasi) > 0): foreach($sertifikasi as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_sertifikasi'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Sertifikasi</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/kepegawaian/update_sertifikasi/' . $row['id_sertifikasi']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Sertifikasi</label>
                        <input type="text" class="form-control modern-input" name="nama_sertifikasi" value="<?= $row['nama_sertifikasi'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Didapat</label>
                        <input type="number" class="form-control modern-input" name="tahun" value="<?= $row['tahun'] ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Keterangan / Nomor</label>
                        <input type="text" class="form-control modern-input" name="keterangan" value="<?= $row['keterangan'] ?>">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold border shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-dark rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>