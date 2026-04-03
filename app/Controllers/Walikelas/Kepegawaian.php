<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\PendidikanGuruModel;
use App\Models\SertifikasiModel;
use App\Models\BebanKerjaModel;

class Kepegawaian extends BaseController
{
    public function riwayat()
    {
        $model = new PendidikanGuruModel();
        $data['pendidikan'] = $model->where('id_guru', session()->get('id_relasi'))->findAll();
        return view('walikelas/riwayat', $data);
    }

    public function simpan_riwayat()
    {
        $model = new PendidikanGuruModel();
        $data = [
            'id_guru' => session()->get('id_relasi'),
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus')
        ];
        $model->insert($data);
        return redirect()->to(base_url('walikelas/kepegawaian/riwayat'))->with('success', 'Data Riwayat berhasil ditambahkan.');
    }

    public function update_riwayat($id)
    {
        $model = new PendidikanGuruModel();
        $data = [
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('walikelas/kepegawaian/riwayat'))->with('success', 'Data Riwayat berhasil diperbarui.');
    }

    public function hapus_riwayat($id)
    {
        $model = new PendidikanGuruModel();
        $model->delete($id);
        return redirect()->to(base_url('walikelas/kepegawaian/riwayat'))->with('success', 'Data Riwayat berhasil dihapus.');
    }

    public function sertifikasi()
    {
        $model = new SertifikasiModel();
        $data['sertifikasi'] = $model->where('id_guru', session()->get('id_relasi'))->findAll();
        return view('walikelas/sertifikasi', $data);
    }

    public function simpan_sertifikasi()
    {
        $model = new SertifikasiModel();
        $data = [
            'id_guru' => session()->get('id_relasi'),
            'nama_sertifikasi' => $this->request->getPost('nama_sertifikasi'),
            'tahun' => $this->request->getPost('tahun'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('walikelas/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil ditambahkan.');
    }

    public function update_sertifikasi($id)
    {
        $model = new SertifikasiModel();
        $data = [
            'nama_sertifikasi' => $this->request->getPost('nama_sertifikasi'),
            'tahun' => $this->request->getPost('tahun'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('walikelas/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil diperbarui.');
    }

    public function hapus_sertifikasi($id)
    {
        $model = new SertifikasiModel();
        $model->delete($id);
        return redirect()->to(base_url('walikelas/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil dihapus.');
    }

    public function beban_kerja()
    {
        $model = new BebanKerjaModel();
        $data['beban'] = $model->where('id_guru', session()->get('id_relasi'))->findAll();
        return view('walikelas/beban_kerja', $data);
    }
}