<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KeuanganBosModel;
use App\Models\PengeluaranModel;

class Keuangan extends BaseController
{
    public function bos()
    {
        $model = new KeuanganBosModel();
        $data['bos'] = $model->findAll();
        return view('admin/keuangan/bos', $data);
    }

    public function simpan_bos()
    {
        $model = new KeuanganBosModel();
        $data = [
            'jumlah_dana_masuk' => $this->request->getPost('jumlah_dana_masuk'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tahun_anggaran' => $this->request->getPost('tahun_anggaran')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil ditambahkan.');
    }

    public function update_bos($id)
    {
        $model = new KeuanganBosModel();
        $data = [
            'jumlah_dana_masuk' => $this->request->getPost('jumlah_dana_masuk'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tahun_anggaran' => $this->request->getPost('tahun_anggaran')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil diperbarui.');
    }

    public function hapus_bos($id)
    {
        $model = new KeuanganBosModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/keuangan/bos'))->with('success', 'Data Dana BOS berhasil dihapus.');
    }

    public function pengeluaran()
    {
        $model = new PengeluaranModel();
        $data['pengeluaran'] = $model->findAll();
        return view('admin/keuangan/pengeluaran', $data);
    }

    public function simpan_pengeluaran()
    {
        $model = new PengeluaranModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengeluaran' => $this->request->getPost('nama_pengeluaran'),
            'jumlah_pengeluaran' => $this->request->getPost('jumlah_pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil ditambahkan.');
    }

    public function update_pengeluaran($id)
    {
        $model = new PengeluaranModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengeluaran' => $this->request->getPost('nama_pengeluaran'),
            'jumlah_pengeluaran' => $this->request->getPost('jumlah_pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil diperbarui.');
    }

    public function hapus_pengeluaran($id)
    {
        $model = new PengeluaranModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/keuangan/pengeluaran'))->with('success', 'Data Pengeluaran berhasil dihapus.');
    }

    public function laporan()
    {
        return view('admin/keuangan/laporan');
    }
}