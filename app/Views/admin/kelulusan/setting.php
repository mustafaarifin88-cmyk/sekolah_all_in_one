<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #f6d365;
        --theme-shadow: rgba(246, 211, 101, 0.15);
        --theme-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #fda085; background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: var(--theme-gradient); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="modern-card bg-white p-4 h-100">
            <div class="d-flex align-items-center mb-4">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3 text-dark" style="width: 45px; height: 45px; background: var(--theme-gradient);">
                    <i class="fas fa-cogs fs-5"></i>
                </div>
                <h5 class="fw-bold m-0 text-dark">Set Kelulusan</h5>
            </div>
            <form action="<?= base_url('admin/kelulusan/simpan_setting') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ajar</label>
                    <input type="text" class="form-control modern-input" name="tahun_ajar" placeholder="Contoh: 2025/2026" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Rilis</label>
                    <input type="date" class="form-control modern-input" name="tanggal_terbit" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jam Rilis</label>
                    <input type="time" class="form-control modern-input" name="jam_terbit" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Pengumuman</label>
                    <select name="status" class="form-control modern-input" required>
                        <option value="Tidak Aktif">Tidak Aktif (Sembunyikan)</option>
                        <option value="Aktif">Aktif (Tampilkan)</option>
                    </select>
                </div>
                <button type="submit" class="btn text-dark w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);">
                    <i class="fas fa-save me-2"></i> Simpan Setting
                </button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="modern-card bg-white p-0 h-100 overflow-hidden">
            <div class="p-4 border-bottom border-light d-flex justify-content-between align-items-center bg-light">
                <h5 class="fw-bold m-0 text-dark"><i class="fas fa-list me-2" style="color: #fda085;"></i> Konfigurasi Sistem Kelulusan</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Tahun Ajar</th>
                            <th>Jadwal Rilis</th>
                            <th>Status</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($setting) && count($setting) > 0): foreach($setting as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['tahun_ajar'] ?></td>
                            <td><?= date('d M Y', strtotime($row['tanggal_terbit'])) ?> | <?= $row['jam_terbit'] ?> WIB</td>
                            <td>
                                <?php if($row['status'] == 'Aktif'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">AKTIF</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill">TIDAK AKTIF</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_setting_lulus'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/kelulusan/hapus_setting/' . $row['id_setting_lulus']) ?>" onclick="return confirm('Hapus setting ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada setting.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($setting) && count($setting) > 0): foreach($setting as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_setting_lulus'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Setting</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kelulusan/update_setting/' . $row['id_setting_lulus']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ajar</label>
                        <input type="text" class="form-control modern-input" name="tahun_ajar" value="<?= $row['tahun_ajar'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Rilis</label>
                        <input type="date" class="form-control modern-input" name="tanggal_terbit" value="<?= $row['tanggal_terbit'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jam Rilis</label>
                        <input type="time" class="form-control modern-input" name="jam_terbit" value="<?= $row['jam_terbit'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Pengumuman</label>
                        <select name="status" class="form-control modern-input" required>
                            <option value="Aktif" <?= $row['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif (Tampilkan)</option>
                            <option value="Tidak Aktif" <?= $row['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-dark rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>