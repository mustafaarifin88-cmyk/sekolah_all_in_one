<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KeuanganBosModel;
use App\Models\PengeluaranModel;

class Keuangan extends BaseController
{
    public function bos()
    {
        $model = new KeuanganBosModel();
        $data['bos'] = $model->findAll();
        return view('admin/keuangan/bos', $data);
    }

    public function simpan_bos()
    {
        $model = new KeuanganBosModel();
        $data = [
            'jumlah_dana_masuk' => $this->request->getPost('jumlah_dana_masuk'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tahun_anggaran' => $this->request->getPost('tahun_anggaran')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil ditambahkan.');
    }

    public function update_bos($id)
    {
        $model = new KeuanganBosModel();
        $data = [
            'jumlah_dana_masuk' => $this->request->getPost('jumlah_dana_masuk'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tahun_anggaran' => $this->request->getPost('tahun_anggaran')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil diperbarui.');
    }

    public function hapus_bos($id)
    {
        $model = new KeuanganBosModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil dihapus.');
    }

    public function pengeluaran()
    {
        $model = new PengeluaranModel();
        $data['pengeluaran'] = $model->findAll();
        return view('admin/keuangan/pengeluaran', $data);
    }

    public function simpan_pengeluaran()
    {
        $model = new PengeluaranModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengeluaran' => $this->request->getPost('nama_pengeluaran'),
            'jumlah_pengeluaran' => $this->request->getPost('jumlah_pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil ditambahkan.');
    }

    public function update_pengeluaran($id)
    {
        $model = new PengeluaranModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengeluaran' => $this->request->getPost('nama_pengeluaran'),
            'jumlah_pengeluaran' => $this->request->getPost('jumlah_pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil diperbarui.');
    }

    public function hapus_pengeluaran($id)
    {
        $model = new PengeluaranModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil dihapus.');
    }

    public function laporan()
    {
        return view('admin/keuangan/laporan');
    }

    public function cetak_laporan_pdf()
    {
        $db = \Config\Database::connect();
        $tgl_mulai = $this->request->getGet('tgl_mulai');
        $tgl_akhir = $this->request->getGet('tgl_akhir');

        if (!$tgl_mulai || !$tgl_akhir) return redirect()->back()->with('error', 'Silakan pilih rentang tanggal.');

        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        
        $pemasukan = $db->table('dana_bos')
                        ->where('tanggal_terima >=', $tgl_mulai)
                        ->where('tanggal_terima <=', $tgl_akhir)
                        ->orderBy('tanggal_terima', 'ASC')
                        ->get()->getResultArray();
                        
        $pengeluaran = $db->table('pengeluaran_keuangan')
                          ->where('tanggal >=', $tgl_mulai)
                          ->where('tanggal <=', $tgl_akhir)
                          ->orderBy('tanggal', 'ASC')
                          ->get()->getResultArray();

        $data = [
            'identitas' => $identitas,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        $html = view('admin/keuangan/format_cetak_laporan', $data);
        $mpdf->WriteHTML($html);
        
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Laporan_Keuangan_Sekolah.pdf', 'I');
    }

    public function cetak_laporan_excel()
    {
        $db = \Config\Database::connect();
        $tgl_mulai = $this->request->getGet('tgl_mulai');
        $tgl_akhir = $this->request->getGet('tgl_akhir');

        if (!$tgl_mulai || !$tgl_akhir) return redirect()->back()->with('error', 'Silakan pilih rentang tanggal.');

        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        
        $pemasukan = $db->table('dana_bos')
                        ->where('tanggal_terima >=', $tgl_mulai)
                        ->where('tanggal_terima <=', $tgl_akhir)
                        ->orderBy('tanggal_terima', 'ASC')
                        ->get()->getResultArray();
                        
        $pengeluaran = $db->table('pengeluaran_keuangan')
                          ->where('tanggal >=', $tgl_mulai)
                          ->where('tanggal <=', $tgl_akhir)
                          ->orderBy('tanggal', 'ASC')
                          ->get()->getResultArray();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', strtoupper($identitas['nama_dinas'] ?? 'DINAS PENDIDIKAN'));
        $sheet->setCellValue('A2', strtoupper($identitas['nama_sekolah'] ?? 'NAMA SEKOLAH'));
        $sheet->setCellValue('A3', 'LAPORAN KEUANGAN SEKOLAH');
        $sheet->setCellValue('A4', 'Periode: ' . date('d-m-Y', strtotime($tgl_mulai)) . ' s/d ' . date('d-m-Y', strtotime($tgl_akhir)));
        
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('A3:D3');
        $sheet->mergeCells('A4:D4');
        $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:A3')->getFont()->setBold(true);
        
        $sheet->setCellValue('A6', 'PEMASUKAN (DANA BOS)');
        $sheet->mergeCells('A6:D6');
        $sheet->getStyle('A6')->getFont()->setBold(true);
        
        $sheet->setCellValue('A7', 'No');
        $sheet->setCellValue('B7', 'Tanggal');
        $sheet->setCellValue('C7', 'Tahun Anggaran');
        $sheet->setCellValue('D7', 'Jumlah Masuk');
        $sheet->getStyle('A7:D7')->getFont()->setBold(true);
        $sheet->getStyle('A7:D7')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        $row = 8;
        $no = 1;
        $totPemasukan = 0;
        foreach($pemasukan as $p) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, date('d-m-Y', strtotime($p['tanggal_terima'])));
            $sheet->setCellValue('C'.$row, 'T.A ' . $p['tahun_anggaran']);
            $sheet->setCellValue('D'.$row, $p['jumlah_dana_masuk']);
            $totPemasukan += $p['jumlah_dana_masuk'];
            $sheet->getStyle('A'.$row.':D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $row++;
        }
        $sheet->setCellValue('C'.$row, 'Total Pemasukan');
        $sheet->setCellValue('D'.$row, $totPemasukan);
        $sheet->getStyle('C'.$row.':D'.$row)->getFont()->setBold(true);
        $sheet->getStyle('A'.$row.':D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        $row += 2;
        $sheet->setCellValue('A'.$row, 'PENGELUARAN');
        $sheet->mergeCells('A'.$row.':D'.$row);
        $sheet->getStyle('A'.$row)->getFont()->setBold(true);
        $row++;
        
        $sheet->setCellValue('A'.$row, 'No');
        $sheet->setCellValue('B'.$row, 'Tanggal');
        $sheet->setCellValue('C'.$row, 'Nama Pengeluaran / Keterangan');
        $sheet->setCellValue('D'.$row, 'Jumlah Keluar');
        $sheet->getStyle('A'.$row.':D'.$row)->getFont()->setBold(true);
        $sheet->getStyle('A'.$row.':D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $row++;
        
        $no = 1;
        $totPengeluaran = 0;
        foreach($pengeluaran as $p) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, date('d-m-Y', strtotime($p['tanggal'])));
            $sheet->setCellValue('C'.$row, $p['nama_pengeluaran'] . ($p['keterangan'] ? ' ('.$p['keterangan'].')' : ''));
            $sheet->setCellValue('D'.$row, $p['jumlah_pengeluaran']);
            $totPengeluaran += $p['jumlah_pengeluaran'];
            $sheet->getStyle('A'.$row.':D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $row++;
        }
        $sheet->setCellValue('C'.$row, 'Total Pengeluaran');
        $sheet->setCellValue('D'.$row, $totPengeluaran);
        $sheet->getStyle('C'.$row.':D'.$row)->getFont()->setBold(true);
        $sheet->getStyle('A'.$row.':D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        $row += 2;
        $sheet->setCellValue('C'.$row, 'SISA SALDO KAS');
        $sheet->setCellValue('D'.$row, $totPemasukan - $totPengeluaran);
        $sheet->getStyle('C'.$row.':D'.$row)->getFont()->setBold(true);
        
        $row += 3;
        $sheet->setCellValue('D'.$row, 'Kepala Sekolah,');
        $row += 4;
        $sheet->setCellValue('D'.$row, $identitas['nama_kepsek'] ?? '.......................');
        
        foreach(range('A','D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Laporan_Keuangan_Sekolah.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit();
    }
}