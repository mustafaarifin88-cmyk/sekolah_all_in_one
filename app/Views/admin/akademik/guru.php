<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #f6d365; background: #fff; box-shadow: 0 0 0 4px rgba(246, 211, 101, 0.2); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
    .modal-body-scroll::-webkit-scrollbar { width: 6px; }
    .modal-body-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="row">
    <div class="col-12">
        <div class="modern-card p-4 mb-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-dark">
                    <h4 class="fw-bold mb-1"><i class="fas fa-chalkboard-teacher me-2"></i> Manajemen Guru & Tendik</h4>
                    <p class="mb-0 opacity-75 fs-7 fw-semibold">Kelola data kepegawaian dan akun login tenaga pendidik.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-white text-success rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalImport">
                        <i class="fas fa-file-excel me-2"></i> Import Data
                    </button>
                    <button class="btn btn-dark text-white rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                        <i class="fas fa-plus me-2"></i> Tambah Pegawai
                    </button>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center rounded-start">No</th>
                            <th>Nama Lengkap</th>
                            <th>Hak Akses (Role)</th>
                            <th>Status Kepegawaian</th>
                            <th>No HP</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($guru) && count($guru) > 0): foreach($guru as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['gelar_depan'] ?> <?= $row['nama_lengkap'] ?> <?= $row['gelar_belakang'] ?></div>
                                <span class="text-muted fs-7">NIP/NIK: <?= $row['nip'] ?: ($row['nikki'] ?: '-') ?></span>
                            </td>
                            <td>
                                <?php if($row['role_user'] == 'admin'): ?>
                                    <span class="badge bg-danger rounded-pill px-3 py-1"><i class="fas fa-shield-alt me-1"></i> Administrator</span>
                                <?php elseif($row['role_user'] == 'walikelas'): ?>
                                    <span class="badge bg-primary rounded-pill px-3 py-1"><i class="fas fa-star me-1"></i> Wali Kelas</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill px-3 py-1"><i class="fas fa-user-tie me-1"></i> Guru Mapel</span>
                                <?php endif; ?>
                                <br><small class="text-muted fw-semibold d-inline-block mt-1"><i class="fas fa-key text-warning"></i> <?= $row['username'] ?? 'Belum ada akun' ?></small>
                            </td>
                            <td><span class="badge bg-warning text-dark border px-3 py-1 rounded-pill"><?= $row['status_pegawai'] ?></span></td>
                            <td class="text-secondary fw-semibold"><?= $row['no_hp'] ?: '-' ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_guru'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/akademik/hapus_guru/' . $row['id_guru']) ?>" onclick="return confirm('Hapus pegawai beserta akun loginnya?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-chalkboard-teacher fs-1 mb-3 opacity-50 d-block"></i>Belum ada data kepegawaian.</td></tr>
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
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-user-plus me-2"></i> Form Registrasi Guru & Tendik</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/simpan_guru') ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h6 class="fw-bold text-dark border-bottom border-warning pb-2 mb-3"><i class="fas fa-key me-2 text-warning"></i>Hak Akses & Login</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Role / Level Akses</label>
                                <select class="form-control modern-input" name="role_user" required>
                                    <option value="guru">Guru Mapel (Standar)</option>
                                    <option value="walikelas">Wali Kelas</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Username Login</label>
                                <input type="text" class="form-control modern-input" name="username" placeholder="Ex: budi.guru" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Password Akun</label>
                                <input type="password" class="form-control modern-input" name="password" placeholder="Buat kata sandi aman" required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-dark border-bottom border-warning pb-2 mb-3"><i class="fas fa-address-card me-2 text-warning"></i>Data Personal & Pegawai</h6>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Gelar Depan</label>
                                <input type="text" class="form-control modern-input" name="gelar_depan" placeholder="Drs. Ir.">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Lengkap</label>
                                <input type="text" class="form-control modern-input" name="nama_lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Gelar Belakang</label>
                                <input type="text" class="form-control modern-input" name="gelar_belakang" placeholder="S.Pd, M.Pd">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jenis Kelamin</label>
                                <select class="form-control modern-input" name="jenis_kelamin" required>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Pegawai</label>
                                <select class="form-control modern-input" name="status_pegawai" required>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK Penuh Waktu">PPPK Penuh Waktu</option>
                                    <option value="PPPK Paruh Waktu">PPPK Paruh Waktu</option>
                                    <option value="KKI">KKI</option>
                                    <option value="Honor Murni">Honor Murni</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIP</label>
                                <input type="text" class="form-control modern-input" name="nip" placeholder="Khusus PNS/PPPK">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIKKI</label>
                                <input type="text" class="form-control modern-input" name="nikki" placeholder="Khusus KKI">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NUPTK</label>
                                <input type="text" class="form-control modern-input" name="nuptk">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIK (KTP)</label>
                                <input type="text" class="form-control modern-input" name="nik" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor KK</label>
                                <input type="text" class="form-control modern-input" name="no_kk">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Alamat Lengkap Tempat Tinggal</label>
                                <textarea class="form-control modern-input" name="alamat_lengkap" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor HP / WhatsApp</label>
                                <input type="text" class="form-control modern-input" name="no_hp" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NPWP</label>
                                <input type="text" class="form-control modern-input" name="no_npwp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SK Angkat</label>
                                    <input type="text" class="form-control modern-input" name="no_sk_pengangkatan">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">TMT Angkat</label>
                                    <input type="date" class="form-control modern-input" name="tgl_sk_pengangkatan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-dark rounded-pill px-5 fw-bold shadow-lg hover-lift border-0"><i class="fas fa-save me-2 text-warning"></i> Simpan Pegawai</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($guru) && count($guru) > 0): foreach($guru as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_guru'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit me-2"></i> Edit Data Guru & Tendik</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/update_guru/' . $row['id_guru']) ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h6 class="fw-bold text-dark border-bottom border-warning pb-2 mb-3"><i class="fas fa-key me-2 text-warning"></i>Hak Akses & Login</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Role / Level Akses</label>
                                <select class="form-control modern-input" name="role_user" required>
                                    <option value="guru" <?= $row['role_user'] == 'guru' ? 'selected' : '' ?>>Guru Mapel (Standar)</option>
                                    <option value="walikelas" <?= $row['role_user'] == 'walikelas' ? 'selected' : '' ?>>Wali Kelas</option>
                                    <option value="admin" <?= $row['role_user'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Username Login</label>
                                <input type="text" class="form-control modern-input" name="username" value="<?= $row['username'] ?? '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Ganti Password (Opsional)</label>
                                <input type="password" class="form-control modern-input" name="password" placeholder="Abaikan bila tidak diubah">
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-dark border-bottom border-warning pb-2 mb-3"><i class="fas fa-address-card me-2 text-warning"></i>Data Personal & Pegawai</h6>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Gelar Depan</label>
                                <input type="text" class="form-control modern-input" name="gelar_depan" value="<?= $row['gelar_depan'] ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Lengkap</label>
                                <input type="text" class="form-control modern-input" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Gelar Belakang</label>
                                <input type="text" class="form-control modern-input" name="gelar_belakang" value="<?= $row['gelar_belakang'] ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jenis Kelamin</label>
                                <select class="form-control modern-input" name="jenis_kelamin" required>
                                    <option value="Laki-Laki" <?= $row['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Status Pegawai</label>
                                <select class="form-control modern-input" name="status_pegawai" required>
                                    <option value="PNS" <?= $row['status_pegawai'] == 'PNS' ? 'selected' : '' ?>>PNS</option>
                                    <option value="PPPK Penuh Waktu" <?= $row['status_pegawai'] == 'PPPK Penuh Waktu' ? 'selected' : '' ?>>PPPK Penuh Waktu</option>
                                    <option value="PPPK Paruh Waktu" <?= $row['status_pegawai'] == 'PPPK Paruh Waktu' ? 'selected' : '' ?>>PPPK Paruh Waktu</option>
                                    <option value="KKI" <?= $row['status_pegawai'] == 'KKI' ? 'selected' : '' ?>>KKI</option>
                                    <option value="Honor Murni" <?= $row['status_pegawai'] == 'Honor Murni' ? 'selected' : '' ?>>Honor Murni</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIP</label>
                                <input type="text" class="form-control modern-input" name="nip" value="<?= $row['nip'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIKKI</label>
                                <input type="text" class="form-control modern-input" name="nikki" value="<?= $row['nikki'] ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NUPTK</label>
                                <input type="text" class="form-control modern-input" name="nuptk" value="<?= $row['nuptk'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NIK (KTP)</label>
                                <input type="text" class="form-control modern-input" name="nik" value="<?= $row['nik'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor KK</label>
                                <input type="text" class="form-control modern-input" name="no_kk" value="<?= $row['no_kk'] ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Alamat Lengkap Tempat Tinggal</label>
                                <textarea class="form-control modern-input" name="alamat_lengkap" rows="2" required><?= $row['alamat_lengkap'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor HP / WhatsApp</label>
                                <input type="text" class="form-control modern-input" name="no_hp" value="<?= $row['no_hp'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nomor NPWP</label>
                                <input type="text" class="form-control modern-input" name="no_npwp" value="<?= $row['no_npwp'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SK Angkat</label>
                                    <input type="text" class="form-control modern-input" name="no_sk_pengangkatan" value="<?= $row['no_sk_pengangkatan'] ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">TMT Angkat</label>
                                    <input type="date" class="form-control modern-input" name="tgl_sk_pengangkatan" value="<?= $row['tgl_sk_pengangkatan'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-dark rounded-pill px-5 fw-bold shadow-sm hover-lift border-0"><i class="fas fa-save me-2 text-warning"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-4">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-file-excel me-2"></i> Import Data Excel</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/import_guru') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-white text-center">
                    <i class="fas fa-cloud-upload-alt text-success" style="font-size: 4rem; margin-bottom: 15px;"></i>
                    <h6 class="fw-bold mb-3">Pilih File Excel (.xlsx)</h6>
                    <input type="file" class="form-control modern-input" name="file_excel" accept=".xlsx, .xls" required>
                    <a href="#" class="d-block mt-3 text-decoration-none fw-semibold text-warning"><i class="fas fa-download me-1"></i> Download Template Kosong</a>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0"><i class="fas fa-upload me-2"></i> Mulai Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>