<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #6a11cb;
        --theme-shadow: rgba(106, 17, 203, 0.15);
        --theme-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
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
                    <h4 class="fw-bold mb-1"><i class="fas fa-user-graduate me-2"></i> Riwayat Pendidikan</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola riwayat pendidikan guru dan tenaga kependidikan.</p>
                </div>
                <button class="btn btn-white text-primary rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Tambah Riwayat
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Guru</th>
                            <th>Asal Sekolah/Kampus</th>
                            <th>Jurusan & Lulus</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($pendidikan) && count($pendidikan) > 0): foreach($pendidikan as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <?php 
                                    $nama_guru = 'Tidak diketahui';
                                    if(isset($guru)) {
                                        foreach($guru as $g) {
                                            if($g['id_guru'] == $row['id_guru']) { $nama_guru = $g['nama_lengkap']; break; }
                                        }
                                    }
                                ?>
                                <span class="fw-bold text-dark"><?= $nama_guru ?></span>
                            </td>
                            <td class="fw-bold" style="color: var(--theme-color);"><?= $row['asal_sekolah'] ?></td>
                            <td>
                                <span class="text-dark fw-semibold"><?= $row['jurusan'] ?: '-' ?></span> <br>
                                <span class="badge bg-light text-secondary border mt-1">Tahun <?= $row['tahun_lulus'] ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_riwayat_pdd'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/kepegawaian/hapus_riwayat_pendidikan/' . $row['id_riwayat_pdd']) ?>" onclick="return confirm('Hapus riwayat ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-book-reader fs-1 mb-3 opacity-50 d-block"></i>Belum ada data pendidikan.</td></tr>
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
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-plus-circle me-2"></i> Tambah Riwayat Pendidikan</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kepegawaian/simpan_riwayat_pendidikan') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Guru/Tendik</label>
                        <select name="id_guru" class="form-control modern-input" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php if(isset($guru)): foreach($guru as $g): ?>
                                <option value="<?= $g['id_guru'] ?>"><?= $g['nama_lengkap'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal Sekolah/Universitas</label>
                        <input type="text" class="form-control modern-input" name="asal_sekolah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jurusan / Program Studi</label>
                        <input type="text" class="form-control modern-input" name="jurusan" placeholder="Boleh kosong jika tidak ada">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Lulus</label>
                        <input type="number" class="form-control modern-input" name="tahun_lulus" required>
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

<?php if(isset($pendidikan) && count($pendidikan) > 0): foreach($pendidikan as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_riwayat_pdd'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Riwayat Pendidikan</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/kepegawaian/update_riwayat_pendidikan/' . $row['id_riwayat_pdd']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Guru/Tendik</label>
                        <select name="id_guru" class="form-control modern-input" required>
                            <?php if(isset($guru)): foreach($guru as $g): ?>
                                <option value="<?= $g['id_guru'] ?>" <?= $row['id_guru'] == $g['id_guru'] ? 'selected' : '' ?>><?= $g['nama_lengkap'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal Sekolah/Universitas</label>
                        <input type="text" class="form-control modern-input" name="asal_sekolah" value="<?= $row['asal_sekolah'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jurusan / Program Studi</label>
                        <input type="text" class="form-control modern-input" name="jurusan" value="<?= $row['jurusan'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Lulus</label>
                        <input type="number" class="form-control modern-input" name="tahun_lulus" value="<?= $row['tahun_lulus'] ?>" required>
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