<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-gradient: linear-gradient(-45deg, #FF416C, #FF4B2B);
        --theme-shadow: rgba(255, 65, 108, 0.2);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .modern-input { border-radius: 20px; border: 2px solid #e2e8f0; padding: 12px 25px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #FF416C; background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
</style>

<div class="row">
    <div class="col-12">
        <a href="<?= base_url('guru/akademik/data_kelas') ?>" class="btn btn-light border shadow-sm rounded-pill mb-3 fw-bold text-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kelas
        </a>
        
        <div class="modern-card p-4 mb-4" style="background: var(--theme-gradient);">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center me-3 text-white" style="width: 60px; height: 60px;">
                    <i class="fas fa-user-graduate fs-3"></i>
                </div>
                <div class="text-white">
                    <h4 class="fw-bold mb-1">Daftar Siswa - Kelas <?= $nama_kelas_aktif ?></h4>
                    <p class="mb-0 opacity-75 fs-7">Identitas siswa di kelas yang Anda pilih.</p>
                </div>
            </div>
        </div>

        <div class="modern-card bg-white p-4 border">
            <div class="row mb-4 justify-content-end">
                <div class="col-md-5">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                        <span class="input-group-text bg-white border-0 text-danger ps-4"><i class="fas fa-search"></i></span>
                        <input type="text" id="filterSiswa" class="form-control border-0 modern-input rounded-0" placeholder="Cari nama atau NISN...">
                    </div>
                </div>
            </div>

            <div class="table-responsive rounded-4 border">
                <table class="table table-hover table-modern mb-0" id="tabelSiswa">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Identitas Lengkap Siswa</th>
                            <th class="text-center">L/P</th>
                            <th>Info Kontak Wali/Ortu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $key => $row): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= $row['nama_siswa'] ?></div>
                                <span class="text-muted fs-7">NIS: <?= $row['nis'] ?> | NISN: <?= $row['nisn'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $row['jenis_kelamin'] == 'Laki-Laki' ? 'bg-primary text-primary' : 'bg-danger text-danger' ?> bg-opacity-10 px-2 py-1 rounded-pill"><?= $row['jenis_kelamin'] == 'Laki-Laki' ? 'L' : 'P' ?></span>
                            </td>
                            <td class="text-secondary">
                                <div class="fw-semibold text-dark"><i class="fas fa-user-friends text-primary me-2"></i> <?= $row['nama_orang_tua'] ?></div>
                                <small class="text-muted ms-4 d-block"><?= $row['pekerjaan_orang_tua'] ?></small>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr id="emptyRow"><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-users-slash fs-1 mb-3 opacity-50 d-block"></i>Belum ada data siswa di kelas ini.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterSiswa').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tabelSiswa tbody tr');
        rows.forEach(row => {
            if(row.id !== 'emptyRow') {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>