<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KodeSuratModel;
use App\Models\SifatSuratModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Models\GuruModel;

class Administrasi extends BaseController
{
    public function kode_surat()
    {
        $model = new KodeSuratModel();
        $data['kode_surat'] = $model->findAll();
        return view('admin/administrasi/kode_surat', $data);
    }

    public function simpan_kode_surat()
    {
        $model = new KodeSuratModel();
        $data = [
            'kode' => $this->request->getPost('kode'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/administrasi/kode_surat'))->with('success', 'Data Kode Surat berhasil ditambahkan.');
    }

    public function update_kode_surat($id)
    {
        $model = new KodeSuratModel();
        $data = [
            'kode' => $this->request->getPost('kode'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/administrasi/kode_surat'))->with('success', 'Data Kode Surat berhasil diperbarui.');
    }

    public function hapus_kode_surat($id)
    {
        $model = new KodeSuratModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/administrasi/kode_surat'))->with('success', 'Data Kode Surat berhasil dihapus.');
    }

    public function sifat_surat()
    {
        $model = new SifatSuratModel();
        $data['sifat_surat'] = $model->findAll();
        return view('admin/administrasi/sifat_surat', $data);
    }

    public function simpan_sifat_surat()
    {
        $model = new SifatSuratModel();
        $data = [
            'sifat' => $this->request->getPost('sifat'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/administrasi/sifat_surat'))->with('success', 'Data Sifat Surat berhasil ditambahkan.');
    }

    public function update_sifat_surat($id)
    {
        $model = new SifatSuratModel();
        $data = [
            'sifat' => $this->request->getPost('sifat'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/administrasi/sifat_surat'))->with('success', 'Data Sifat Surat berhasil diperbarui.');
    }

    public function hapus_sifat_surat($id)
    {
        $model = new SifatSuratModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/administrasi/sifat_surat'))->with('success', 'Data Sifat Surat berhasil dihapus.');
    }

    public function surat_masuk()
    {
        $model = new SuratMasukModel();
        $guruModel = new GuruModel();
        $kodeModel = new KodeSuratModel();
        $sifatModel = new SifatSuratModel();
        $data['surat_masuk'] = $model->findAll();
        $data['guru'] = $guruModel->findAll();
        $data['kode_surat'] = $kodeModel->findAll();
        $data['sifat_surat'] = $sifatModel->findAll();
        return view('admin/administrasi/surat_masuk', $data);
    }

    public function simpan_surat_masuk()
    {
        $model = new SuratMasukModel();
        $data = [
            'id_kode_surat' => $this->request->getPost('id_kode_surat'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima' => $this->request->getPost('tanggal_diterima'),
            'dari' => $this->request->getPost('dari'),
            'perihal' => $this->request->getPost('perihal'),
            'id_sifat_surat' => $this->request->getPost('id_sifat_surat'),
            'tujuan_id_guru' => $this->request->getPost('tujuan_id_guru')
        ];
        $file = $this->request->getFile('lampiran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/surat_masuk/', $newName);
            $data['lampiran'] = $newName;
        }
        $model->insert($data);
        return redirect()->to(base_url('admin/administrasi/surat_masuk'))->with('success', 'Data Surat Masuk berhasil ditambahkan.');
    }

    public function update_surat_masuk($id)
    {
        $model = new SuratMasukModel();
        $data = [
            'id_kode_surat' => $this->request->getPost('id_kode_surat'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima' => $this->request->getPost('tanggal_diterima'),
            'dari' => $this->request->getPost('dari'),
            'perihal' => $this->request->getPost('perihal'),
            'id_sifat_surat' => $this->request->getPost('id_sifat_surat'),
            'tujuan_id_guru' => $this->request->getPost('tujuan_id_guru')
        ];
        $file = $this->request->getFile('lampiran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $suratLama = $model->find($id);
            if ($suratLama && $suratLama['lampiran'] && file_exists('uploads/surat_masuk/' . $suratLama['lampiran'])) {
                unlink('uploads/surat_masuk/' . $suratLama['lampiran']);
            }
            $newName = $file->getRandomName();
            $file->move('uploads/surat_masuk/', $newName);
            $data['lampiran'] = $newName;
        }
        $model->update($id, $data);
        return redirect()->to(base_url('admin/administrasi/surat_masuk'))->with('success', 'Data Surat Masuk berhasil diperbarui.');
    }

    public function hapus_surat_masuk($id)
    {
        $model = new SuratMasukModel();
        $surat = $model->find($id);
        if ($surat && $surat['lampiran'] && file_exists('uploads/surat_masuk/' . $surat['lampiran'])) {
            unlink('uploads/surat_masuk/' . $surat['lampiran']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/administrasi/surat_masuk'))->with('success', 'Data Surat Masuk berhasil dihapus.');
    }

    public function surat_keluar()
    {
        $model = new SuratKeluarModel();
        $kodeModel = new KodeSuratModel();
        $sifatModel = new SifatSuratModel();
        $data['surat_keluar'] = $model->findAll();
        $data['kode_surat'] = $kodeModel->findAll();
        $data['sifat_surat'] = $sifatModel->findAll();
        return view('admin/administrasi/surat_keluar', $data);
    }

    public function simpan_surat_keluar()
    {
        $model = new SuratKeluarModel();
        $data = [
            'id_kode_surat' => $this->request->getPost('id_kode_surat'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'tujuan_surat' => $this->request->getPost('tujuan_surat'),
            'perihal' => $this->request->getPost('perihal'),
            'id_sifat_surat' => $this->request->getPost('id_sifat_surat')
        ];
        $file = $this->request->getFile('lampiran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/surat_keluar/', $newName);
            $data['lampiran'] = $newName;
        }
        $model->insert($data);
        return redirect()->to(base_url('admin/administrasi/surat_keluar'))->with('success', 'Data Surat Keluar berhasil ditambahkan.');
    }

    public function update_surat_keluar($id)
    {
        $model = new SuratKeluarModel();
        $data = [
            'id_kode_surat' => $this->request->getPost('id_kode_surat'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'tujuan_surat' => $this->request->getPost('tujuan_surat'),
            'perihal' => $this->request->getPost('perihal'),
            'id_sifat_surat' => $this->request->getPost('id_sifat_surat')
        ];
        $file = $this->request->getFile('lampiran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $suratLama = $model->find($id);
            if ($suratLama && $suratLama['lampiran'] && file_exists('uploads/surat_keluar/' . $suratLama['lampiran'])) {
                unlink('uploads/surat_keluar/' . $suratLama['lampiran']);
            }
            $newName = $file->getRandomName();
            $file->move('uploads/surat_keluar/', $newName);
            $data['lampiran'] = $newName;
        }
        $model->update($id, $data);
        return redirect()->to(base_url('admin/administrasi/surat_keluar'))->with('success', 'Data Surat Keluar berhasil diperbarui.');
    }

    public function hapus_surat_keluar($id)
    {
        $model = new SuratKeluarModel();
        $surat = $model->find($id);
        if ($surat && $surat['lampiran'] && file_exists('uploads/surat_keluar/' . $surat['lampiran'])) {
            unlink('uploads/surat_keluar/' . $surat['lampiran']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/administrasi/surat_keluar'))->with('success', 'Data Surat Keluar berhasil dihapus.');
    }
}