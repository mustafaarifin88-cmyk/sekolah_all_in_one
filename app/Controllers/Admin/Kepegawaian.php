<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendidikanGuruModel;
use App\Models\PangkatGuruModel;
use App\Models\SertifikasiModel;
use App\Models\BebanKerjaModel;
use App\Models\GuruModel;

class Kepegawaian extends BaseController
{
    public function riwayat_pendidikan()
    {
        $model = new PendidikanGuruModel();
        $guruModel = new GuruModel();
        $data['pendidikan'] = $model->findAll();
        $data['guru'] = $guruModel->findAll();
        return view('admin/kepegawaian/riwayat_pendidikan', $data);
    }

    public function simpan_riwayat_pendidikan()
    {
        $model = new PendidikanGuruModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pendidikan'))->with('success', 'Data Pendidikan berhasil ditambahkan.');
    }

    public function update_riwayat_pendidikan($id)
    {
        $model = new PendidikanGuruModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pendidikan'))->with('success', 'Data Pendidikan berhasil diperbarui.');
    }

    public function hapus_riwayat_pendidikan($id)
    {
        $model = new PendidikanGuruModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pendidikan'))->with('success', 'Data Pendidikan berhasil dihapus.');
    }

    public function riwayat_pangkat()
    {
        $model = new PangkatGuruModel();
        $guruModel = new GuruModel();
        $data['pangkat'] = $model->findAll();
        $data['guru'] = $guruModel->findAll();
        return view('admin/kepegawaian/riwayat_pangkat', $data);
    }

    public function simpan_riwayat_pangkat()
    {
        $model = new PangkatGuruModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'golongan' => $this->request->getPost('golongan'),
            'no_sk' => $this->request->getPost('no_sk'),
            'tmt_pangkat' => $this->request->getPost('tmt_pangkat'),
            'tahun_sk' => $this->request->getPost('tahun_sk')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pangkat'))->with('success', 'Data Pangkat berhasil ditambahkan.');
    }

    public function update_riwayat_pangkat($id)
    {
        $model = new PangkatGuruModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'golongan' => $this->request->getPost('golongan'),
            'no_sk' => $this->request->getPost('no_sk'),
            'tmt_pangkat' => $this->request->getPost('tmt_pangkat'),
            'tahun_sk' => $this->request->getPost('tahun_sk')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pangkat'))->with('success', 'Data Pangkat berhasil diperbarui.');
    }

    public function hapus_riwayat_pangkat($id)
    {
        $model = new PangkatGuruModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kepegawaian/riwayat_pangkat'))->with('success', 'Data Pangkat berhasil dihapus.');
    }

    public function sertifikasi()
    {
        $model = new SertifikasiModel();
        $guruModel = new GuruModel();
        $data['sertifikasi'] = $model->findAll();
        $data['guru'] = $guruModel->findAll();
        return view('admin/kepegawaian/sertifikasi', $data);
    }

    public function simpan_sertifikasi()
    {
        $model = new SertifikasiModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'nama_sertifikasi' => $this->request->getPost('nama_sertifikasi'),
            'tahun' => $this->request->getPost('tahun'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil ditambahkan.');
    }

    public function update_sertifikasi($id)
    {
        $model = new SertifikasiModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'nama_sertifikasi' => $this->request->getPost('nama_sertifikasi'),
            'tahun' => $this->request->getPost('tahun'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil diperbarui.');
    }

    public function hapus_sertifikasi($id)
    {
        $model = new SertifikasiModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kepegawaian/sertifikasi'))->with('success', 'Data Sertifikasi berhasil dihapus.');
    }

    public function beban_kerja()
    {
        $model = new BebanKerjaModel();
        $guruModel = new GuruModel();
        $data['beban'] = $model->findAll();
        $data['guru'] = $guruModel->findAll();
        return view('admin/kepegawaian/beban_kerja', $data);
    }

    public function simpan_beban_kerja()
    {
        $model = new BebanKerjaModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'jumlah_jam_kerja' => $this->request->getPost('jumlah_jam_kerja')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kepegawaian/beban_kerja'))->with('success', 'Data Beban Kerja berhasil ditambahkan.');
    }

    public function update_beban_kerja($id)
    {
        $model = new BebanKerjaModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'jumlah_jam_kerja' => $this->request->getPost('jumlah_jam_kerja')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kepegawaian/beban_kerja'))->with('success', 'Data Beban Kerja berhasil diperbarui.');
    }

    public function hapus_beban_kerja($id)
    {
        $model = new BebanKerjaModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kepegawaian/beban_kerja'))->with('success', 'Data Beban Kerja berhasil dihapus.');
    }
}