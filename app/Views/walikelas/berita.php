<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #6a11cb;
        --theme-shadow: rgba(106, 17, 203, 0.15);
        --theme-gradient: linear-gradient(-45deg, #6a11cb, #2575fc);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: var(--theme-color); background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: var(--theme-gradient); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-newspaper me-2"></i> Publikasi Berita (Wali Kelas)</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola berita/kegiatan khusus terkait kelas Anda atau sekolah.</p>
                </div>
                <button class="btn btn-white text-primary rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Tulis Berita
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th width="15%">Thumbnail</th>
                            <th>Judul Berita</th>
                            <th width="15%" class="text-center">Status</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($berita) && count($berita) > 0): foreach($berita as $key => $row): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td><img src="<?= base_url('uploads/berita/' . $row['thumbnail']) ?>" class="img-fluid rounded-3 shadow-sm" style="height: 70px; width: 100px; object-fit: cover;"></td>
                            <td>
                                <div class="fw-bold text-dark fs-6 mb-1"><?= $row['judul_berita'] ?></div>
                                <span class="text-secondary fs-7 line-clamp-1"><?= strip_tags($row['isi_berita']) ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($row['status_publish'] == 'publish'): ?>
                                    <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check-circle me-1"></i> Terbit</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="fas fa-clock me-1"></i> Terjadwal</span><br>
                                    <small class="text-muted d-block mt-1"><?= date('d M Y', strtotime($row['tanggal_publish'])) ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_berita'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('walikelas/informasi/hapus_berita/' . $row['id_berita']) ?>" onclick="return confirm('Hapus berita ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-newspaper fs-1 mb-3 opacity-50 d-block"></i>Belum ada berita yang Anda buat.</td></tr>
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
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-pen-fancy me-2"></i> Tulis Berita Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/informasi/simpan_berita') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Berita</label>
                                    <input type="text" class="form-control modern-input" name="judul_berita" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="summernote" name="isi_berita" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light mb-4">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-cog text-primary me-2"></i>Pengaturan Publikasi</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Status Publikasi</label>
                                    <select class="form-control modern-input" name="status_publish" id="status_publish_tambah" onchange="toggleTanggal(this.value, 'tambah')" required>
                                        <option value="publish">Publikasi Langsung</option>
                                        <option value="schedule">Jadwalkan</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="box_tanggal_tambah" style="display: none;">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Tanggal Tayang</label>
                                    <input type="date" class="form-control modern-input" name="tanggal_publish">
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-image text-primary me-2"></i>Gambar Thumbnail</h6>
                                <div class="mb-3 text-center">
                                    <input type="file" class="form-control modern-input" name="thumbnail" accept="image/*" required onchange="previewFile(this, 'preview_tambah')">
                                    <img id="preview_tambah" class="img-fluid rounded-3 mt-3 shadow-sm" style="display:none; width:100%; height:200px; object-fit:cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-paper-plane me-2"></i> Terbitkan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($berita) && count($berita) > 0): foreach($berita as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_berita'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Berita</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/informasi/update_berita/' . $row['id_berita']) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Berita</label>
                                    <input type="text" class="form-control modern-input" name="judul_berita" value="<?= $row['judul_berita'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="summernote" name="isi_berita" required><?= $row['isi_berita'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light mb-4">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-cog text-primary me-2"></i>Pengaturan Publikasi</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Status Publikasi</label>
                                    <select class="form-control modern-input" name="status_publish" onchange="toggleTanggal(this.value, 'edit', '<?= $row['id_berita'] ?>')" required>
                                        <option value="publish" <?= $row['status_publish'] == 'publish' ? 'selected' : '' ?>>Publikasi Langsung</option>
                                        <option value="schedule" <?= $row['status_publish'] == 'schedule' ? 'selected' : '' ?>>Jadwalkan</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="box_tanggal_edit_<?= $row['id_berita'] ?>" style="<?= $row['status_publish'] == 'schedule' ? 'display: block;' : 'display: none;' ?>">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Tanggal Tayang</label>
                                    <input type="date" class="form-control modern-input" name="tanggal_publish" value="<?= $row['tanggal_publish'] ?>">
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-image text-primary me-2"></i>Gambar Thumbnail</h6>
                                <div class="mb-3 text-center">
                                    <input type="file" class="form-control modern-input" name="thumbnail" accept="image/*" onchange="previewFile(this, 'preview_edit_<?= $row['id_berita'] ?>')">
                                    <img id="preview_edit_<?= $row['id_berita'] ?>" src="<?= base_url('uploads/berita/' . $row['thumbnail']) ?>" class="img-fluid rounded-3 mt-3 shadow-sm" style="width:100%; height:200px; object-fit:cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<script>
    function toggleTanggal(value, type, id = '') {
        let box = document.getElementById('box_tanggal_' + type + (id ? '_' + id : ''));
        box.style.display = (value === 'schedule') ? 'block' : 'none';
    }
    function previewFile(input, previewId) {
        if (input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) { document.getElementById(previewId).src = e.target.result; document.getElementById(previewId).style.display = 'block';}
            reader.readAsDataURL(input.files[0]);
        }
    }
    window.addEventListener("load", function() {
        $('.summernote').summernote({ height: 300, toolbar: [['style', ['bold', 'italic']], ['color', ['color']], ['para', ['ul', 'ol']], ['insert', ['link', 'picture']]] });
    });
</script>
<?= $this->endSection() ?>