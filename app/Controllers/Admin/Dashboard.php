<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $data['total_siswa'] = $db->table('siswa')->countAllResults();
        $data['total_guru'] = $db->table('guru_tendik')->countAllResults();
        $data['total_kelas'] = $db->table('kelas')->countAllResults();
        $data['total_berita'] = $db->table('berita')->countAllResults();
        
        return view('admin/dashboard', $data);
    }
}