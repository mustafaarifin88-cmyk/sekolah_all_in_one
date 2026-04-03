<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        $id_user = session()->get('id_user');

        $wali = $db->table('set_kelas_wali')->where('id_guru', $id_guru)->get()->getRow();
        $id_kelas_wali = $wali ? $wali->id_kelas : null;

        $data['total_siswa'] = $id_kelas_wali ? $db->table('siswa')->where('id_kelas', $id_kelas_wali)->countAllResults() : 0;
        $data['total_mapel'] = $db->table('set_mapel_guru')->where('id_guru', $id_guru)->groupBy('id_mapel')->countAllResults();

        $beban = $db->table('beban_kerja_guru')->where('id_guru', $id_guru)->get()->getRow();
        $data['total_jam'] = $beban ? $beban->jumlah_jam_kerja : 0;

        $data['total_pengumuman'] = $db->table('pengumuman')->where('id_user', $id_user)->countAllResults();

        $guru = $db->table('guru_tendik')->where('id_guru', $id_guru)->get()->getRow();
        if ($guru) {
            $gd = $guru->gelar_depan ? $guru->gelar_depan . ' ' : '';
            $gb = $guru->gelar_belakang ? ', ' . $guru->gelar_belakang : '';
            $data['nama_lengkap_guru'] = $gd . $guru->nama_lengkap . $gb;
        } else {
            $data['nama_lengkap_guru'] = session()->get('username');
        }

        return view('walikelas/dashboard', $data);
    }
}