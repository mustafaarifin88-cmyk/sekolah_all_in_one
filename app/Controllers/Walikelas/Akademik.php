<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\RaporModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Akademik extends BaseController
{
    public function data_kelas()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $builder = $db->table('set_kelas_wali');
        $builder->select('kelas.*');
        $builder->join('kelas', 'kelas.id_kelas = set_kelas_wali.id_kelas');
        $builder->where('set_kelas_wali.id_guru', $id_guru);
        $data['kelas'] = $builder->get()->getResultArray();
        
        return view('walikelas/data_kelas', $data);
    }

    public function data_siswa($id_kelas = null)
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $wali = $db->table('set_kelas_wali')->where('id_guru', $id_guru)->get()->getRow();
        $id_kelas_wali = $wali ? $wali->id_kelas : null;
        
        if($id_kelas_wali){
            $builder = $db->table('siswa');
            $builder->select('siswa.*, kelas.nama_kelas');
            $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
            $builder->where('siswa.id_kelas', $id_kelas_wali);
            $data['siswa'] = $builder->get()->getResultArray();
        } else {
            $data['siswa'] = [];
        }
        
        return view('walikelas/data_siswa', $data);
    }

    public function jadwal()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $wali = $db->table('set_kelas_wali')->where('id_guru', $id_guru)->get()->getRow();
        $id_kelas_wali = $wali ? $wali->id_kelas : null;

        $jadwal_grouped = [
            'Senin' => [], 
            'Selasa' => [], 
            'Rabu' => [], 
            'Kamis' => [], 
            'Jumat' => [], 
            'Sabtu' => [], 
            'Minggu' => []
        ];

        if ($id_kelas_wali) {
            $builder = $db->table('set_mapel_guru');
            $builder->select('set_mapel_guru.*, kelas.nama_kelas, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru');
            $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
            $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
            $builder->join('guru_tendik', 'guru_tendik.id_guru = set_mapel_guru.id_guru', 'left');
            $builder->where('set_mapel_guru.id_kelas', $id_kelas_wali);
            $builder->orderBy('set_mapel_guru.jam_mulai', 'ASC');
            $raw_jadwal = $builder->get()->getResultArray();

            foreach ($raw_jadwal as $j) {
                $hari = $j['hari'] ?? '';
                if (isset($jadwal_grouped[$hari])) {
                    $jadwal_grouped[$hari][] = $j;
                } elseif ($hari != '') {
                    $jadwal_grouped[$hari] = [$j];
                }
            }
        }

        foreach ($jadwal_grouped as $h => $v) {
            if (empty($v)) unset($jadwal_grouped[$h]);
        }

        $data['jadwal_grouped'] = $jadwal_grouped;
        
        if ($id_kelas_wali) {
            $kelas = $db->table('kelas')->where('id_kelas', $id_kelas_wali)->get()->getRow();
            $data['nama_kelas_wali'] = $kelas ? $kelas->nama_kelas : '-';
        } else {
            $data['nama_kelas_wali'] = 'Belum Ada Kelas Binaan';
        }

        return view('walikelas/jadwal', $data);
    }

    public function pantau_nilai()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        $wali = $db->table('set_kelas_wali')->where('id_guru', $id_guru)->get()->getRow();
        $id_kelas_wali = $wali ? $wali->id_kelas : null;

        $rapor_lengkap = [];

        if($id_kelas_wali){
            $siswa = $db->table('siswa')->where('id_kelas', $id_kelas_wali)->orderBy('nama_siswa', 'ASC')->get()->getResultArray();
            
            $builder = $db->table('set_mapel_guru');
            $builder->select('set_mapel_guru.id_mapel, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru');
            $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
            $builder->join('guru_tendik', 'guru_tendik.id_guru = set_mapel_guru.id_guru', 'left');
            $builder->where('set_mapel_guru.id_kelas', $id_kelas_wali);
            $builder->distinct();
            $mapel_kelas = $builder->get()->getResultArray();

            $nilai_rapor = $db->table('nilai_rapor')->where('id_kelas', $id_kelas_wali)->get()->getResultArray();
            $nilai_indexed = [];
            foreach($nilai_rapor as $n) {
                $nilai_indexed[$n['id_siswa']][$n['id_mapel']] = $n;
            }

            foreach($siswa as $s) {
                foreach($mapel_kelas as $mk) {
                    $id_s = $s['id_siswa'];
                    $id_m = $mk['id_mapel'];
                    
                    $nilai = isset($nilai_indexed[$id_s][$id_m]) ? $nilai_indexed[$id_s][$id_m]['nilai'] : null;
                    $semester = isset($nilai_indexed[$id_s][$id_m]) ? $nilai_indexed[$id_s][$id_m]['semester'] : '-';
                    $tahun_ajaran = isset($nilai_indexed[$id_s][$id_m]) ? $nilai_indexed[$id_s][$id_m]['tahun_ajaran'] : '-';

                    $rapor_lengkap[] = [
                        'nama_siswa' => $s['nama_siswa'],
                        'nama_mapel' => $mk['nama_mapel'],
                        'nama_guru'  => $mk['nama_guru'],
                        'semester'   => $semester,
                        'tahun_ajaran' => $tahun_ajaran,
                        'nilai'      => $nilai
                    ];
                }
            }
        }
        
        $data['rapor'] = $rapor_lengkap;
        return view('walikelas/pantau_nilai', $data);
    }

    public function cetak_rapor()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        $wali = $db->table('set_kelas_wali')->where('id_guru', $id_guru)->get()->getRow();
        $id_kelas_wali = $wali ? $wali->id_kelas : null;

        if($id_kelas_wali){
            $builder = $db->table('siswa');
            $builder->select('siswa.*, kelas.nama_kelas');
            $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
            $builder->where('siswa.id_kelas', $id_kelas_wali);
            $data['siswa'] = $builder->get()->getResultArray();
        } else {
            $data['siswa'] = [];
        }

        return view('walikelas/cetak_rapor', $data);
    }

    public function cetak_rapor_pdf($id_siswa)
    {
        $db = \Config\Database::connect();
        
        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        $siswa = $db->table('siswa')
                    ->select('siswa.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                    ->where('id_siswa', $id_siswa)
                    ->get()->getRowArray();
                    
        if (!$siswa) return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');

        $nilai = $db->table('nilai_rapor')
                    ->select('nilai_rapor.*, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru')
                    ->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left')
                    ->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left')
                    ->where('nilai_rapor.id_siswa', $id_siswa)
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->get()->getResultArray();

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        
        $html = view('admin/akademik/format_cetak_rapor', [
            'identitas' => $identitas,
            'siswa' => $siswa,
            'nilai' => $nilai
        ]);

        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Rapor_' . str_replace(' ', '_', $siswa['nama_siswa']) . '.pdf', 'I');
    }

    public function cetak_rapor_excel($id_siswa)
    {
        $db = \Config\Database::connect();
        
        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        $siswa = $db->table('siswa')
                    ->select('siswa.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                    ->where('id_siswa', $id_siswa)
                    ->get()->getRowArray();
                    
        if (!$siswa) return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');

        $nilai = $db->table('nilai_rapor')
                    ->select('nilai_rapor.*, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru')
                    ->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left')
                    ->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left')
                    ->where('nilai_rapor.id_siswa', $id_siswa)
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->get()->getResultArray();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', strtoupper($identitas['nama_dinas'] ?? 'DINAS PENDIDIKAN'));
        $sheet->setCellValue('A2', strtoupper($identitas['nama_sekolah'] ?? 'NAMA SEKOLAH'));
        $sheet->setCellValue('A3', $identitas['alamat_sekolah'] ?? 'Alamat Sekolah');
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');
        $sheet->mergeCells('A3:F3');
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        
        $sheet->setCellValue('A5', 'Nama Siswa');
        $sheet->setCellValue('B5', ': ' . $siswa['nama_siswa']);
        $sheet->setCellValue('A6', 'NIS/NISN');
        $sheet->setCellValue('B6', ': ' . $siswa['nis'] . ' / ' . $siswa['nisn']);
        $sheet->setCellValue('E5', 'Kelas');
        $sheet->setCellValue('F5', ': ' . $siswa['nama_kelas']);
        $sheet->setCellValue('E6', 'Tahun Ajaran');
        $sheet->setCellValue('F6', ': ' . ($nilai[0]['tahun_ajaran'] ?? '-'));
        
        $sheet->setCellValue('A8', 'No');
        $sheet->setCellValue('B8', 'Mata Pelajaran');
        $sheet->setCellValue('C8', 'Semester');
        $sheet->setCellValue('D8', 'Nilai');
        $sheet->setCellValue('E8', 'Keterangan');
        $sheet->setCellValue('F8', 'Guru Pengampu');
        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
        $sheet->getStyle('A8:F8')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        $rowExcel = 9;
        $no = 1;
        foreach($nilai as $n) {
            $sheet->setCellValue('A'.$rowExcel, $no++);
            $sheet->setCellValue('B'.$rowExcel, $n['nama_mapel']);
            $sheet->setCellValue('C'.$rowExcel, $n['semester']);
            $sheet->setCellValue('D'.$rowExcel, $n['nilai']);
            $keterangan = $n['nilai'] >= 75 ? 'Tuntas' : 'Belum Tuntas';
            $sheet->setCellValue('E'.$rowExcel, $keterangan);
            $sheet->setCellValue('F'.$rowExcel, $n['nama_guru']);
            $sheet->getStyle('A'.$rowExcel.':F'.$rowExcel)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $rowExcel++;
        }
        
        $rowExcel += 2;
        $sheet->setCellValue('F'.$rowExcel, 'Kepala Sekolah,');
        $rowExcel += 4;
        $sheet->setCellValue('F'.$rowExcel, $identitas['nama_kepsek'] ?? '.......................');
        $sheet->setCellValue('F'.($rowExcel+1), 'NIP. ' . ($identitas['nip_kepsek'] ?? '-'));
        
        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Rapor_' . str_replace(' ', '_', $siswa['nama_siswa']) . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit();
    }

    public function input_nilai()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $tugas = $db->table('set_mapel_guru')->where('id_guru', $id_guru)->get()->getResultArray();
        $id_kelas_list = array_values(array_unique(array_column($tugas, 'id_kelas')));
        $id_mapel_list = array_values(array_unique(array_column($tugas, 'id_mapel')));

        if (!empty($id_kelas_list)) {
            $data['kelas'] = $db->table('kelas')->whereIn('id_kelas', $id_kelas_list)->get()->getResultArray();
            $data['siswa'] = $db->table('siswa')
                                ->select('siswa.*, kelas.nama_kelas')
                                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                                ->whereIn('siswa.id_kelas', $id_kelas_list)
                                ->get()->getResultArray();
        } else {
            $data['kelas'] = [];
            $data['siswa'] = [];
        }

        if (!empty($id_mapel_list)) {
            $data['mapel'] = $db->table('mapel')->whereIn('id_mapel', $id_mapel_list)->get()->getResultArray();
        } else {
            $data['mapel'] = [];
        }
        
        $nilaiBuilder = $db->table('nilai_rapor');
        $nilaiBuilder->select('nilai_rapor.*, siswa.nama_siswa, mapel.nama_mapel, kelas.nama_kelas');
        $nilaiBuilder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa', 'left');
        $nilaiBuilder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left');
        $nilaiBuilder->join('kelas', 'kelas.id_kelas = nilai_rapor.id_kelas', 'left');
        $nilaiBuilder->where('nilai_rapor.id_guru', $id_guru);
        
        $data['nilai_rapor'] = $nilaiBuilder->get()->getResultArray();
        $data['rapor'] = $data['nilai_rapor'];
        
        return view('walikelas/input_nilai', $data);
    }

    public function simpan_nilai()
    {
        $model = new RaporModel();
        
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'id_guru' => session()->get('id_relasi'),
            'semester' => $this->request->getPost('semester'),
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'nilai' => $this->request->getPost('nilai')
        ];
        $model->insert($data);
        return redirect()->to(base_url('walikelas/akademik/input_nilai'))->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function update_nilai($id)
    {
        $model = new RaporModel();
        
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'semester' => $this->request->getPost('semester'),
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'nilai' => $this->request->getPost('nilai')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('walikelas/akademik/input_nilai'))->with('success', 'Nilai berhasil diperbarui.');
    }

    public function hapus_nilai($id)
    {
        $model = new RaporModel();
        $model->delete($id);
        return redirect()->to(base_url('walikelas/akademik/input_nilai'))->with('success', 'Nilai berhasil dihapus.');
    }

    public function import_nilai()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($file->getTempName());
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                
                $model = new RaporModel();
                $id_guru = session()->get('id_relasi');

                foreach ($sheetData as $key => $row) {
                    if ($key == 0) continue;
                    if (empty($row[0])) continue;

                    $data = [
                        'id_siswa' => $row[0],
                        'id_kelas' => $row[1],
                        'id_mapel' => $row[2],
                        'id_guru' => $id_guru,
                        'semester' => $row[3],
                        'tahun_ajaran' => $row[4],
                        'nilai' => $row[5]
                    ];
                    $model->insert($data);
                }
                return redirect()->to(base_url('walikelas/akademik/input_nilai'))->with('success', 'Nilai berhasil diimport.');
            }
        }
        return redirect()->to(base_url('walikelas/akademik/input_nilai'))->with('error', 'Gagal upload file.');
    }
}