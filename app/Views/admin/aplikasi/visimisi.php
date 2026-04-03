<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .header-gradient {
        background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
        padding: 25px 30px;
        color: white;
    }
    .note-editor.note-frame {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .note-toolbar {
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
</style>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="modern-card">
            <div class="header-gradient d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                    <i class="fas fa-bullseye fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">Visi & Misi Sekolah</h4>
                    <p class="mb-0 opacity-75 fs-7">Ubah dan sesuaikan teks visi misi untuk halaman beranda pengunjung.</p>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="<?= base_url('admin/aplikasi/update_visimisi') ?>" method="post">
                    <div class="form-group mb-4">
                        <label class="fw-bold text-dark mb-2 fs-6">Konten Visi & Misi</label>
                        <textarea name="visi_misi" class="summernote" required><?= $visimisi['visi_misi'] ?? '' ?></textarea>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-danger rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift text-uppercase tracking-wider">
                            <i class="fas fa-save me-2"></i> Publikasikan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>