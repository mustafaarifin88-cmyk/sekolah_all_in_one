<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #ff0844;
        --theme-shadow: rgba(255, 8, 68, 0.15);
        --theme-gradient: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);
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
                    <h4 class="fw-bold mb-1"><i class="fas fa-tools me-2"></i> Laporan Kerusakan Aset</h4>
                    <p class="mb-0 opacity-75 fs-7">Catat riwayat kerusakan barang untuk bahan evaluasi maintenance.</p>
                </div>
                <button class="btn btn-white text-danger rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Buat Laporan
                </button>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Tanggal Lapor</th>
                            <th>Aset & Deskripsi Kerusakan</th>
                            <th class="text-center">Tingkat Kerusakan</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($kerusakan) && count($kerusakan) > 0): foreach($kerusakan as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td><span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="far fa-calendar-alt me-1 text-danger"></i> <?= date('d M Y', strtotime($row['tanggal_lapor'])) ?></span></td>
                            <td>
                                <?php 
                                    $nama_barang = 'Aset dihapus';
                                    if(isset($barang)) { foreach($barang as $b) { if($b['id_barang'] == $row['id_barang']) { $nama_barang = $b['nama_barang']; break; } } }
                                ?>
                                <div class="fw-bold text-dark fs-6"><?= $nama_barang ?></div>
                                <span class="text-secondary fs-7"><?= $row['keterangan'] ?></span>
                            </td>
                            <td class="text-center">
                                <?php
                                    $color = 'bg-warning text-dark';
                                    if($row['tingkat_kondisi'] == 'Rusak Berat') $color = 'bg-danger text-white';
                                    if($row['tingkat_kondisi'] == 'Rusak Ringan') $color = 'bg-info text-white';
                                ?>
                                <span class="badge <?= $color ?> px-3 py-2 rounded-pill fs-7"><?= $row['tingkat_kondisi'] ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_kerusakan'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/sarpras/hapus_kerusakan/' . $row['id_kerusakan']) ?>" onclick="return confirm('Hapus laporan ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-shield-alt fs-1 mb-3 opacity-50 d-block"></i>Belum ada laporan kerusakan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-tools me-2"></i> Laporan Kerusakan Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/sarpras/simpan_kerusakan') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Barang / Aset</label>
                            <select name="id_barang" class="form-control modern-input" required>
                                <option value="">-- Cari Nama Barang --</option>
                                <?php if(isset($barang)): foreach($barang as $b): ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Dilaporkan</label>
                            <input type="date" class="form-control modern-input" name="tanggal_lapor" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tingkat Keparahan</label>
                            <select name="tingkat_kondisi" class="form-control modern-input" required>
                                <option value="">-- Pilih Level --</option>
                                <option value="Rusak Ringan">Rusak Ringan (Bisa Diperbaiki Sendiri)</option>
                                <option value="Rusak Sedang">Rusak Sedang (Butuh Teknisi)</option>
                                <option value="Rusak Berat">Rusak Berat (Tidak Bisa Dipakai)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kronologi / Rincian Kerusakan</label>
                            <textarea class="form-control modern-input" name="keterangan" rows="3" placeholder="Jelaskan detail kerusakannya..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($kerusakan) && count($kerusakan) > 0): foreach($kerusakan as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_kerusakan'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Laporan Kerusakan</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/sarpras/update_kerusakan/' . $row['id_kerusakan']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Barang / Aset</label>
                            <select name="id_barang" class="form-control modern-input" required>
                                <?php if(isset($barang)): foreach($barang as $b): ?>
                                    <option value="<?= $b['id_barang'] ?>" <?= $row['id_barang'] == $b['id_barang'] ? 'selected' : '' ?>><?= $b['nama_barang'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Dilaporkan</label>
                            <input type="date" class="form-control modern-input" name="tanggal_lapor" value="<?= $row['tanggal_lapor'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tingkat Keparahan</label>
                            <select name="tingkat_kondisi" class="form-control modern-input" required>
                                <option value="Rusak Ringan" <?= $row['tingkat_kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan (Bisa Diperbaiki Sendiri)</option>
                                <option value="Rusak Sedang" <?= $row['tingkat_kondisi'] == 'Rusak Sedang' ? 'selected' : '' ?>>Rusak Sedang (Butuh Teknisi)</option>
                                <option value="Rusak Berat" <?= $row['tingkat_kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat (Tidak Bisa Dipakai)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Kronologi / Rincian Kerusakan</label>
                            <textarea class="form-control modern-input" name="keterangan" rows="3" required><?= $row['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>