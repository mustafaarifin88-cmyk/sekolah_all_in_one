<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        --theme-shadow: rgba(253, 160, 133, 0.15);
        --theme-color: #fda085;
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
    .modal-body-scroll::-webkit-scrollbar { width: 6px; }
    .modal-body-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-dark">
                    <h4 class="fw-bold mb-1"><i class="fas fa-bullhorn me-2"></i> Papan Pengumuman</h4>
                    <p class="mb-0 opacity-75 fs-7 text-dark fw-semibold">Kelola informasi publik yang Anda bagikan.</p>
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
                            <th width="20%" class="text-center">Tanggal Dibuat</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($pengumuman) && count($pengumuman) > 0): foreach($pengumuman as $key => $row): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark fs-6"><?= $row['judul_pengumuman'] ?></td>
                            <td class="text-center text-secondary"><i class="far fa-calendar-alt me-1 text-warning"></i> <?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_pengumuman'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('guru/informasi/hapus_pengumuman/' . $row['id_pengumuman']) ?>" onclick="return confirm('Hapus pengumuman ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-bullhorn fs-1 mb-3 opacity-50 d-block"></i>Belum ada data pengumuman dibuat.</td></tr>
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
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-pen-fancy me-2"></i> Tulis Pengumuman Baru</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('guru/informasi/simpan_pengumuman') ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Judul Pengumuman</label>
                            <input type="text" class="form-control modern-input" name="judul_pengumuman" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 mb-3">Isi Pengumuman</label>
                            <textarea class="summernote" name="isi_pengumuman" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-dark rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-paper-plane me-2"></i> Publikasikan</button>
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
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Pengumuman</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('guru/informasi/update_pengumuman/' . $row['id_pengumuman']) ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
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
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-dark rounded-pill px-5 fw-bold shadow-lg hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<script>
    window.addEventListener("load", function() {
        $('.summernote').summernote({ height: 350, toolbar: [ ['style', ['bold', 'italic', 'underline']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['fullscreen', 'codeview']] ] });
    });
</script>
<?= $this->endSection() ?>