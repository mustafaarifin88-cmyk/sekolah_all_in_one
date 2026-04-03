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

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="modern-card overflow-hidden">
            <div class="p-5 text-center text-white" style="background: var(--theme-gradient);">
                <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width: 70px; height: 70px;">
                    <i class="fas fa-print fs-2"></i>
                </div>
                <h3 class="fw-bold mb-1">Pusat Cetak Laporan Keuangan</h3>
                <p class="mb-0 opacity-75">Filter dan hasilkan rekap data transaksi BOS atau Pengeluaran dengan mudah.</p>
            </div>
            
            <div class="p-4 p-md-5 bg-white">
                <form action="#" method="get">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Pilih Jenis Laporan</label>
                            <select class="form-control modern-input" name="jenis_laporan" required>
                                <option value="semua">Semua Transaksi (Pemasukan & Pengeluaran)</option>
                                <option value="bos">Hanya Pemasukan Dana BOS</option>
                                <option value="pengeluaran">Hanya Data Pengeluaran</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Mulai Tanggal</label>
                            <input type="date" class="form-control modern-input" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-uppercase fs-7 tracking-wider">Sampai Tanggal</label>
                            <input type="date" class="form-control modern-input" name="end_date" required>
                        </div>
                        <div class="col-md-12 text-center mt-3 mb-2">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fs-7">Atau filter cepat:</span>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-light border w-100 rounded-pill py-2 fw-semibold text-primary hover-lift"><i class="far fa-calendar-alt me-2"></i> 1 Bulan Terakhir</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-light border w-100 rounded-pill py-2 fw-semibold text-primary hover-lift"><i class="far fa-calendar-check me-2"></i> 1 Tahun Terakhir</button>
                        </div>
                    </div>

                    <div class="mt-5 d-flex gap-3 justify-content-center border-top pt-5">
                        <button type="button" class="btn text-white rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift border-0" style="background: #e74c3c; width: 200px;">
                            <i class="fas fa-file-pdf me-2 fs-5"></i> CETAK PDF
                        </button>
                        <button type="button" class="btn text-white rounded-pill px-5 py-3 fw-bold shadow-sm hover-lift border-0" style="background: #27ae60; width: 200px;">
                            <i class="fas fa-file-excel me-2 fs-5"></i> EXPORT EXCEL
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>