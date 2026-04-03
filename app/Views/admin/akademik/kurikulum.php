<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #4facfe; background: #fff; box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.15); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-book-open me-2"></i> Manajemen Kurikulum</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola data kurikulum yang digunakan di sekolah.</p>
                </div>
                <button class="btn btn-white text-info rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Tambah Kurikulum
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Kurikulum</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($kurikulum) && count($kurikulum) > 0): foreach($kurikulum as $key => $row): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['nama_kurikulum'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1" data-toggle="modal" data-target="#modalEdit<?= $row['id_kurikulum'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/akademik/hapus_kurikulum/' . $row['id_kurikulum']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kurikulum ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center py-5 text-muted"><i class="fas fa-folder-open fs-1 mb-3 opacity-50 d-block"></i>Belum ada data kurikulum.</td></tr>
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
            <div class="modal-header modal-header-custom p-4" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-plus-circle me-2"></i> Tambah Kurikulum</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/simpan_kurikulum') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Kurikulum Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-info px-3 rounded-start-3"><i class="fas fa-book-open"></i></span>
                            <input type="text" class="form-control modern-input rounded-start-0" name="nama_kurikulum" placeholder="Contoh: Kurikulum Merdeka" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);"><i class="fas fa-save me-2"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($kurikulum) && count($kurikulum) > 0): foreach($kurikulum as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_kurikulum'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-4" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Kurikulum</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/update_kurikulum/' . $row['id_kurikulum']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Kurikulum</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-info px-3 rounded-start-3"><i class="fas fa-book-open"></i></span>
                            <input type="text" class="form-control modern-input rounded-start-0" name="nama_kurikulum" value="<?= $row['nama_kurikulum'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<?= $this->endSection() ?>