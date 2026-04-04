<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Rapor</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .kop-surat { width: 100%; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 80px; }
        .text-kop { text-align: center; }
        .text-kop h3 { margin: 0; font-size: 14px; }
        .text-kop h1 { margin: 5px 0; font-size: 20px; font-weight: bold; }
        .text-kop p { margin: 0; font-size: 11px; }
        
        .info-siswa { width: 100%; margin-bottom: 20px; }
        .info-siswa td { padding: 3px 5px; font-size: 12px; font-weight: bold;}
        
        .tabel-nilai { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .tabel-nilai th, .tabel-nilai td { border: 1px solid #000; padding: 8px; text-align: center; }
        .tabel-nilai th { background-color: #f2f2f2; font-weight: bold; }
        .text-left { text-align: left !important; }
        
        .ttd { width: 100%; margin-top: 30px; }
        .ttd-box { width: 250px; float: right; text-align: center; }
        .ttd-box img { max-width: 150px; margin: 10px 0; }
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

    <h2 style="text-align: center; font-size: 16px; margin-bottom: 20px; text-decoration: underline;">LAPORAN HASIL BELAJAR SISWA</h2>

    <table class="info-siswa">
        <tr>
            <td width="15%">Nama Siswa</td>
            <td width="35%">: <?= $siswa['nama_siswa'] ?></td>
            <td width="15%">Kelas</td>
            <td width="35%">: <?= $siswa['nama_kelas'] ?></td>
        </tr>
        <tr>
            <td>NIS / NISN</td>
            <td>: <?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?></td>
            <td>Tahun Ajaran</td>
            <td>: <?= $nilai[0]['tahun_ajaran'] ?? '-' ?></td>
        </tr>
    </table>

    <table class="tabel-nilai">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Mata Pelajaran</th>
                <th width="15%">Semester</th>
                <th width="15%">Nilai</th>
                <th width="30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($nilai) > 0): ?>
                <?php $no=1; foreach($nilai as $n): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td class="text-left"><?= $n['nama_mapel'] ?></td>
                    <td><?= $n['semester'] ?></td>
                    <td><strong><?= $n['nilai'] ?></strong></td>
                    <td><?= $n['nilai'] >= 75 ? 'Tuntas' : 'Belum Tuntas' ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data nilai.</td>
                </tr>
            <?php endif; ?>
        </tbody>
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