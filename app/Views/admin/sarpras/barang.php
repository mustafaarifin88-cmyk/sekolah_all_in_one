<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #11998e;
        --theme-shadow: rgba(17, 153, 142, 0.15);
        --theme-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-boxes me-2"></i> Database Inventaris Sekolah</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola pencatatan aset barang sarana prasarana.</p>
                </div>
                <button class="btn btn-white text-success rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Input Aset Baru
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Barang / Aset</th>
                            <th>Lokasi Penempatan</th>
                            <th class="text-center">Kondisi Awal</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($barang) && count($barang) > 0): foreach($barang as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_barang'] ?></div>
                                <span class="badge bg-light text-dark border px-2 py-1 mt-1"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal_masuk'])) ?></span>
                            </td>
                            <td>
                                <?php 
                                    $nama_ruang = 'Tidak diketahui';
                                    if(isset($ruang)) { foreach($ruang as $r) { if($r['id_ruang'] == $row['id_ruang']) { $nama_ruang = $r['nama_ruang']; break; } } }
                                ?>
                                <span class="fw-semibold text-secondary"><i class="fas fa-map-marker-alt text-danger me-1"></i> <?= $nama_ruang ?></span>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $nama_kondisi = 'Status N/A';
                                    if(isset($kondisi)) { foreach($kondisi as $k) { if($k['id_kondisi'] == $row['id_kondisi']) { $nama_kondisi = $k['nama_kondisi']; break; } } }
                                ?>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill"><?= $nama_kondisi ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_barang'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/sarpras/hapus_barang/' . $row['id_barang']) ?>" onclick="return confirm('Hapus aset ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-box-open fs-1 mb-3 opacity-50 d-block"></i>Belum ada data inventaris terdaftar.</td></tr>
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
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-box me-2"></i> Input Aset Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/sarpras/simpan_barang') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Barang Masuk</label>
                        <input type="date" class="form-control modern-input" name="tanggal_masuk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Barang</label>
                        <input type="text" class="form-control modern-input" name="nama_barang" placeholder="Spesifikasi / Merk" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Lokasi Ruang</label>
                            <select name="id_ruang" class="form-control modern-input" required>
                                <option value="">-- Pilih Lokasi --</option>
                                <?php if(isset($ruang)): foreach($ruang as $r): ?>
                                    <option value="<?= $r['id_ruang'] ?>"><?= $r['nama_ruang'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kondisi Awal</label>
                            <select name="id_kondisi" class="form-control modern-input" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <?php if(isset($kondisi)): foreach($kondisi as $k): ?>
                                    <option value="<?= $k['id_kondisi'] ?>"><?= $k['nama_kondisi'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($barang) && count($barang) > 0): foreach($barang as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_barang'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Data Inventaris</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/sarpras/update_barang/' . $row['id_barang']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Barang Masuk</label>
                        <input type="date" class="form-control modern-input" name="tanggal_masuk" value="<?= $row['tanggal_masuk'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Barang</label>
                        <input type="text" class="form-control modern-input" name="nama_barang" value="<?= $row['nama_barang'] ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Lokasi Ruang</label>
                            <select name="id_ruang" class="form-control modern-input" required>
                                <?php if(isset($ruang)): foreach($ruang as $r): ?>
                                    <option value="<?= $r['id_ruang'] ?>" <?= $row['id_ruang'] == $r['id_ruang'] ? 'selected' : '' ?>><?= $r['nama_ruang'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kondisi Saat Ini</label>
                            <select name="id_kondisi" class="form-control modern-input" required>
                                <?php if(isset($kondisi)): foreach($kondisi as $k): ?>
                                    <option value="<?= $k['id_kondisi'] ?>" <?= $row['id_kondisi'] == $k['id_kondisi'] ? 'selected' : '' ?>><?= $k['nama_kondisi'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>