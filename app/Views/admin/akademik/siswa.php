<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #4e54c8; background: #fff; box-shadow: 0 0 0 4px rgba(78, 84, 200, 0.15); outline: none; }
    .modal-content { border-radius: 24px; border: none; overflow: hidden; }
    .modal-header-custom { background: linear-gradient(-45deg, #4e54c8, #8f94fb); padding: 20px 25px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .modal-body-scroll { max-height: 65vh; overflow-y: auto; overflow-x: hidden; }
    .modal-body-scroll::-webkit-scrollbar { width: 6px; }
    .modal-body-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .modal-body-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    
    /* Checkbox Styling */
    .custom-checkbox { width: 20px; height: 20px; cursor: pointer; accent-color: #4e54c8; }
</style>

<div class="row">
    <div class="col-12">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success rounded-4 border-0 shadow-sm"><i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded-4 border-0 shadow-sm"><i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="modern-card p-4 mb-4" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-white">
                    <h4 class="fw-bold mb-1"><i class="fas fa-users me-2"></i> Manajemen Data Siswa</h4>
                    <p class="mb-0 opacity-75 fs-7">Kelola database siswa beserta informasi akademiknya.</p>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm hover-lift text-dark" id="btnNaikKelas" data-toggle="modal" data-target="#modalNaikKelas" disabled>
                        <i class="fas fa-level-up-alt me-2"></i> Naik / Pindah Kelas
                    </button>
                    <button class="btn btn-white text-success rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalImport">
                        <i class="fas fa-file-excel me-2"></i> Import Excel
                    </button>
                    <button class="btn btn-dark text-white rounded-pill px-4 fw-bold shadow-sm hover-lift" data-toggle="modal" data-target="#modalTambah">
                        <i class="fas fa-plus me-2"></i> Tambah Siswa
                    </button>
                </div>
            </div>
        </div>

        <div class="modern-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="3%" class="text-center rounded-start pb-2">
                                <input type="checkbox" class="custom-checkbox" id="checkAll" title="Pilih Semua">
                            </th>
                            <th width="5%" class="text-center">No</th>
                            <th>Info Siswa</th>
                            <th class="text-center">L/P</th>
                            <th>Akun Login</th>
                            <th>Kelas</th>
                            <th>TTL</th>
                            <th>Jenis Pendaftaran</th>
                            <th width="15%" class="text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $key => $row): ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="custom-checkbox checkSiswa" value="<?= $row['id_siswa'] ?>">
                            </td>
                            <td class="text-center text-muted fw-bold"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></div>
                                <span class="text-muted fs-7">NIS: <?= $row['nis'] ?> | NISN: <?= $row['nisn'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $row['jenis_kelamin'] == 'Laki-Laki' ? 'bg-primary text-primary' : 'bg-danger text-danger' ?> bg-opacity-10 px-2 py-1 rounded-pill"><?= $row['jenis_kelamin'] == 'Laki-Laki' ? 'L' : 'P' ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-primary"><i class="fas fa-user-circle me-1"></i> <?= $row['username'] ?? '<em class="text-muted fs-7">Belum dibuat</em>' ?></span>
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-1 rounded-pill"><?= $row['nama_kelas'] ?? 'Belum ada kelas' ?></span></td>
                            <td class="text-secondary"><?= $row['tempat_lahir'] ?>, <?= date('d M Y', strtotime($row['tanggal_lahir'])) ?></td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill"><?= $row['jenis_pendaftaran'] ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1 hover-lift" data-toggle="modal" data-target="#modalEdit<?= $row['id_siswa'] ?>" style="width:35px; height:35px;"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('admin/akademik/hapus_siswa/' . $row['id_siswa']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini beserta akun loginnya?')" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center hover-lift" style="width:35px; height:35px;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-users fs-1 mb-3 opacity-50 d-block"></i>Belum ada data siswa terdaftar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Naik/Pindah Kelas Massal -->
<div class="modal fade" id="modalNaikKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-level-up-alt me-2"></i> Naik / Mutasi Kelas Massal</h5>
                <button type="button" class="close text-dark shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/naik_kelas') ?>" method="post">
                <div class="modal-body p-4 bg-white">
                    <div class="alert alert-warning border-0 rounded-4 shadow-sm bg-warning bg-opacity-10 text-dark">
                        <i class="fas fa-info-circle me-2 text-warning fs-5"></i> Anda akan memindahkan <span id="jumlahSiswaText" class="fw-bold fs-5 text-danger">0</span> ke kelas baru.
                    </div>
                    
                    <div id="hiddenSiswaInputs"></div> <!-- Container untuk ID Siswa yang terpilih -->

                    <div class="mb-3 mt-4">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Pilih Kelas Tujuan (Naik/Pindah)</label>
                        <select class="form-control modern-input" name="id_kelas_tujuan" required>
                            <option value="">-- Pilih Kelas Tujuan --</option>
                            <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-dark rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);"><i class="fas fa-random me-2"></i> Proses Pindah Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-user-plus me-2"></i> Form Pendaftaran Siswa Baru</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/simpan_siswa') ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-key me-2"></i>Akun Akses Portal Siswa</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Username Login</label>
                                <input type="text" class="form-control modern-input" name="username" placeholder="Buat username siswa (Ex: siswa001)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Password Akses</label>
                                <input type="password" class="form-control modern-input" name="password" placeholder="Buat password untuk siswa" required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-address-card me-2"></i>Data Diri & Akademik</h6>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Lengkap</label>
                                <input type="text" class="form-control modern-input" name="nama_siswa" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jenis Kelamin</label>
                                <select class="form-control modern-input" name="jenis_kelamin" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NIS</label>
                                <input type="text" class="form-control modern-input" name="nis" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NISN</label>
                                <input type="text" class="form-control modern-input" name="nisn" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tempat Lahir</label>
                                <input type="text" class="form-control modern-input" name="tempat_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Lahir</label>
                                <input type="date" class="form-control modern-input" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Penempatan Kelas</label>
                                <select class="form-control modern-input" name="id_kelas" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                        <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-school me-2"></i>Asal Sekolah</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jenis Pendaftaran</label>
                                <select class="form-control modern-input" name="jenis_pendaftaran" id="jenis_pendaftaran_tambah" onchange="toggleSekolahAsal(this.value, 'tambah')" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Siswa Baru">Siswa Baru (Lulusan SD/Sederajat)</option>
                                    <option value="Mutasi Masuk">Mutasi Masuk (Pindahan SMP)</option>
                                </select>
                            </div>
                        </div>

                        <div id="form_sd_tambah" class="col-md-12" style="display: none;">
                            <div class="row g-3 p-3 bg-white rounded-4 border">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal Sekolah Dasar</label>
                                    <input type="text" class="form-control modern-input" name="asal_sd">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No Ijazah SD</label>
                                    <input type="text" class="form-control modern-input" name="no_ijazah_sd">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ijazah SD</label>
                                    <input type="number" class="form-control modern-input" name="tahun_ijazah_sd">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SHUN SD (Opsional)</label>
                                    <input type="text" class="form-control modern-input" name="no_shun_sd">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun SHUN (Opsional)</label>
                                    <input type="number" class="form-control modern-input" name="tahun_shun_sd">
                                </div>
                            </div>
                        </div>

                        <div id="form_smp_tambah" class="col-md-12" style="display: none;">
                            <div class="row g-3 p-3 bg-white rounded-4 border">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal SMP Sebelumnya</label>
                                    <input type="text" class="form-control modern-input" name="asal_smp_sebelumnya">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No Ijazah SMP</label>
                                    <input type="text" class="form-control modern-input" name="no_ijazah_smp">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ijazah SMP</label>
                                    <input type="number" class="form-control modern-input" name="tahun_ijazah_smp">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SHUN SMP (Opsional)</label>
                                    <input type="text" class="form-control modern-input" name="no_shun_smp">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun SHUN (Opsional)</label>
                                    <input type="number" class="form-control modern-input" name="tahun_shun_smp">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-user-friends me-2"></i>Data Orang Tua / Wali</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Orang Tua/Wali</label>
                                <input type="text" class="form-control modern-input" name="nama_orang_tua" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pekerjaan</label>
                                <input type="text" class="form-control modern-input" name="pekerjaan_orang_tua" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Penghasilan Per Bulan</label>
                                <input type="text" class="form-control modern-input" name="penghasilan_orang_tua" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);"><i class="fas fa-save me-2"></i> Simpan Data Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $row): ?>
<div class="modal fade" id="modalEdit<?= $row['id_siswa'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-edit me-2"></i> Edit Data Siswa</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/update_siswa/' . $row['id_siswa']) ?>" method="post">
                <div class="modal-body p-4 bg-light modal-body-scroll">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-key me-2"></i>Akun Akses Portal Siswa</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Username Login</label>
                                <input type="text" class="form-control modern-input" name="username" value="<?= $row['username'] ?? '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Ubah Password Baru</label>
                                <input type="password" class="form-control modern-input" name="password" placeholder="Abaikan bila tidak diubah">
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-address-card me-2"></i>Data Diri & Akademik</h6>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Lengkap</label>
                                <input type="text" class="form-control modern-input" name="nama_siswa" value="<?= $row['nama_siswa'] ?>" required>
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
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NIS</label>
                                <input type="text" class="form-control modern-input" name="nis" value="<?= $row['nis'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">NISN</label>
                                <input type="text" class="form-control modern-input" name="nisn" value="<?= $row['nisn'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tempat Lahir</label>
                                <input type="text" class="form-control modern-input" name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Lahir</label>
                                <input type="date" class="form-control modern-input" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Penempatan Kelas</label>
                                <select class="form-control modern-input" name="id_kelas" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php if(isset($kelas)): foreach($kelas as $k): ?>
                                        <option value="<?= $k['id_kelas'] ?>" <?= $row['id_kelas'] == $k['id_kelas'] ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-school me-2"></i>Asal Sekolah</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Jenis Pendaftaran</label>
                                <select class="form-control modern-input" name="jenis_pendaftaran" id="jenis_pendaftaran_edit_<?= $row['id_siswa'] ?>" onchange="toggleSekolahAsal(this.value, 'edit', '<?= $row['id_siswa'] ?>')" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Siswa Baru" <?= $row['jenis_pendaftaran'] == 'Siswa Baru' ? 'selected' : '' ?>>Siswa Baru (Lulusan SD/Sederajat)</option>
                                    <option value="Mutasi Masuk" <?= $row['jenis_pendaftaran'] == 'Mutasi Masuk' ? 'selected' : '' ?>>Mutasi Masuk (Pindahan SMP)</option>
                                </select>
                            </div>
                        </div>

                        <div id="form_sd_edit_<?= $row['id_siswa'] ?>" class="col-md-12" style="<?= $row['jenis_pendaftaran'] == 'Siswa Baru' ? 'display: block;' : 'display: none;' ?>">
                            <div class="row g-3 p-3 bg-white rounded-4 border">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal Sekolah Dasar</label>
                                    <input type="text" class="form-control modern-input" name="asal_sd" value="<?= $row['asal_sd'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No Ijazah SD</label>
                                    <input type="text" class="form-control modern-input" name="no_ijazah_sd" value="<?= $row['no_ijazah_sd'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ijazah SD</label>
                                    <input type="number" class="form-control modern-input" name="tahun_ijazah_sd" value="<?= $row['tahun_ijazah_sd'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SHUN SD (Opsional)</label>
                                    <input type="text" class="form-control modern-input" name="no_shun_sd" value="<?= $row['no_shun_sd'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun SHUN (Opsional)</label>
                                    <input type="number" class="form-control modern-input" name="tahun_shun_sd" value="<?= $row['tahun_shun_sd'] ?>">
                                </div>
                            </div>
                        </div>

                        <div id="form_smp_edit_<?= $row['id_siswa'] ?>" class="col-md-12" style="<?= $row['jenis_pendaftaran'] == 'Mutasi Masuk' ? 'display: block;' : 'display: none;' ?>">
                            <div class="row g-3 p-3 bg-white rounded-4 border">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Asal SMP Sebelumnya</label>
                                    <input type="text" class="form-control modern-input" name="asal_smp_sebelumnya" value="<?= $row['asal_smp_sebelumnya'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No Ijazah SMP</label>
                                    <input type="text" class="form-control modern-input" name="no_ijazah_smp" value="<?= $row['no_ijazah_smp'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun Ijazah SMP</label>
                                    <input type="number" class="form-control modern-input" name="tahun_ijazah_smp" value="<?= $row['tahun_ijazah_smp'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">No SHUN SMP (Opsional)</label>
                                    <input type="text" class="form-control modern-input" name="no_shun_smp" value="<?= $row['no_shun_smp'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tahun SHUN (Opsional)</label>
                                    <input type="number" class="form-control modern-input" name="tahun_shun_smp" value="<?= $row['tahun_shun_smp'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="fas fa-user-friends me-2"></i>Data Orang Tua / Wali</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Nama Orang Tua/Wali</label>
                                <input type="text" class="form-control modern-input" name="nama_orang_tua" value="<?= $row['nama_orang_tua'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Pekerjaan</label>
                                <input type="text" class="form-control modern-input" name="pekerjaan_orang_tua" value="<?= $row['pekerjaan_orang_tua'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary text-uppercase fs-7">Penghasilan Per Bulan</label>
                                <input type="text" class="form-control modern-input" name="penghasilan_orang_tua" value="<?= $row['penghasilan_orang_tua'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(-45deg, #4e54c8, #8f94fb);"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>

<div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-4" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-file-excel me-2"></i> Import Data Excel</h5>
                <button type="button" class="close text-white shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('admin/akademik/import_siswa') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-white text-center">
                    <i class="fas fa-cloud-upload-alt text-success" style="font-size: 4rem; margin-bottom: 15px;"></i>
                    <h6 class="fw-bold mb-3">Pilih File Excel (.xlsx)</h6>
                    <input type="file" class="form-control modern-input" name="file_excel" accept=".xlsx, .xls" required>
                    <a href="#" class="d-block mt-3 text-decoration-none fw-semibold"><i class="fas fa-download me-1"></i> Download Template Kosong</a>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary shadow-sm hover-lift" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-5 fw-bold shadow-sm hover-lift border-0" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);"><i class="fas fa-upload me-2"></i> Mulai Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT LOGIC JAVASCRIPT -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script>
$(document).ready(function() {
    // Logic Check All
    $('#checkAll').click(function() {
        $('.checkSiswa').prop('checked', this.checked);
        toggleNaikKelasBtn();
    });

    // Logic Check per item
    $('.checkSiswa').change(function() {
        if ($('.checkSiswa:checked').length == $('.checkSiswa').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
        toggleNaikKelasBtn();
    });

    // Fungsi Aktif/Nonaktif Tombol
    function toggleNaikKelasBtn() {
        var count = $('.checkSiswa:checked').length;
        if (count > 0) {
            $('#btnNaikKelas').prop('disabled', false);
        } else {
            $('#btnNaikKelas').prop('disabled', true);
        }
    }

    // Eksekusi sebelum modal tampil
    $('#modalNaikKelas').on('show.bs.modal', function () {
        $('#hiddenSiswaInputs').empty(); // Bersihkan container
        var totalSelected = 0;
        
        $('.checkSiswa:checked').each(function() {
            // Tambahkan input hidden berisi id_siswa
            $('#hiddenSiswaInputs').append('<input type="hidden" name="id_siswa[]" value="'+$(this).val()+'">');
            totalSelected++;
        });
        
        // Update text di modal
        $('#jumlahSiswaText').text(totalSelected + ' Siswa');
    });
});

function toggleSekolahAsal(value, type, id = '') {
    let sdForm = document.getElementById('form_sd_' + type + (id ? '_' + id : ''));
    let smpForm = document.getElementById('form_smp_' + type + (id ? '_' + id : ''));
    
    if(value === 'Siswa Baru') {
        sdForm.style.display = 'block';
        smpForm.style.display = 'none';
    } else if(value === 'Mutasi Masuk') {
        sdForm.style.display = 'none';
        smpForm.style.display = 'block';
    } else {
        sdForm.style.display = 'none';
        smpForm.style.display = 'none';
    }
}
</script>

<?= $this->endSection() ?>