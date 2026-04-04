<?= $this->extend('layout/backend/template') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --theme-color: #30cfd0;
        --theme-shadow: rgba(48, 207, 208, 0.15);
        --theme-gradient: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
    }
    .modern-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; background: #fff; }
    .modern-input { border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 18px; font-weight: 500; background: #f8fafc; transition: all 0.3s ease; }
    .modern-input:focus { border-color: var(--theme-color); background: #fff; box-shadow: 0 0 0 4px var(--theme-shadow); outline: none; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="modern-card p-5 mt-4 border">
            <div class="text-center mb-5">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-print fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark">Cetak Laporan Keuangan</h3>
                <p class="text-muted">Tentukan rentang tanggal untuk mencetak laporan arus kas sekolah (Pemasukan & Pengeluaran).</p>
            </div>

            <form id="formCetakLaporan" method="GET" target="_blank">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Mulai</label>
                        <input type="date" class="form-control modern-input" id="tgl_mulai" name="tgl_mulai" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase fs-7">Tanggal Akhir</label>
                        <input type="date" class="form-control modern-input" id="tgl_akhir" name="tgl_akhir" required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-12 text-center mt-2 mb-1">
                        <span class="badge bg-light border text-dark px-3 py-2 rounded-pill fs-7">Atau gunakan filter cepat:</span>
                    </div>
                    <div class="col-md-6">
                        <button type="button" onclick="setFilter(1)" class="btn btn-light border w-100 rounded-pill py-2 fw-semibold text-primary hover-lift"><i class="far fa-calendar-alt me-2"></i> 1 Bulan Terakhir</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" onclick="setFilter(12)" class="btn btn-light border w-100 rounded-pill py-2 fw-semibold text-primary hover-lift"><i class="far fa-calendar-check me-2"></i> 1 Tahun Terakhir</button>
                    </div>
                </div>

                <div class="mt-5 d-flex gap-3 justify-content-center border-top pt-5">
                    <button type="submit" formaction="<?= base_url('admin/keuangan/laporan/cetak_pdf') ?>" class="btn text-white rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift border-0" style="background: #e74c3c; width: 200px;">
                        <i class="fas fa-file-pdf me-2 fs-5"></i> CETAK PDF
                    </button>
                    <button type="submit" formaction="<?= base_url('admin/keuangan/laporan/cetak_excel') ?>" class="btn text-white rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift border-0" style="background: #27ae60; width: 200px;">
                        <i class="fas fa-file-excel me-2 fs-5"></i> EXPORT EXCEL
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setFilter(months) {
        let end = new Date();
        let start = new Date();
        start.setMonth(end.getMonth() - months);
        
        document.getElementById('tgl_akhir').value = end.toISOString().split('T')[0];
        document.getElementById('tgl_mulai').value = start.toISOString().split('T')[0];
    }
</script>

<?= $this->endSection() ?>