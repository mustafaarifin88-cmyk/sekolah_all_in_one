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

        if($id_kelas_wali){
            $builder = $db->table('nilai_rapor');
            $builder->select('nilai_rapor.*, siswa.nama_siswa, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru');
            $builder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa');
            $builder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel');
            $builder->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left');
            $builder->where('nilai_rapor.id_kelas', $id_kelas_wali);
            $data['rapor'] = $builder->get()->getResultArray();
        } else {
            $data['rapor'] = [];
        }
        
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

    public function input_nilai()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('set_mapel_guru.id_kelas, kelas.nama_kelas, set_mapel_guru.id_mapel, mapel.nama_mapel');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
        $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
        $builder->where('set_mapel_guru.id_guru', $id_guru);
        $builder->distinct();
        $data['tugas_mengajar'] = $builder->get()->getResultArray();
        
        $data['siswa'] = [];
        if(!empty($data['tugas_mengajar'])) {
            $id_kelas_array = array_column($data['tugas_mengajar'], 'id_kelas');
            $data['siswa'] = $db->table('siswa')->whereIn('id_kelas', $id_kelas_array)->get()->getResultArray();
        }
        
        $nilaiBuilder = $db->table('nilai_rapor');
        $nilaiBuilder->select('nilai_rapor.*, siswa.nama_siswa, mapel.nama_mapel, kelas.nama_kelas');
        $nilaiBuilder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa', 'left');
        $nilaiBuilder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left');
        $nilaiBuilder->join('kelas', 'kelas.id_kelas = nilai_rapor.id_kelas', 'left');
        $nilaiBuilder->where('nilai_rapor.id_guru', $id_guru);
        $data['nilai_rapor'] = $nilaiBuilder->get()->getResultArray();
        
        return view('walikelas/input_nilai', $data);
    }

    public function simpan_nilai()
    {
        $model = new RaporModel();
        $tugas = explode('-', $this->request->getPost('tugas_mengajar'));
        
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_kelas' => $tugas[0],
            'id_mapel' => $tugas[1],
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
        $tugas = explode('-', $this->request->getPost('tugas_mengajar'));
        
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_kelas' => $tugas[0],
            'id_mapel' => $tugas[1],
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