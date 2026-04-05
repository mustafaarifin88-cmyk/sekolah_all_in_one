<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\RaporModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Akademik extends BaseController
{
    public function jadwal()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('set_mapel_guru.*, kelas.nama_kelas, mapel.nama_mapel');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
        $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
        $builder->where('set_mapel_guru.id_guru', $id_guru);
        $builder->orderBy('FIELD(set_mapel_guru.hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")');
        $builder->orderBy('set_mapel_guru.jam_mulai', 'ASC');
        
        $data['jadwal'] = $builder->get()->getResultArray();
        return view('guru/jadwal', $data);
    }

    public function data_kelas()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('kelas.id_kelas, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas');
        $builder->where('set_mapel_guru.id_guru', $id_guru);
        $builder->distinct();
        $data['kelas'] = $builder->get()->getResultArray();
        
        return view('guru/data_kelas', $data);
    }

    public function data_siswa($id_kelas)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $builder->where('siswa.id_kelas', $id_kelas);
        
        $data['siswa'] = $builder->get()->getResultArray();
        return view('guru/data_siswa', $data);
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
        
        return view('guru/input_nilai', $data);
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
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Nilai berhasil ditambahkan.');
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
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Nilai berhasil diperbarui.');
    }

    public function hapus_nilai($id)
    {
        $model = new RaporModel();
        $model->delete($id);
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Nilai berhasil dihapus.');
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
                return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Nilai berhasil diimport.');
            }
        }
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('error', 'Gagal upload file.');
    }
}