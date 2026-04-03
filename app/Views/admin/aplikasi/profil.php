<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .profile-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; background: #fff; }
    .profile-header { background: linear-gradient(-45deg, #6a11cb, #2575fc); height: 150px; position: relative; }
    .profile-avatar-wrapper { position: relative; margin-top: -60px; text-align: center; }
    .profile-avatar { width: 130px; height: 130px; border-radius: 50%; border: 5px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); object-fit: cover; background: #fff; }
    .upload-btn { position: absolute; bottom: 5px; right: calc(50% - 45px); background: #fff; color: #2575fc; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); cursor: pointer; transition: 0.3s; }
    .upload-btn:hover { background: #2575fc; color: #fff; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: 0.3s; }
    .modern-input:focus { border-color: #2575fc; background: #fff; box-shadow: 0 0 0 4px rgba(37, 117, 252, 0.1); outline: none; }
</style>

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="profile-card">
            <div class="profile-header bg-gradient-animated"></div>
            <div class="card-body px-5 pb-5 pt-0">
                <form action="<?= base_url('admin/aplikasi/update_profil') ?>" method="post" enctype="multipart/form-data">
                    <div class="profile-avatar-wrapper mb-4">
                        <img src="<?= base_url('uploads/profil/' . ($profil['foto'] ?? 'default.png')) ?>" id="preview-foto" class="profile-avatar">
                        <label for="foto_upload" class="upload-btn"><i class="fas fa-camera"></i></label>
                        <input type="file" id="foto_upload" name="foto" class="d-none" accept="image/*" onchange="previewFile(this, 'preview-foto')">
                        <h4 class="fw-bold text-dark mt-3 mb-1"><?= $profil['username'] ?? 'Administrator' ?></h4>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill text-uppercase tracking-wider"><?= session()->get('role') ?></span>
                    </div>

                    <hr class="border-light opacity-50 mb-4">

                    <div class="mb-4">
                        <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase tracking-wider">Username Login</label>
                        <input type="text" class="form-control modern-input w-100" name="username" value="<?= $profil['username'] ?? '' ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase tracking-wider">Password Baru (Opsional)</label>
                        <input type="password" class="form-control modern-input w-100" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Gunakan kombinasi huruf dan angka agar lebih aman.</small>
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-lg hover-lift border-0" style="background: linear-gradient(90deg, #6a11cb, #2575fc);">SIMPAN PROFIL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile(input, previewId) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
<?= $this->endSection() ?>