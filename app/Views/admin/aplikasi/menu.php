<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #4e54c8; background: #fff; box-shadow: 0 0 0 4px rgba(78, 84, 200, 0.15); outline: none; }
</style>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="modern-card bg-white p-4 h-100">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px;">
                    <i class="fas fa-plus fs-5"></i>
                </div>
                <h5 class="fw-bold m-0 text-dark">Tambah Menu</h5>
            </div>
            <form action="<?= base_url('admin/aplikasi/simpan_menu') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Menu</label>
                    <input type="text" class="form-control modern-input" name="nama_menu" placeholder="Contoh: PPDB Online" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Link / URL Tujuan</label>
                    <input type="url" class="form-control modern-input" name="link_eksternal" placeholder="Contoh: https://ppdb.sekolah.sch.id" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Urutan Tampil</label>
                    <input type="number" class="form-control modern-input" name="urutan" placeholder="Contoh: 1" required>
                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Angka terkecil akan tampil paling kiri.</small>
                </div>
                <button type="submit" class="btn text-white w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);">
                    <i class="fas fa-save me-2"></i> Simpan Menu
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="modern-card bg-white p-0 h-100 overflow-hidden">
            <div class="p-4 border-bottom border-light d-flex justify-content-between align-items-center bg-light">
                <h5 class="fw-bold m-0 text-dark"><i class="fas fa-list me-2 text-primary"></i> Daftar Menu Tambahan</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center rounded-start">Urutan</th>
                            <th>Nama Menu</th>
                            <th>Link Tujuan</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($menu) && count($menu) > 0): foreach($menu as $row): ?>
                        <tr>
                            <td class="text-center"><span class="badge bg-secondary rounded-pill px-3"><?= $row['urutan'] ?></span></td>
                            <td class="fw-bold text-dark"><?= $row['nama_menu'] ?></td>
                            <td><a href="<?= $row['link_eksternal'] ?>" target="_blank" class="text-primary text-decoration-none"><i class="fas fa-external-link-alt me-1"></i> Buka Link</a></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_menu'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/aplikasi/hapus_menu/' . $row['id_menu']) ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada menu tambahan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($menu) && count($menu) > 0): foreach($menu as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_menu'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; border: none; overflow: hidden;">
            <div class="modal-header p-4" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Menu Eksternal</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/aplikasi/update_menu/' . $row['id_menu']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Menu</label>
                        <input type="text" class="form-control modern-input" name="nama_menu" value="<?= $row['nama_menu'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Link / URL Tujuan</label>
                        <input type="url" class="form-control modern-input" name="link_eksternal" value="<?= $row['link_eksternal'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Urutan Tampil</label>
                        <input type="number" class="form-control modern-input" name="urutan" value="<?= $row['urutan'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0 hover-lift" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>