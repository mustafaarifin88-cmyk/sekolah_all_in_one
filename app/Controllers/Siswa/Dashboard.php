<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_siswa = session()->get('id_relasi');

        $siswa = $db->table('siswa')
                    ->select('siswa.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                    ->where('id_siswa', $id_siswa)
                    ->get()->getRow();

        $data['nama_siswa'] = $siswa ? $siswa->nama_siswa : session()->get('username');
        $data['nama_kelas'] = ($siswa && $siswa->nama_kelas) ? $siswa->nama_kelas : 'Belum Ada Kelas';
        
        $id_kelas = $siswa ? $siswa->id_kelas : null;
        $data['total_mapel'] = $id_kelas ? $db->table('set_mapel_guru')->where('id_kelas', $id_kelas)->groupBy('id_mapel')->countAllResults() : 0;

        return view('siswa/dashboard', $data);
    }
}