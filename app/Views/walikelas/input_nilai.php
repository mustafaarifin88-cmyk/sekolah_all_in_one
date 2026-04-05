<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%);
        --theme-shadow: rgba(252, 74, 26, 0.15);
        --theme-color: #fc4a1a;
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: var(--theme-color); background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                        <i class="fas fa-edit fs-3"></i>
                    </div>
                    <div class="text-white">
                        <h4 class="fw-bold m-0">Input Nilai Rapor</h4>
                        <p class="mt-1 mb-0 fs-7 opacity-75">Kelola data nilai siswa untuk mapel yang Anda ampu.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm" data-toggle="modal" data-target="#modalImport"><i class="fas fa-file-excel me-2"></i> Import Excel</button>
                    <button class="btn btn-dark bg-opacity-50 text-white rounded-pill px-4 fw-bold shadow-sm border-0" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus me-2"></i> Tambah Nilai</button>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th width="25%">Nama Siswa</th>
                            <th width="15%" class="text-center">Kelas</th>
                            <th width="20%">Mata Pelajaran</th>
                            <th width="10%" class="text-center">SMT / Tahun</th>
                            <th width="10%" class="text-center">Nilai</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($nilai_rapor) && count($nilai_rapor) > 0): foreach($nilai_rapor as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['nama_siswa'] ?></td>
                            <td class="text-center"><span class="badge bg-warning text-dark px-3 py-1 rounded-pill border"><?= $row['nama_kelas'] ?></span></td>
                            <td class="text-primary fw-semibold"><?= $row['nama_mapel'] ?></td>
                            <td class="text-center text-muted fs-7">SMT <?= $row['semester'] ?><br><?= $row['tahun_ajaran'] ?></td>
                            <td class="text-center"><span class="badge <?= $row['nilai'] >= 75 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-3 py-2 fs-6 shadow-sm"><?= $row['nilai'] ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary border rounded-pill px-3 shadow-sm" data-toggle="modal" data-target="#modalEdit<?= $row['id_nilai'] ?>"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('walikelas/akademik/hapus_nilai/' . $row['id_nilai']) ?>" class="btn btn-sm btn-light text-danger border rounded-pill px-3 shadow-sm" onclick="return confirm('Yakin ingin menghapus nilai ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-clipboard-list fs-1 mb-3 opacity-50 d-block"></i>Belum ada data nilai. Silakan tambahkan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header p-4" style="background: var(--theme-gradient);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-plus-circle me-2"></i> Tambah Nilai Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/akademik/simpan_nilai') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <option value="">-- Silakan Pilih Siswa --</option>
                                <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                    <option value="<?= $s['id_siswa'] ?>"><?= $s['nama_siswa'] ?> (<?= $s['nama_kelas'] ?>)</option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Kelas</label>
                            <select name="id_kelas" class="form-control modern-input" required>
                                <option value="">-- Silakan Pilih Kelas --</option>
                                <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                    <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Mata Pelajaran</label>
                            <select name="id_mapel" class="form-control modern-input" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                <?php if(isset($mapel)): foreach($mapel as $m): ?>
                                    <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Semester</label>
                            <select name="semester" class="form-control modern-input" required>
                                <option value="">- Pilih -</option>
                                <option value="1">1 (Ganjil)</option>
                                <option value="2">2 (Genap)</option>
                                <option value="3">3 (Ganjil)</option>
                                <option value="4">4 (Genap)</option>
                                <option value="5">5 (Ganjil)</option>
                                <option value="6">6 (Genap)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Tahun Ajaran</label>
                            <input type="text" class="form-control modern-input" name="tahun_ajaran" placeholder="Contoh: 2023/2024" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Nilai (0-100)</label>
                            <input type="number" class="form-control modern-input text-primary fw-bold" name="nilai" min="0" max="100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php if(isset($nilai_rapor)): foreach($nilai_rapor as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_nilai'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header p-4" style="background: var(--theme-gradient);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Nilai Siswa</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/akademik/update_nilai/' . $row['id_nilai']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                    <option value="<?= $s['id_siswa'] ?>" <?= $s['id_siswa'] == $row['id_siswa'] ? 'selected' : '' ?>><?= $s['nama_siswa'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Kelas</label>
                            <select name="id_kelas" class="form-control modern-input" required>
                                <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                    <option value="<?= $k['id_kelas'] ?>" <?= $k['id_kelas'] == $row['id_kelas'] ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Mata Pelajaran</label>
                            <select name="id_mapel" class="form-control modern-input" required>
                                <?php if(isset($mapel)): foreach($mapel as $m): ?>
                                    <option value="<?= $m['id_mapel'] ?>" <?= $m['id_mapel'] == $row['id_mapel'] ? 'selected' : '' ?>><?= $m['nama_mapel'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Semester</label>
                            <select name="semester" class="form-control modern-input" required>
                                <option value="1" <?= $row['semester'] == '1' ? 'selected' : '' ?>>1 (Ganjil)</option>
                                <option value="2" <?= $row['semester'] == '2' ? 'selected' : '' ?>>2 (Genap)</option>
                                <option value="3" <?= $row['semester'] == '3' ? 'selected' : '' ?>>3 (Ganjil)</option>
                                <option value="4" <?= $row['semester'] == '4' ? 'selected' : '' ?>>4 (Genap)</option>
                                <option value="5" <?= $row['semester'] == '5' ? 'selected' : '' ?>>5 (Ganjil)</option>
                                <option value="6" <?= $row['semester'] == '6' ? 'selected' : '' ?>>6 (Genap)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Tahun Ajaran</label>
                            <input type="text" class="form-control modern-input" name="tahun_ajaran" value="<?= $row['tahun_ajaran'] ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Nilai (0-100)</label>
                            <input type="number" class="form-control modern-input text-primary fw-bold" name="nilai" min="0" max="100" value="<?= $row['nilai'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header p-4" style="background: var(--theme-gradient);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-file-excel me-2"></i> Import Nilai via Excel</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('walikelas/akademik/import_nilai') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-white text-center">
                    <i class="fas fa-cloud-upload-alt text-success" style="font-size: 4rem; margin-bottom: 15px;"></i>
                    <h6 class="fw-bold mb-3">Pilih File Excel (.xlsx)</h6>
                    <input type="file" class="form-control modern-input" name="file_excel" accept=".xlsx, .xls" required>
                    <small class="text-muted d-block mt-3 text-start">Susunan Kolom Excel:<br>A = id_siswa<br>B = id_kelas<br>C = id_mapel<br>D = semester (Angka 1-6)<br>E = tahun_ajaran<br>F = nilai</small>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0" style="background: var(--theme-gradient);"><i class="fas fa-upload me-2"></i> Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>