<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #6a11cb; background: #fff; box-shadow: 0 0 0 4px rgba(106, 17, 203, 0.15); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); padding: 24px; border-bottom: none; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3" style="color: #6a11cb !important; background: rgba(106, 17, 203, 0.1) !important;">
                        <i class="fas fa-calendar-alt fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0 text-dark">Jadwal Pelajaran</h5>
                        <p class="text-muted fs-7 mb-0">Plotting jadwal tatap muka kelas harian.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-control modern-input w-auto fw-bold text-primary border-primary">
                        <option value="">-- Filter Kelas --</option>
                    </select>
                    <button class="btn text-white rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift border-0 bg-gradient-animated" data-toggle="modal" data-target="#modalTambah">
                        <i class="fas fa-plus me-2"></i> Buat Jadwal
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-modern datatable w-100">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengampu</th>
                            <th width="10%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($jadwal) && count($jadwal) > 0): foreach($jadwal as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td class="fw-bold text-dark"><?= $row['hari'] ?></td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill"><i class="far fa-clock me-1"></i> <?= date('H:i', strtotime($row['jam_mulai'])) ?> - <?= date('H:i', strtotime($row['jam_selesai'])) ?></span></td>
                            <td class="fw-bold text-primary"><?= $row['id_kelas'] ?></td>
                            <td><?= $row['id_mapel'] ?></td>
                            <td><?= $row['id_guru'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-danger rounded-circle shadow-sm hover-lift" style="width: 35px; height: 35px;"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-5 text-muted"><i class="far fa-calendar-times fs-1 mb-3 opacity-50 d-block"></i>Belum ada jadwal tersimpan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header-custom d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-calendar-plus me-2"></i> Form Plotting Jadwal</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/simpan_jadwal') ?>" method="post">
                <div class="modal-body p-4 bg-light">
                    <div class="bg-white p-4 rounded-4 shadow-sm border">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Kelas</label>
                                    <select class="form-control select2" name="id_kelas" required>
                                        <option value="">-- Pilih Kelas --</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Pilih Hari</label>
                                    <select class="form-control modern-input" name="hari" required>
                                        <option value="Senin">Senin</option><option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option><option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option><option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Jam Mulai</label>
                                        <input type="time" class="form-control modern-input" name="jam_mulai" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Jam Selesai</label>
                                        <input type="time" class="form-control modern-input" name="jam_selesai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Mata Pelajaran</label>
                                    <select class="form-control select2" name="id_mapel" required>
                                        <option value="">-- Pilih Mapel --</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-secondary fs-7 text-uppercase">Guru Pengampu</label>
                                    <select class="form-control select2" name="id_guru" required>
                                        <option value="">-- Pilih Guru --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-white rounded-pill px-4 fw-bold text-secondary border shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-lg hover-lift border-0 bg-gradient-animated"><i class="fas fa-save me-2"></i> Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>