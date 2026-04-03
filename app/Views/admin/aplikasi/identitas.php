<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        --theme-shadow: rgba(78, 84, 200, 0.15);
        --theme-color: #4e54c8;
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: none; background: #fff; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: var(--theme-color); background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .upload-box { border: 2px dashed #cbd5e1; border-radius: 15px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: #f8fafc; position: relative; }
    .upload-box:hover { border-color: var(--theme-color); background: #f1f5f9; }
    .upload-box input[type="file"] { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .preview-img { max-width: 100%; max-height: 150px; border-radius: 10px; margin-top: 15px; display: none; }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                    <i class="fas fa-school fs-3"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold mb-1">Identitas Sekolah</h4>
                    <p class="mb-0 opacity-75 fs-7">Atur nama, alamat, dan logo sekolah yang akan digunakan pada sistem dan kop surat.</p>
                </div>
            </div>
        </div>

        <div class="modern-card p-4 p-md-5">
            <form action="<?= base_url('admin/aplikasi/update_identitas') ?>" method="post" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Sekolah</label>
                        <input type="text" class="form-control modern-input" name="nama_sekolah" value="<?= $identitas['nama_sekolah'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Nama Dinas (Kop Surat)</label>
                        <input type="text" class="form-control modern-input" name="nama_dinas" value="<?= $identitas['nama_dinas'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Alamat Sekolah Lengkap</label>
                        <textarea class="form-control modern-input" name="alamat_sekolah" rows="3" required><?= $identitas['alamat_sekolah'] ?? '' ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Logo Sekolah (PNG Transparan)</label>
                        <div class="upload-box">
                            <input type="file" name="logo_sekolah" accept="image/png" onchange="previewFile(this, 'preview_logo')">
                            <i class="fas fa-cloud-upload-alt fs-2 text-primary mb-2"></i>
                            <p class="mb-0 fw-semibold text-secondary">Klik atau Drag file Logo di sini</p>
                            <?php if(!empty($identitas['logo_sekolah'])): ?>
                                <img src="<?= base_url('uploads/identitas/' . $identitas['logo_sekolah']) ?>" id="preview_logo" class="preview-img" style="display: block; margin: 15px auto 0;">
                            <?php else: ?>
                                <img id="preview_logo" class="preview-img" style="margin: 15px auto 0;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Logo Pemda (PNG Transparan)</label>
                        <div class="upload-box">
                            <input type="file" name="logo_pemda" accept="image/png" onchange="previewFile(this, 'preview_pemda')">
                            <i class="fas fa-cloud-upload-alt fs-2 text-primary mb-2"></i>
                            <p class="mb-0 fw-semibold text-secondary">Klik atau Drag file Logo Pemda di sini</p>
                            <?php if(!empty($identitas['logo_pemda'])): ?>
                                <img src="<?= base_url('uploads/identitas/' . $identitas['logo_pemda']) ?>" id="preview_pemda" class="preview-img" style="display: block; margin: 15px auto 0;">
                            <?php else: ?>
                                <img id="preview_pemda" class="preview-img" style="margin: 15px auto 0;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-end border-top pt-4">
                    <button type="submit" class="btn text-white rounded-pill px-5 py-2 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);">
                        <i class="fas fa-save me-2"></i> SIMPAN IDENTITAS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewFile(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById(previewId).style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>