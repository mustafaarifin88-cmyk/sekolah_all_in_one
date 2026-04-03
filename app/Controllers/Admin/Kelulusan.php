<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SetKelulusanModel;
use App\Models\DataKelulusanModel;
use App\Models\SiswaModel;

class Kelulusan extends BaseController
{
    public function setting()
    {
        $model = new SetKelulusanModel();
        $data['setting'] = $model->findAll();
        return view('admin/kelulusan/setting', $data);
    }

    public function simpan_setting()
    {
        $model = new SetKelulusanModel();
        $data = [
            'tahun_ajar' => $this->request->getPost('tahun_ajar'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'jam_terbit' => $this->request->getPost('jam_terbit'),
            'status' => $this->request->getPost('status')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kelulusan/setting'))->with('success', 'Setting Kelulusan berhasil disimpan.');
    }

    public function update_setting($id)
    {
        $model = new SetKelulusanModel();
        $data = [
            'tahun_ajar' => $this->request->getPost('tahun_ajar'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'jam_terbit' => $this->request->getPost('jam_terbit'),
            'status' => $this->request->getPost('status')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kelulusan/setting'))->with('success', 'Setting Kelulusan berhasil diperbarui.');
    }

    public function hapus_setting($id)
    {
        $model = new SetKelulusanModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kelulusan/setting'))->with('success', 'Setting Kelulusan berhasil dihapus.');
    }

    public function data()
    {
        $model = new DataKelulusanModel();
        $siswaModel = new SiswaModel();
        $data['kelulusan'] = $model->findAll();
        $data['siswa'] = $siswaModel->findAll();
        return view('admin/kelulusan/data', $data);
    }

    public function simpan_data()
    {
        $model = new DataKelulusanModel();
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'nomor_ujian' => $this->request->getPost('nomor_ujian'),
            'status_kelulusan' => $this->request->getPost('status_kelulusan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kelulusan/data'))->with('success', 'Data Kelulusan berhasil disimpan.');
    }

    public function update_data($id)
    {
        $model = new DataKelulusanModel();
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'nomor_ujian' => $this->request->getPost('nomor_ujian'),
            'status_kelulusan' => $this->request->getPost('status_kelulusan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kelulusan/data'))->with('success', 'Data Kelulusan berhasil diperbarui.');
    }

    public function hapus_data($id)
    {
        $model = new DataKelulusanModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kelulusan/data'))->with('success', 'Data Kelulusan berhasil dihapus.');
    }
}