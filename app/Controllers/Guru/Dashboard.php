<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_guru = session()->get('id_relasi');
        $id_user = session()->get('id_user');

        $data['total_kelas'] = $db->table('set_mapel_guru')->where('id_guru', $id_guru)->groupBy('id_kelas')->countAllResults();

        $kelas_ids = $db->table('set_mapel_guru')->select('id_kelas')->where('id_guru', $id_guru)->groupBy('id_kelas')->get()->getResultArray();
        $ids = array_column($kelas_ids, 'id_kelas');
        $data['total_siswa'] = empty($ids) ? 0 : $db->table('siswa')->whereIn('id_kelas', $ids)->countAllResults();

        $beban = $db->table('beban_kerja_guru')->where('id_guru', $id_guru)->get()->getRow();
        $data['total_jam'] = $beban ? $beban->jumlah_jam_kerja : 0;

        $data['total_berita'] = $db->table('berita')->where('id_user', $id_user)->countAllResults();

        $guru = $db->table('guru_tendik')->where('id_guru', $id_guru)->get()->getRow();
        if ($guru) {
            $gd = $guru->gelar_depan ? $guru->gelar_depan . ' ' : '';
            $gb = $guru->gelar_belakang ? ', ' . $guru->gelar_belakang : '';
            $data['nama_lengkap_guru'] = $gd . $guru->nama_lengkap . $gb;
        } else {
            $data['nama_lengkap_guru'] = session()->get('username');
        }

        return view('guru/dashboard', $data);
    }
}