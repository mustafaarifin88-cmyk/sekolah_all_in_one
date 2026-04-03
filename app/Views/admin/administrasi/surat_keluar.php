<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #00c6ff;
        --theme-shadow: rgba(0, 198, 255, 0.15);
        --theme-gradient: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
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
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
    .modal-body-scroll::-webkit-scrollbar { width: 6px; }
    .modal-body-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-paper-plane me-2"></i> Arsip Surat Keluar</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola pencatatan surat yang dikeluarkan oleh sekolah.</p>
                </div>
                <button class="btn btn-white text-info rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Buat Surat Keluar
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>No & Tgl Surat</th>
                            <th>Tujuan & Perihal</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($surat_keluar) && count($surat_keluar) > 0): foreach($surat_keluar as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= $row['nomor_surat'] ?></div>
                                <span class="text-muted fs-7"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal_surat'])) ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-info fs-6"><?= $row['tujuan_surat'] ?></div>
                                <span class="text-secondary fs-7 line-clamp-1"><?= strip_tags($row['perihal']) ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($row['lampiran']): ?>
                                    <a href="<?= base_url('uploads/surat_keluar/' . $row['lampiran']) ?>" target="_blank" class="btn btn-sm btn-light text-success rounded-circle shadow-sm me-1 hover-lift" title="Unduh Lampiran" style="width:35px; height:35px;"><i class="fas fa-download"></i></a>
                                <?php endif; ?>
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_surat_keluar'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/administrasi/hapus_surat_keluar/' . $row['id_surat_keluar']) ?>" onclick="return confirm('Hapus surat ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-folder fs-1 mb-3 opacity-50 d-block"></i>Belum ada data surat keluar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-paper-plane me-2"></i> Form Surat Keluar</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/administrasi/simpan_surat_keluar') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kode Surat</label>
                            <select name="id_kode_surat" class="form-control modern-input" required>
                                <option value="">-- Pilih Kode --</option>
                                <?php if(isset($kode_surat)): foreach($kode_surat as $ks): ?>
                                    <option value="<?= $ks['id_kode_surat'] ?>"><?= $ks['kode'] ?> - <?= $ks['keterangan'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor Surat</label>
                            <input type="text" class="form-control modern-input" name="nomor_surat" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Surat</label>
                            <input type="date" class="form-control modern-input" name="tanggal_surat" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Sifat Surat</label>
                            <select name="id_sifat_surat" class="form-control modern-input" required>
                                <option value="">-- Pilih Sifat --</option>
                                <?php if(isset($sifat_surat)): foreach($sifat_surat as $ss): ?>
                                    <option value="<?= $ss['id_sifat_surat'] ?>"><?= $ss['sifat'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tujuan Surat</label>
                            <input type="text" class="form-control modern-input" name="tujuan_surat" placeholder="Instansi/Orang yang dituju" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Isi Ringkas / Perihal</label>
                            <textarea class="summernote" name="perihal" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Upload Lampiran (PDF/Gambar)</label>
                            <input type="file" class="form-control modern-input bg-white" name="lampiran" accept=".pdf,image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($surat_keluar) && count($surat_keluar) > 0): foreach($surat_keluar as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_surat_keluar'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Surat Keluar</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/administrasi/update_surat_keluar/' . $row['id_surat_keluar']) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kode Surat</label>
                            <select name="id_kode_surat" class="form-control modern-input" required>
                                <?php if(isset($kode_surat)): foreach($kode_surat as $ks): ?>
                                    <option value="<?= $ks['id_kode_surat'] ?>" <?= $row['id_kode_surat'] == $ks['id_kode_surat'] ? 'selected' : '' ?>><?= $ks['kode'] ?> - <?= $ks['keterangan'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor Surat</label>
                            <input type="text" class="form-control modern-input" name="nomor_surat" value="<?= $row['nomor_surat'] ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Surat</label>
                            <input type="date" class="form-control modern-input" name="tanggal_surat" value="<?= $row['tanggal_surat'] ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Sifat Surat</label>
                            <select name="id_sifat_surat" class="form-control modern-input" required>
                                <?php if(isset($sifat_surat)): foreach($sifat_surat as $ss): ?>
                                    <option value="<?= $ss['id_sifat_surat'] ?>" <?= $row['id_sifat_surat'] == $ss['id_sifat_surat'] ? 'selected' : '' ?>><?= $ss['sifat'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tujuan Surat</label>
                            <input type="text" class="form-control modern-input" name="tujuan_surat" value="<?= $row['tujuan_surat'] ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Isi Ringkas / Perihal</label>
                            <textarea class="summernote" name="perihal" required><?= $row['perihal'] ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Ganti Lampiran</label>
                            <input type="file" class="form-control modern-input bg-white" name="lampiran" accept=".pdf,image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<script>
    window.addEventListener("load", function() {
        $('.summernote').summernote({ height: 250, toolbar: [ ['style', ['bold', 'italic']], ['list', ['ul', 'ol']] ] });
    });
</script>
<?= $this->endSection() ?>