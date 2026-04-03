<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\RaporModel;

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
        $builder->orderBy('set_mapel_guru.hari', 'ASC');
        
        $data['jadwal'] = $builder->get()->getResultArray();
        return view('guru/jadwal', $data);
    }

    public function data_kelas()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('kelas.id_kelas, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
        $builder->where('set_mapel_guru.id_guru', $id_guru);
        $builder->distinct();
        
        $data['kelas'] = $builder->get()->getResultArray();
        return view('guru/data_kelas', $data);
    }

    public function data_siswa($id_kelas = null)
    {
        if (!$id_kelas) return redirect()->to(base_url('guru/akademik/data_kelas'));
        
        $db = \Config\Database::connect();
        $kelas = $db->table('kelas')->where('id_kelas', $id_kelas)->get()->getRowArray();
        
        $builder = $db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $builder->where('siswa.id_kelas', $id_kelas);
        
        $data['siswa'] = $builder->get()->getResultArray();
        $data['nama_kelas_aktif'] = $kelas ? $kelas['nama_kelas'] : 'Tidak Diketahui';
        
        return view('guru/data_siswa', $data);
    }

    public function input_nilai()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        
        $tugas_mengajar = $db->table('set_mapel_guru')
            ->select('set_mapel_guru.*, kelas.nama_kelas, mapel.nama_mapel')
            ->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas')
            ->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel')
            ->where('set_mapel_guru.id_guru', $id_guru)
            ->get()->getResultArray();
            
        $kelas_ids = array_column($tugas_mengajar, 'id_kelas');
        
        if(!empty($kelas_ids)){
            $data['siswa'] = $db->table('siswa')->whereIn('id_kelas', $kelas_ids)->get()->getResultArray();
        } else {
            $data['siswa'] = [];
        }

        $data['tugas'] = $tugas_mengajar;
        
        $builder = $db->table('nilai_rapor');
        $builder->select('nilai_rapor.*, siswa.nama_siswa, kelas.nama_kelas, mapel.nama_mapel');
        $builder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa');
        $builder->join('kelas', 'kelas.id_kelas = nilai_rapor.id_kelas');
        $builder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel');
        $builder->where('nilai_rapor.id_guru', $id_guru);
        
        $data['rapor'] = $builder->get()->getResultArray();
        
        return view('guru/input_nilai', $data);
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
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Nilai berhasil ditambahkan.');
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
        return redirect()->to(base_url('guru/akademik/input_nilai'))->with('success', 'Import Nilai berhasil dilakukan.');
    }
}