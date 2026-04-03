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
    .modal-header-custom { background: var(--theme-gradient); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-edit me-2"></i> Input Nilai Akademik</h4>
                    <p class="mb-0 opacity-75 fs-7">Pilih Kelas lalu Mata Pelajaran untuk mulai menginput nilai.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-white text-success rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalImport">
                        <i class="fas fa-file-excel me-2"></i> Import Nilai
                    </button>
                    <button class="btn btn-white text-danger rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                        <i class="fas fa-plus me-2"></i> Input Manual
                    </button>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Siswa & Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Periode</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($rapor) && count($rapor) > 0): foreach($rapor as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></div>
                                <span class="badge bg-light text-dark border px-2 py-1 mt-1"><i class="fas fa-door-open text-primary me-1"></i> <?= $row['nama_kelas'] ?></span>
                            </td>
                            <td><span class="fw-bold" style="color: var(--theme-color);"><?= $row['nama_mapel'] ?></span></td>
                            <td class="text-secondary fs-7 fw-semibold"><?= $row['tahun_ajaran'] ?><br>Semester <?= $row['semester'] ?></td>
                            <td class="text-center">
                                <span class="badge <?= $row['nilai'] >= 75 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-4 py-2 fs-5 shadow-sm"><?= $row['nilai'] ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_nilai'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url(session()->get('role').'/akademik/hapus_nilai/' . $row['id_nilai']) ?>" onclick="return confirm('Hapus nilai ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-file-signature fs-1 mb-3 opacity-50 d-block"></i>Belum ada data nilai yang diinput.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Nilai Dikelompokkan Berdasarkan Kelas -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-plus-circle me-2"></i> Input Nilai Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url(session()->get('role').'/akademik/simpan_nilai') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Tugas Mengajar (Kelas -> Mapel)</label>
                            <select name="tugas_mengajar" class="form-control modern-input" required>
                                <option value="">-- Pilih Kelas & Mapel --</option>
                                <?php 
                                if(isset($tugas)): 
                                    $currentKelas = '';
                                    foreach($tugas as $t): 
                                        if($currentKelas !== $t['nama_kelas']) {
                                            if($currentKelas !== '') echo '</optgroup>';
                                            echo '<optgroup label="Kelas ' . $t['nama_kelas'] . '">';
                                            $currentKelas = $t['nama_kelas'];
                                        }
                                ?>
                                    <option value="<?= $t['id_kelas'].'-'.$t['id_mapel'] ?>">Mata Pelajaran: <?= $t['nama_mapel'] ?></option>
                                <?php 
                                    endforeach; 
                                    if($currentKelas !== '') echo '</optgroup>';
                                endif; 
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pilih Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <option value="">-- Nama Siswa --</option>
                                <?php 
                                if(isset($siswa)): 
                                    $currentKelasSiswa = '';
                                    foreach($siswa as $s): 
                                        $kelasNama = 'Kelas ID: ' . $s['id_kelas'];
                                        if($currentKelasSiswa !== $kelasNama) {
                                            if($currentKelasSiswa !== '') echo '</optgroup>';
                                            echo '<optgroup label="' . $kelasNama . '">';
                                            $currentKelasSiswa = $kelasNama;
                                        }
                                ?>
                                    <option value="<?= $s['id_siswa'] ?>"><?= $s['nama_siswa'] ?></option>
                                <?php 
                                    endforeach; 
                                    if($currentKelasSiswa !== '') echo '</optgroup>';
                                endif; 
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ajaran</label>
                            <input type="text" class="form-control modern-input" name="tahun_ajaran" placeholder="Ex: 2025/2026" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Semester</label>
                            <select class="form-control modern-input" name="semester" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nilai Akhir</label>
                            <input type="number" step="0.01" class="form-control modern-input fw-bold text-success fs-5" name="nilai" placeholder="0-100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm border" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($rapor) && count($rapor) > 0): foreach($rapor as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_nilai'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Data Nilai</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url(session()->get('role').'/akademik/update_nilai/' . $row['id_nilai']) ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tugas Mengajar (Kelas -> Mapel)</label>
                            <select name="tugas_mengajar" class="form-control modern-input" required>
                                <?php 
                                if(isset($tugas)): 
                                    $currentKelas = '';
                                    foreach($tugas as $t): 
                                        if($currentKelas !== $t['nama_kelas']) {
                                            if($currentKelas !== '') echo '</optgroup>';
                                            echo '<optgroup label="Kelas ' . $t['nama_kelas'] . '">';
                                            $currentKelas = $t['nama_kelas'];
                                        }
                                        $selected = ($row['id_kelas'] == $t['id_kelas'] && $row['id_mapel'] == $t['id_mapel']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $t['id_kelas'].'-'.$t['id_mapel'] ?>" <?= $selected ?>>Mata Pelajaran: <?= $t['nama_mapel'] ?></option>
                                <?php 
                                    endforeach; 
                                    if($currentKelas !== '') echo '</optgroup>';
                                endif; 
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Siswa</label>
                            <select name="id_siswa" class="form-control modern-input" required>
                                <?php if(isset($siswa)): foreach($siswa as $s): ?>
                                    <option value="<?= $s['id_siswa'] ?>" <?= $row['id_siswa'] == $s['id_siswa'] ? 'selected' : '' ?>><?= $s['nama_siswa'] ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ajaran</label>
                            <input type="text" class="form-control modern-input" name="tahun_ajaran" value="<?= $row['tahun_ajaran'] ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Semester</label>
                            <select class="form-control modern-input" name="semester" required>
                                <option value="Ganjil" <?= $row['semester'] == 'Ganjil' ? 'selected' : '' ?>>Ganjil</option>
                                <option value="Genap" <?= $row['semester'] == 'Genap' ? 'selected' : '' ?>>Genap</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nilai Akhir</label>
                            <input type="number" step="0.01" class="form-control modern-input fw-bold text-success fs-5" name="nilai" value="<?= $row['nilai'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0 hover-lift" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Update Nilai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4" style="background: var(--theme-gradient);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-file-excel me-2"></i> Import Nilai via Excel</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url(session()->get('role').'/akademik/import_nilai') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-white text-center">
                    <i class="fas fa-cloud-upload-alt text-success" style="font-size: 4rem; margin-bottom: 15px;"></i>
                    <h6 class="fw-bold mb-3">Pilih File Excel (.xlsx)</h6>
                    <input type="file" class="form-control modern-input" name="file_excel" accept=".xlsx, .xls" required>
                    <a href="#" class="d-block mt-3 text-decoration-none fw-semibold text-danger"><i class="fas fa-download me-1"></i> Download Template Kosong</a>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0 hover-lift" style="background: var(--theme-gradient);"><i class="fas fa-upload me-2"></i> Mulai Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>