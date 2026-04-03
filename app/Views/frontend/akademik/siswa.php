<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; }
    .modern-input { border-radius: 20px; border: 2px solid #e2e8f0; padding: 12px 25px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #f59e0b; background: #fff; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15); outline: none; }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Direktori Siswa</h1>
        <p class="fs-5 opacity-75 mb-0">Daftar peserta didik aktif tahun ajaran ini.</p>
    </div>

    <div class="glass-card">
        <div class="row justify-content-end mb-4">
            <div class="col-md-5">
                <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 text-warning ps-4"><i class="fas fa-search"></i></span>
                    <input type="text" id="filterSiswa" class="form-control border-0 modern-input rounded-0 bg-white" placeholder="Cari nama atau kelas siswa...">
                </div>
            </div>
        </div>

        <div class="table-responsive rounded-4 border">
            <table class="table table-hover table-modern mb-0" id="tabelSiswa">
                <thead>
                    <tr>
                        <th width="5%" class="text-center bg-light">No</th>
                        <th class="bg-light">Nama Peserta Didik</th>
                        <th class="text-center bg-light">NISN</th>
                        <th class="text-center bg-light">L/P</th>
                        <th class="text-center bg-light">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($siswa) && count($siswa) > 0): foreach($siswa as $key => $row): ?>
                    <tr>
                        <td class="text-center text-muted"><?= $key + 1 ?></td>
                        <td class="fw-bold text-dark fs-6">
                            <i class="fas fa-user-circle me-2 text-secondary opacity-50"></i><?= $row['nama_siswa'] ?>
                        </td>
                        <td class="text-center text-secondary"><?= substr($row['nisn'], 0, 4) ?>******</td>
                        <td class="text-center">
                            <?php if($row['jenis_kelamin'] == 'Laki-Laki'): ?>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill">L</span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill">P</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><span class="badge bg-warning text-dark border px-3 py-1 rounded-pill"><?= $row['nama_kelas'] ?? '-' ?></span></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr id="emptyRow"><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-users-slash fs-1 mb-3 opacity-50 d-block"></i>Data siswa belum tersedia.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
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