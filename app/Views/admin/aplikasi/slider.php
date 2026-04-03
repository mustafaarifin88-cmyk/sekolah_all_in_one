<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<?php helper('text'); ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; }
    .slider-img { border-radius: 12px; object-fit: cover; width: 160px; height: 90px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
    .slider-img:hover { transform: scale(1.05); }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #f6d365; background: #fff; box-shadow: 0 0 0 4px rgba(246, 211, 101, 0.15); outline: none; }
    .upload-box { position: relative; border: 2px dashed #e2e8f0; border-radius: 15px; padding: 30px; text-align: center; background: #f8fafc; transition: all 0.3s ease; cursor: pointer; }
    .upload-box:hover { border-color: #f6d365; background: #fff; }
    .upload-input { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .preview-img { max-width: 100%; height: 200px; object-fit: cover; border-radius: 10px; display: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card bg-white p-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                    <i class="fas fa-images fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Slide Show Homepage</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola gambar banner berjalan di halaman depan website.</p>
                </div>
            </div>
            <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm hover-lift bg-gradient-animated border-0" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus me-2"></i> Tambah Slide Baru
            </button>
        </div>

        <div class="modern-card bg-white p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th width="20%">Gambar</th>
                            <th>Detail Konten</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($slider) && count($slider) > 0): foreach($slider as $key => $row): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td><img src="<?= base_url('uploads/slider/' . $row['foto']) ?>" class="slider-img" alt="Slider"></td>
                            <td>
                                <h6 class="fw-bold text-dark mb-1 fs-6"><?= $row['judul'] ?></h6>
                                <p class="text-muted fs-7 mb-0 line-clamp-2"><?= word_limiter($row['keterangan'], 15) ?></p>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_slider'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/aplikasi/hapus_slider/' . $row['id_slider']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus slide ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-images fs-1 mb-3 opacity-50 d-block"></i>Belum ada gambar slider.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; border: none; overflow: hidden;">
            <div class="modal-header p-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-plus-circle me-2"></i> Tambah Slide Baru</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/aplikasi/simpan_slider') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Judul Slide</label>
                                <input type="text" class="form-control modern-input bg-white" name="judul" placeholder="Contoh: PPDB Telah Dibuka!" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Keterangan Singkat</label>
                                <textarea class="form-control modern-input bg-white" name="keterangan" rows="4" placeholder="Tulis deskripsi singkat..." required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Gambar Banner</label>
                            <div class="upload-box bg-white">
                                <input type="file" name="foto" class="upload-input" accept="image/*" onchange="previewFile(this, 'preview-slider')" required>
                                <div id="icon-slider">
                                    <i class="fas fa-cloud-upload-alt fs-1 text-warning mb-3"></i>
                                    <h6 class="fw-bold text-dark mb-1">Klik atau Drop Gambar</h6>
                                    <span class="text-muted fs-7">Format: JPG, PNG, WEBP</span>
                                </div>
                                <img id="preview-slider" class="preview-img mx-auto" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-white rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-dark shadow-sm bg-gradient-animated border-0 hover-lift">
                        <i class="fas fa-save me-2"></i> Simpan Slider
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($slider) && count($slider) > 0): foreach($slider as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_slider'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; border: none; overflow: hidden;">
            <div class="modal-header p-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Slide</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/aplikasi/update_slider/' . $row['id_slider']) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Judul Slide</label>
                                <input type="text" class="form-control modern-input bg-white" name="judul" value="<?= $row['judul'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Keterangan Singkat</label>
                                <textarea class="form-control modern-input bg-white" name="keterangan" rows="4" required><?= $row['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Gambar Banner</label>
                            <div class="upload-box bg-white">
                                <input type="file" name="foto" class="upload-input" accept="image/*" onchange="previewFile(this, 'preview-slider-<?= $row['id_slider'] ?>')">
                                <div id="icon-slider-<?= $row['id_slider'] ?>" style="display: none;">
                                    <i class="fas fa-cloud-upload-alt fs-1 text-warning mb-3"></i>
                                    <h6 class="fw-bold text-dark mb-1">Ganti Gambar</h6>
                                    <span class="text-muted fs-7">Opsional, biarkan jika tidak diganti</span>
                                </div>
                                <img id="preview-slider-<?= $row['id_slider'] ?>" src="<?= base_url('uploads/slider/' . $row['foto']) ?>" class="preview-img mx-auto" style="display: block;" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-white rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-dark shadow-sm border-0 hover-lift">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<script>
    function previewFile(input, previewId) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById(previewId).style.display = 'block';
                var iconId = previewId.replace('preview', 'icon');
                if(document.getElementById(iconId)) {
                    document.getElementById(iconId).style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>