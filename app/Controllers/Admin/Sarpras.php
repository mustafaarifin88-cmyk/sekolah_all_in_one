<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RuangModel;
use App\Models\KondisiModel;
use App\Models\BarangModel;
use App\Models\KerusakanModel;

class Sarpras extends BaseController
{
    public function ruang()
    {
        $model = new RuangModel();
        $data['ruang'] = $model->findAll();
        return view('admin/sarpras/ruang', $data);
    }

    public function simpan_ruang()
    {
        $model = new RuangModel();
        $data = ['nama_ruang' => $this->request->getPost('nama_ruang')];
        $model->insert($data);
        return redirect()->to(base_url('admin/sarpras/ruang'))->with('success', 'Data Ruang berhasil ditambahkan.');
    }

    public function update_ruang($id)
    {
        $model = new RuangModel();
        $data = ['nama_ruang' => $this->request->getPost('nama_ruang')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/sarpras/ruang'))->with('success', 'Data Ruang berhasil diperbarui.');
    }

    public function hapus_ruang($id)
    {
        $model = new RuangModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/sarpras/ruang'))->with('success', 'Data Ruang berhasil dihapus.');
    }

    public function kondisi()
    {
        $model = new KondisiModel();
        $data['kondisi'] = $model->findAll();
        return view('admin/sarpras/kondisi', $data);
    }

    public function simpan_kondisi()
    {
        $model = new KondisiModel();
        $data = ['nama_kondisi' => $this->request->getPost('nama_kondisi')];
        $model->insert($data);
        return redirect()->to(base_url('admin/sarpras/kondisi'))->with('success', 'Data Kondisi berhasil ditambahkan.');
    }

    public function update_kondisi($id)
    {
        $model = new KondisiModel();
        $data = ['nama_kondisi' => $this->request->getPost('nama_kondisi')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/sarpras/kondisi'))->with('success', 'Data Kondisi berhasil diperbarui.');
    }

    public function hapus_kondisi($id)
    {
        $model = new KondisiModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/sarpras/kondisi'))->with('success', 'Data Kondisi berhasil dihapus.');
    }

    public function barang()
    {
        $model = new BarangModel();
        $ruangModel = new RuangModel();
        $kondisiModel = new KondisiModel();
        $data['barang'] = $model->findAll();
        $data['ruang'] = $ruangModel->findAll();
        $data['kondisi'] = $kondisiModel->findAll();
        return view('admin/sarpras/barang', $data);
    }

    public function simpan_barang()
    {
        $model = new BarangModel();
        $data = [
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_ruang' => $this->request->getPost('id_ruang'),
            'id_kondisi' => $this->request->getPost('id_kondisi')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/sarpras/barang'))->with('success', 'Data Barang berhasil ditambahkan.');
    }

    public function update_barang($id)
    {
        $model = new BarangModel();
        $data = [
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_ruang' => $this->request->getPost('id_ruang'),
            'id_kondisi' => $this->request->getPost('id_kondisi')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/sarpras/barang'))->with('success', 'Data Barang berhasil diperbarui.');
    }

    public function hapus_barang($id)
    {
        $model = new BarangModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/sarpras/barang'))->with('success', 'Data Barang berhasil dihapus.');
    }

    public function kerusakan()
    {
        $model = new KerusakanModel();
        $barangModel = new BarangModel();
        $data['kerusakan'] = $model->findAll();
        $data['barang'] = $barangModel->findAll();
        return view('admin/sarpras/kerusakan', $data);
    }

    public function simpan_kerusakan()
    {
        $model = new KerusakanModel();
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'tingkat_kondisi' => $this->request->getPost('tingkat_kondisi'),
            'tanggal_lapor' => $this->request->getPost('tanggal_lapor'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/sarpras/kerusakan'))->with('success', 'Data Kerusakan berhasil ditambahkan.');
    }

    public function update_kerusakan($id)
    {
        $model = new KerusakanModel();
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'tingkat_kondisi' => $this->request->getPost('tingkat_kondisi'),
            'tanggal_lapor' => $this->request->getPost('tanggal_lapor'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/sarpras/kerusakan'))->with('success', 'Data Kerusakan berhasil diperbarui.');
    }

    public function hapus_kerusakan($id)
    {
        $model = new KerusakanModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/sarpras/kerusakan'))->with('success', 'Data Kerusakan berhasil dihapus.');
    }
}