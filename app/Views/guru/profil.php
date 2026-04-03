<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(-45deg, #11998e, #38ef7d);
        --theme-shadow: rgba(17, 153, 142, 0.2);
    }
    .profile-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; background: #fff; }
    .profile-header { background: var(--theme-gradient); height: 160px; position: relative; }
    .profile-avatar-wrapper { position: relative; margin-top: -65px; text-align: center; }
    .profile-avatar { width: 140px; height: 140px; border-radius: 50%; border: 5px solid #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.1); object-fit: cover; background: #fff; }
    .upload-btn { position: absolute; bottom: 5px; right: calc(50% - 50px); background: #fff; color: #11998e; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); cursor: pointer; transition: 0.3s; }
    .upload-btn:hover { background: #11998e; color: #fff; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 14px 20px; font-weight: 500; background: #f8fafc; transition: all 0.3s; }
    .modern-input:focus { border-color: #11998e; background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="profile-card pb-5">
            <div class="profile-header d-flex justify-content-end p-3"></div>
            <div class="profile-avatar-wrapper">
                <img id="preview-avatar" src="<?= base_url('uploads/profil/' . ($profil['foto'] ?? 'default.png')) ?>" alt="Avatar" class="profile-avatar">
                <label for="upload-foto" class="upload-btn">
                    <i class="fas fa-camera"></i>
                </label>
            </div>
            
            <div class="text-center mt-3 mb-5">
                <h4 class="fw-bold text-dark m-0"><?= $profil['username'] ?? 'User' ?></h4>
                <p class="text-muted fw-semibold mb-0"><i class="fas fa-chalkboard-teacher me-1 text-success"></i> Guru / Tenaga Pendidik</p>
            </div>

            <div class="px-4 px-md-5">
                <form action="<?= base_url('guru/profil/update') ?>" method="post" enctype="multipart/form-data">
                    <input type="file" id="upload-foto" name="foto" class="d-none" accept="image/*" onchange="previewFile(this, 'preview-avatar')">
                    
                    <div class="mb-4">
                        <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase tracking-wider">Username Login</label>
                        <input type="text" class="form-control modern-input w-100" name="username" value="<?= $profil['username'] ?? '' ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-secondary mb-2 fs-7 text-uppercase tracking-wider">Password Baru (Opsional)</label>
                        <input type="password" class="form-control modern-input w-100" name="password" placeholder="Kosongkan jika tidak ingin mengubah sandi">
                        <small class="text-muted mt-2 d-block"><i class="fas fa-shield-alt me-1 text-warning"></i> Biarkan kosong jika tidak mengganti password.</small>
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);">
                            <i class="fas fa-check-circle me-2"></i> SIMPAN PEMBARUAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>