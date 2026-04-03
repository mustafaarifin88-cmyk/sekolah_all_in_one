<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: none; }
    .table-modern th { background: #f8fafc; color: #475569; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #ff9a44; background: #fff; box-shadow: 0 0 0 4px rgba(255, 154, 68, 0.2); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: linear-gradient(135deg, #fc6076 0%, #ff9a44 100%); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
    .modal-body-scroll::-webkit-scrollbar { width: 6px; }
    .modal-body-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: linear-gradient(135deg, #fc6076 0%, #ff9a44 100%);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-bullhorn me-2"></i> Papan Pengumuman</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola informasi penting yang akan dilihat seluruh siswa & guru.</p>
                </div>
                <button class="btn btn-white text-danger rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Buat Pengumuman
                </button>
            </div>
        </div>

        <div class="modern-card bg-white p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Judul Pengumuman</th>
                            <th width="20%">Kategori</th>
                            <th width="15%" class="text-center">Tanggal Dibuat</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($pengumuman) && count($pengumuman) > 0): foreach($pengumuman as $key => $row): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark fs-6"><?= $row['judul_pengumuman'] ?></td>
                            <td>
                                <?php 
                                    $nama_kat = 'Umum';
                                    if(isset($kategori_list)) {
                                        foreach($kategori_list as $kl) {
                                            if($kl['id_kategori_p'] == $row['id_kategori_p']) {
                                                $nama_kat = $kl['nama_kategori']; break;
                                            }
                                        }
                                    }
                                ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill"><?= $nama_kat ?></span>
                            </td>
                            <td class="text-center text-secondary"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_pengumuman'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/informasi/hapus_pengumuman/' . $row['id_pengumuman']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-bullhorn fs-1 mb-3 opacity-50 d-block"></i>Belum ada data pengumuman.</td></tr>
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
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-pen-fancy me-2"></i> Tulis Pengumuman Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/informasi/simpan_pengumuman') ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Pengumuman</label>
                                    <input type="text" class="form-control modern-input" name="judul_pengumuman" placeholder="Contoh: Libur Nasional Idul Fitri" required>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 mb-3">Isi Pengumuman</label>
                                    <textarea class="summernote" name="isi_pengumuman" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-tags text-danger me-2"></i>Kategori & Setting</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Kategori</label>
                                    <select class="form-control modern-input" name="id_kategori_p" required>
                                        <option value="">-- Kategori --</option>
                                        <?php if(isset($kategori_list)): foreach($kategori_list as $kat): ?>
                                            <option value="<?= $kat['id_kategori_p'] ?>"><?= $kat['nama_kategori'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="alert alert-warning border-0 shadow-sm rounded-4 mt-4 bg-warning bg-opacity-10 text-dark">
                                    <i class="fas fa-info-circle mb-2 fs-4 text-warning"></i><br>
                                    <small class="fw-semibold">Pengumuman akan langsung terlihat di halaman depan website pengunjung setelah disimpan.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: linear-gradient(135deg, #fc6076 0%, #ff9a44 100%);"><i class="fas fa-paper-plane me-2"></i> Publikasikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($pengumuman) && count($pengumuman) > 0): foreach($pengumuman as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_pengumuman'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Pengumuman</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/informasi/update_pengumuman/' . $row['id_pengumuman']) ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Pengumuman</label>
                                    <input type="text" class="form-control modern-input" name="judul_pengumuman" value="<?= $row['judul_pengumuman'] ?>" required>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 mb-3">Isi Pengumuman</label>
                                    <textarea class="summernote" name="isi_pengumuman" required><?= $row['isi_pengumuman'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-tags text-danger me-2"></i>Kategori & Setting</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Kategori</label>
                                    <select class="form-control modern-input" name="id_kategori_p" required>
                                        <option value="">-- Kategori --</option>
                                        <?php if(isset($kategori_list)): foreach($kategori_list as $kat): ?>
                                            <option value="<?= $kat['id_kategori_p'] ?>" <?= $row['id_kategori_p'] == $kat['id_kategori_p'] ? 'selected' : '' ?>><?= $kat['nama_kategori'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="alert alert-warning border-0 shadow-sm rounded-4 mt-4 bg-warning bg-opacity-10 text-dark">
                                    <i class="fas fa-info-circle mb-2 fs-4 text-warning"></i><br>
                                    <small class="fw-semibold">Perubahan akan langsung diterapkan di halaman utama website.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: linear-gradient(135deg, #fc6076 0%, #ff9a44 100%);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<script>
    window.addEventListener("load", function() {
        $('.summernote').summernote({
            height: 350,
            placeholder: 'Tuliskan isi pengumuman di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<?= $this->endSection() ?>