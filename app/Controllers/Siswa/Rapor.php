<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\RaporModel;

class Rapor extends BaseController
{
    public function cetak_rapor()
    {
        $model = new RaporModel();
        $data['rapor'] = $model->where('id_siswa', session()->get('id_relasi'))->findAll();
        return view('siswa/cetak_rapor', $data);
    }
}