<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #ff416c;
        --theme-shadow: rgba(255, 65, 108, 0.15);
        --theme-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
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

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-award me-2"></i> Data Kelulusan Siswa</h4>
                    <p class="mb-0 opacity-75 fs-7">Input dan verifikasi status kelulusan siswa akhir.</p>
                </div>
                <button class="btn btn-white text-danger rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Input Kelulusan
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>No Ujian</th>
                            <th>Nama Siswa</th>
                            <th class="text-center">Status Lulus</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($kelulusan) && count($kelulusan) > 0): foreach($kelulusan as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-danger"><?= $row['nomor_ujian'] ?></td>
                            <td>
                                <?php 
                                    $nama_siswa = 'Tidak diketahui';
                                    if(isset($siswa)) {
                                        foreach($siswa as $s) {
                                            if($s['id_siswa'] == $row['id_siswa']) { $nama_siswa = $s['nama_siswa']; break; }
                                        }
                                    }
                                ?>
                                <span class="fw-bold text-dark"><?= $nama_siswa ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($row['status_kelulusan'] == 'LULUS'): ?>
                                    <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check me-1"></i> LULUS</span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill px-3 py-2"><i class="fas fa-times me-1"></i> TIDAK LULUS</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_lulus'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/kelulusan/hapus_data/' . $row['id_lulus']) ?>" onclick="return confirm('Hapus data kelulusan?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-users-slash fs-1 mb-3 opacity-50 d-block"></i>Belum ada data diinput.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-award me-2"></i> Input Kelulusan</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kelulusan/simpan_data') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Siswa</label>
                        <select name="id_siswa" class="form-control modern-input" required>
                            <option value="">-- Cari Nama Siswa --</option>
                            <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                <option value="<?= $s['id_siswa'] ?>"><?= $s['nama_siswa'] ?> (<?= $s['nisn'] ?>)</option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor Ujian</label>
                        <input type="text" class="form-control modern-input" name="nomor_ujian" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Kelulusan</label>
                        <select name="status_kelulusan" class="form-control modern-input" required>
                            <option value="LULUS">LULUS</option>
                            <option value="TIDAK LULUS">TIDAK LULUS</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($kelulusan) && count($kelulusan) > 0): foreach($kelulusan as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_lulus'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Kelulusan</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kelulusan/update_data/' . $row['id_lulus']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Siswa</label>
                        <select name="id_siswa" class="form-control modern-input" required>
                            <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                <option value="<?= $s['id_siswa'] ?>" <?= $row['id_siswa'] == $s['id_siswa'] ? 'selected' : '' ?>><?= $s['nama_siswa'] ?> (<?= $s['nisn'] ?>)</option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor Ujian</label>
                        <input type="text" class="form-control modern-input" name="nomor_ujian" value="<?= $row['nomor_ujian'] ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Kelulusan</label>
                        <select name="status_kelulusan" class="form-control modern-input" required>
                            <option value="LULUS" <?= $row['status_kelulusan'] == 'LULUS' ? 'selected' : '' ?>>LULUS</option>
                            <option value="TIDAK LULUS" <?= $row['status_kelulusan'] == 'TIDAK LULUS' ? 'selected' : '' ?>>TIDAK LULUS</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>