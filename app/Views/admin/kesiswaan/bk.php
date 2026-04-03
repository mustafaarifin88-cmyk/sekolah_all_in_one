<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #8E2DE2;
        --theme-shadow: rgba(142, 45, 226, 0.15);
        --theme-gradient: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%);
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
                    <h4 class="fw-bold mb-1"><i class="fas fa-hands-helping me-2"></i> Bimbingan Konseling</h4>
                    <p class="mb-0 opacity-75 fs-7">Pencatatan data kasus dan bimbingan siswa.</p>
                </div>
                <button class="btn btn-white text-primary rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Tambah Data BK
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Kasus & Keterangan</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($bk) && count($bk) > 0): foreach($bk as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td><span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal'])) ?></span></td>
                            <td>
                                <?php 
                                    $nama_siswa = 'Tidak diketahui';
                                    if(isset($siswa)) {
                                        foreach($siswa as $s) {
                                            if($s['id_siswa'] == $row['id_siswa']) { $nama_siswa = $s['nama_siswa']; break; }
                                        }
                                    }
                                ?>
                                <span class="fw-bold text-dark fs-6"><?= $nama_siswa ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="color: var(--theme-color) !important;"><?= $row['judul_kasus'] ?></div>
                                <span class="text-secondary fs-7"><?= $row['keterangan'] ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_bk'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/kesiswaan/hapus_bk/' . $row['id_bk']) ?>" onclick="return confirm('Hapus data BK ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-hands-helping fs-1 mb-3 opacity-50 d-block"></i>Belum ada data bimbingan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-plus-circle me-2"></i> Input Data BK</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kesiswaan/simpan_bk') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Kejadian / Bimbingan</label>
                            <input type="date" class="form-control modern-input" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                    <option value="<?= $s['id_siswa'] ?>"><?= $s['nama_siswa'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Kasus / Bimbingan</label>
                            <input type="text" class="form-control modern-input" name="judul_kasus" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Keterangan / Tindak Lanjut</label>
                            <textarea class="form-control modern-input" name="keterangan" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($bk) && count($bk) > 0): foreach($bk as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_bk'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Data BK</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kesiswaan/update_bk/' . $row['id_bk']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Kejadian / Bimbingan</label>
                            <input type="date" class="form-control modern-input" name="tanggal" value="<?= $row['tanggal'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                    <option value="<?= $s['id_siswa'] ?>" <?= $row['id_siswa'] == $s['id_siswa'] ? 'selected' : '' ?>><?= $s['nama_siswa'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Kasus / Bimbingan</label>
                            <input type="text" class="form-control modern-input" name="judul_kasus" value="<?= $row['judul_kasus'] ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Keterangan / Tindak Lanjut</label>
                            <textarea class="form-control modern-input" name="keterangan" rows="4" required><?= $row['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>