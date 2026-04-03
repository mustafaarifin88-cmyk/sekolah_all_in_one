<?= $this->extend('layout/frontend/template') ?>

<?= $this->section('content') ?>
<style>
    body { background-color: #f8fafc; }
    .page-header { background: linear-gradient(135deg, #10b981 0%, #047857 100%); padding: 60px 0; margin-bottom: 40px; margin-top: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2); }
    .glass-card { background: #fff; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 30px; margin-bottom: 30px; }
    .hover-lift { transition: transform 0.3s, box-shadow 0.3s; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    .table-modern th { background: #f8fafc; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-modern td { vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; }
</style>

<div class="container pb-5">
    <div class="page-header text-center text-white">
        <h1 class="fw-bolder display-5 mb-2">Sarana & Prasarana</h1>
        <p class="fs-5 opacity-75 mb-0">Fasilitas dan inventaris pendukung proses belajar mengajar di sekolah kami.</p>
    </div>

    <div class="glass-card">
        <h4 class="fw-bolder text-dark mb-4 border-bottom pb-3"><i class="fas fa-building text-success me-2"></i>Daftar Ruangan Gedung</h4>
        <div class="row g-4">
            <?php if(isset($ruang) && count($ruang) > 0): ?>
                <?php foreach($ruang as $r): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="p-4 text-center rounded-4 border bg-white shadow-sm hover-lift">
                        <i class="fas fa-door-open fs-1 text-success mb-3 opacity-75"></i>
                        <h6 class="fw-bolder text-dark m-0"><?= $r['nama_ruang'] ?></h6>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-4">
                    <p class="text-muted fw-bold">Data ruangan belum tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="glass-card">
        <h4 class="fw-bolder text-dark mb-4 border-bottom pb-3"><i class="fas fa-boxes text-primary me-2"></i>Inventaris Sekolah</h4>
        <div class="table-responsive rounded-4 border">
            <table class="table table-hover table-modern mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center bg-light">No</th>
                        <th class="bg-light">Nama Barang / Aset</th>
                        <th class="text-center bg-light">Lokasi Ruang</th>
                        <th class="text-center bg-light">Kondisi Barang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($barang) && count($barang) > 0): foreach($barang as $key => $row): ?>
                    <tr>
                        <td class="text-center text-muted"><?= $key + 1 ?></td>
                        <td class="fw-bold text-dark fs-6"><?= $row['nama_barang'] ?></td>
                        <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill"><i class="fas fa-map-marker-alt me-1"></i> <?= $row['nama_ruang'] ?? 'Gudang Utama' ?></span></td>
                        <td class="text-center">
                            <?php 
                                $kondisi = $row['nama_kondisi'] ?? 'Baik';
                                $badgeClass = 'bg-success';
                                if(strpos(strtolower($kondisi), 'rusak') !== false) $badgeClass = 'bg-danger';
                                elseif(strpos(strtolower($kondisi), 'sedang') !== false) $badgeClass = 'bg-warning text-dark';
                            ?>
                            <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-1"><?= $kondisi ?></span>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-box-open fs-1 mb-3 opacity-50 d-block"></i>Data inventaris belum tersedia.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>