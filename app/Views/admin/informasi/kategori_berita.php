<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; }
    .table-modern th { background: #f8fafc; color: #475569; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; }
    .modern-input:focus { border-color: #4facfe; background: #fff; box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.2); outline: none; }
</style>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="modern-card bg-white p-4 h-100">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px;">
                    <i class="fas fa-plus fs-5"></i>
                </div>
                <h5 class="fw-bold m-0 text-dark">Tambah Kategori</h5>
            </div>
            <form action="<?= base_url('admin/informasi/simpan_kategori_berita') ?>" method="post">
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Kategori Berita</label>
                    <input type="text" class="form-control modern-input" name="nama_kategori" placeholder="Contoh: Prestasi Sekolah" required>
                </div>
                <button type="submit" class="btn text-white w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-save me-2"></i> Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="modern-card bg-white p-0 h-100 overflow-hidden">
            <div class="p-4 border-bottom border-light d-flex justify-content-between align-items-center bg-light">
                <h5 class="fw-bold m-0 text-dark"><i class="fas fa-list me-2 text-primary"></i> Daftar Kategori Berita</h5>
                <span class="badge bg-primary rounded-pill fs-7 px-3 py-2"><?= isset($kategori) ? count($kategori) : 0 ?> Kategori</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Kategori</th>
                            <th width="20%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($kategori) && count($kategori) > 0): foreach($kategori as $key => $row): ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['nama_kategori'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1" data-toggle="modal" data-target="#modalEdit<?= $row['id_kategori_b'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/informasi/hapus_kategori_berita/' . $row['id_kategori_b']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada data kategori.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($kategori) && count($kategori) > 0): foreach($kategori as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_kategori_b'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Kategori Berita</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/informasi/update_kategori_berita/' . $row['id_kategori_b']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-primary px-3 rounded-start-3"><i class="fas fa-tags"></i></span>
                            <input type="text" class="form-control modern-input rounded-start-0" name="nama_kategori" value="<?= $row['nama_kategori'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>