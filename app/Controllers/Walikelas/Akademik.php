<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\RaporModel;

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

    public function data_siswa()
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

        if($id_kelas_wali){
            $builder = $db->table('jadwal_pelajaran');
            $builder->select('jadwal_pelajaran.*, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru, kelas.nama_kelas');
            $builder->join('mapel', 'mapel.id_mapel = jadwal_pelajaran.id_mapel');
            $builder->join('guru_tendik', 'guru_tendik.id_guru = jadwal_pelajaran.id_guru');
            $builder->join('kelas', 'kelas.id_kelas = jadwal_pelajaran.id_kelas');
            $builder->where('jadwal_pelajaran.id_kelas', $id_kelas_wali);
            $data['jadwal'] = $builder->get()->getResultArray();
        } else {
            $data['jadwal'] = [];
        }
        
        return view('walikelas/jadwal', $data);
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

        $model = new RaporModel();
        $data['tugas'] = $tugas_mengajar;
        
        $builder = $db->table('nilai_rapor');
        $builder->select('nilai_rapor.*, siswa.nama_siswa, kelas.nama_kelas, mapel.nama_mapel');
        $builder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa');
        $builder->join('kelas', 'kelas.id_kelas = nilai_rapor.id_kelas');
        $builder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel');
        $builder->where('nilai_rapor.id_guru', $id_guru);
        
        $data['rapor'] = $builder->get()->getResultArray();
        
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
}