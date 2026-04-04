<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .kop-surat { width: 100%; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 80px; }
        .text-kop { text-align: center; }
        .text-kop h3 { margin: 0; font-size: 14px; }
        .text-kop h1 { margin: 5px 0; font-size: 20px; font-weight: bold; }
        .text-kop p { margin: 0; font-size: 11px; }
        
        .tabel-data { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .tabel-data th, .tabel-data td { border: 1px solid #000; padding: 6px; }
        .tabel-data th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        
        .ttd { width: 100%; margin-top: 40px; }
        .ttd-box { width: 250px; float: right; text-align: center; }
        .ttd-box img { max-width: 150px; margin: 10px 0; }
        .section-title { font-size: 13px; font-weight: bold; margin-bottom: 5px; margin-top: 15px; background: #e0e0e0; padding: 5px;}
    </style>
</head>
<body>

    <table class="kop-surat">
        <tr>
            <td width="15%">
                <?php 
                    $logoPemda = FCPATH . 'uploads/identitas/' . ($identitas['logo_pemda'] ?? '');
                    if(!empty($identitas['logo_pemda']) && file_exists($logoPemda)):
                ?>
                    <img src="<?= $logoPemda ?>" class="logo">
                <?php endif; ?>
            </td>
            <td width="70%" class="text-kop">
                <h3><?= strtoupper($identitas['nama_dinas'] ?? 'DINAS PENDIDIKAN') ?></h3>
                <h1><?= strtoupper($identitas['nama_sekolah'] ?? 'NAMA SEKOLAH') ?></h1>
                <p><?= $identitas['alamat_sekolah'] ?? 'Alamat Sekolah' ?></p>
            </td>
            <td width="15%" style="text-align: right;">
                <?php 
                    $logoSekolah = FCPATH . 'uploads/identitas/' . ($identitas['logo_sekolah'] ?? '');
                    if(!empty($identitas['logo_sekolah']) && file_exists($logoSekolah)):
                ?>
                    <img src="<?= $logoSekolah ?>" class="logo">
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <h2 style="text-align: center; font-size: 16px; margin-bottom: 5px; text-decoration: underline;">LAPORAN KEUANGAN SEKOLAH</h2>
    <p style="text-align: center; margin-top: 0; margin-bottom: 20px;">Periode: <?= date('d M Y', strtotime($tgl_mulai)) ?> s/d <?= date('d M Y', strtotime($tgl_akhir)) ?></p>

    <?php $total_masuk = 0; $total_keluar = 0; ?>

    <div class="section-title">A. PEMASUKAN (DANA BOS)</div>
    <table class="tabel-data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Tanggal</th>
                <th width="45%">Tahun Anggaran</th>
                <th width="30%">Jumlah Masuk (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($pemasukan) > 0): ?>
                <?php $no=1; foreach($pemasukan as $p): $total_masuk += $p['jumlah_dana_masuk']; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= date('d-m-Y', strtotime($p['tanggal_terima'])) ?></td>
                    <td class="text-center">T.A <?= $p['tahun_anggaran'] ?></td>
                    <td class="text-right"><?= number_format($p['jumlah_dana_masuk'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">Tidak ada pemasukan pada periode ini.</td></tr>
            <?php endif; ?>
            <tr>
                <td colspan="3" class="text-right" style="font-weight: bold;">TOTAL PEMASUKAN</td>
                <td class="text-right" style="font-weight: bold;"><?= number_format($total_masuk, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">B. PENGELUARAN</div>
    <table class="tabel-data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Tanggal</th>
                <th width="45%">Nama Pengeluaran / Keterangan</th>
                <th width="30%">Jumlah Keluar (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($pengeluaran) > 0): ?>
                <?php $no=1; foreach($pengeluaran as $p): $total_keluar += $p['jumlah_pengeluaran']; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= date('d-m-Y', strtotime($p['tanggal'])) ?></td>
                    <td><?= $p['nama_pengeluaran'] ?> <?= $p['keterangan'] ? '('.$p['keterangan'].')' : '' ?></td>
                    <td class="text-right"><?= number_format($p['jumlah_pengeluaran'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">Tidak ada pengeluaran pada periode ini.</td></tr>
            <?php endif; ?>
            <tr>
                <td colspan="3" class="text-right" style="font-weight: bold;">TOTAL PENGELUARAN</td>
                <td class="text-right" style="font-weight: bold;"><?= number_format($total_keluar, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">C. REKAPITULASI</div>
    <table class="tabel-data">
        <tr>
            <td width="70%" style="font-weight: bold;">SISA SALDO KAS PADA PERIODE INI</td>
            <td width="30%" class="text-right" style="font-weight: bold; font-size: 14px;"><?= number_format($total_masuk - $total_keluar, 0, ',', '.') ?></td>
        </tr>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Kepala Sekolah,</p>
            <?php 
                $ttd = FCPATH . 'uploads/identitas/' . ($identitas['ttd_kepsek'] ?? '');
                if(!empty($identitas['ttd_kepsek']) && file_exists($ttd)):
            ?>
                <img src="<?= $ttd ?>" alt="Tanda Tangan">
            <?php else: ?>
                <br><br><br><br>
            <?php endif; ?>
            <p style="font-weight: bold; text-decoration: underline; margin-bottom: 0;"><?= $identitas['nama_kepsek'] ?? '..........................' ?></p>
            <p style="margin-top: 5px;">NIP. <?= $identitas['nip_kepsek'] ?? '-' ?></p>
        </div>
    </div>

</body>
</html>