<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(-45deg, #4e54c8, #8f94fb);
        --theme-shadow: rgba(78, 84, 200, 0.15);
        --theme-color: #4e54c8;
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
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
</style>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="modern-card p-4 h-100 border">
            <div class="d-flex align-items-center mb-4">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 45px; height: 45px; background: var(--theme-gradient);">
                    <i class="fas fa-chalkboard-teacher fs-5"></i>
                </div>
                <h5 class="fw-bold m-0 text-dark">Tugas & Jadwal Guru</h5>
            </div>
            <form action="<?= base_url('admin/aplikasi/simpan_set_mapel') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Pilih Kelas</label>
                    <select name="id_kelas" class="form-control modern-input" required>
                        <option value="">-- Kelas Mengajar --</option>
                        <?php if(isset($kelas)): foreach($kelas as $k): ?>
                            <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Mata Pelajaran</label>
                    <select name="id_mapel" class="form-control modern-input" required>
                        <option value="">-- Pilih Mapel --</option>
                        <?php if(isset($mapel)): foreach($mapel as $m): ?>
                            <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Guru Pengampu</label>
                    <select name="id_guru" class="form-control modern-input" required>
                        <option value="">-- Nama Guru --</option>
                        <?php if(isset($guru)): foreach($guru as $g): ?>
                            <option value="<?= $g['id_guru'] ?>"><?= $g['gelar_depan'] ?> <?= $g['nama_lengkap'] ?> <?= $g['gelar_belakang'] ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Hari</label>
                        <select name="hari" class="form-control modern-input" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="col-6 mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Jam Mulai</label>
                        <input type="time" class="form-control modern-input" name="jam_mulai" required>
                    </div>
                    <div class="col-6 mb-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Jam Selesai</label>
                        <input type="time" class="form-control modern-input" name="jam_selesai" required>
                    </div>
                </div>
                <button type="submit" class="btn text-white w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0" style="background: var(--theme-gradient);">
                    <i class="fas fa-save me-2"></i> Simpan Jadwal
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="modern-card bg-white p-0 h-100 overflow-hidden border">
            <div class="p-4 border-bottom border-light bg-light">
                <h5 class="fw-bold m-0 text-dark"><i class="fas fa-list me-2" style="color: var(--theme-color);"></i> Distribusi Jadwal & Mapel</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Kelas & Waktu</th>
                            <th>Mapel & Guru</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($set_mapel) && count($set_mapel) > 0): foreach($set_mapel as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill mb-1"><?= $row['nama_kelas'] ?? '-' ?></span><br>
                                <span class="fw-semibold text-dark fs-7"><?= $row['hari'] ?>, <?= substr($row['jam_mulai'],0,5) ?> - <?= substr($row['jam_selesai'],0,5) ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-primary fs-6 mb-1"><?= $row['nama_mapel'] ?></div>
                                <span class="text-secondary fs-7"><i class="fas fa-user-tie me-1"></i> <?= $row['nama_guru'] ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_set_mapel'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/aplikasi/hapus_set_mapel/' . $row['id_set_mapel']) ?>" onclick="return confirm('Hapus jadwal & penugasan ini?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-calendar-times fs-1 mb-3 opacity-50 d-block"></i>Belum ada data jadwal mengajar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($set_mapel) && count($set_mapel) > 0): foreach($set_mapel as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_set_mapel'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Jadwal & Tugas Mapel</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/aplikasi/update_set_mapel/' . $row['id_set_mapel']) ?>" method="post">
                <div class="modal-body p-4 bg-white modal-body-scroll">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Pilih Kelas</label>
                        <select name="id_kelas" class="form-control modern-input" required>
                            <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>" <?= $k['id_kelas'] == $row['id_kelas'] ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Mata Pelajaran</label>
                        <select name="id_mapel" class="form-control modern-input" required>
                            <?php if(isset($mapel)): foreach($mapel as $m): ?>
                                <option value="<?= $m['id_mapel'] ?>" <?= $m['id_mapel'] == $row['id_mapel'] ? 'selected' : '' ?>><?= $m['nama_mapel'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Guru Pengampu</label>
                        <select name="id_guru" class="form-control modern-input" required>
                            <?php if(isset($guru)): foreach($guru as $g): ?>
                                <option value="<?= $g['id_guru'] ?>" <?= $g['id_guru'] == $row['id_guru'] ? 'selected' : '' ?>><?= $g['nama_lengkap'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Hari</label>
                            <select name="hari" class="form-control modern-input" required>
                                <option value="Senin" <?= $row['hari'] == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                <option value="Selasa" <?= $row['hari'] == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                <option value="Rabu" <?= $row['hari'] == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                <option value="Kamis" <?= $row['hari'] == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                <option value="Jumat" <?= $row['hari'] == 'Jumat' ? 'selected' : '' ?>>Jumat</option>
                                <option value="Sabtu" <?= $row['hari'] == 'Sabtu' ? 'selected' : '' ?>>Sabtu</option>
                            </select>
                        </div>
                        <div class="col-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Jam Mulai</label>
                            <input type="time" class="form-control modern-input" name="jam_mulai" value="<?= $row['jam_mulai'] ?>" required>
                        </div>
                        <div class="col-6 mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Jam Selesai</label>
                            <input type="time" class="form-control modern-input" name="jam_selesai" value="<?= $row['jam_selesai'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm border-0 hover-lift" style="background: var(--theme-gradient);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>