<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EskulModel;
use App\Models\PrestasiModel;
use App\Models\DisiplinModel;
use App\Models\OrganisasiModel;
use App\Models\BkModel;
use App\Models\SiswaModel;

class Kesiswaan extends BaseController
{
    public function eskul()
    {
        $model = new EskulModel();
        $data['eskul'] = $model->findAll();
        return view('admin/kesiswaan/eskul', $data);
    }

    public function simpan_eskul()
    {
        $model = new EskulModel();
        $data = ['nama_eskul' => $this->request->getPost('nama_eskul')];
        $model->insert($data);
        return redirect()->to(base_url('admin/kesiswaan/eskul'))->with('success', 'Data Ekstrakurikuler berhasil ditambahkan.');
    }

    public function update_eskul($id)
    {
        $model = new EskulModel();
        $data = ['nama_eskul' => $this->request->getPost('nama_eskul')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kesiswaan/eskul'))->with('success', 'Data Ekstrakurikuler berhasil diperbarui.');
    }

    public function hapus_eskul($id)
    {
        $model = new EskulModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kesiswaan/eskul'))->with('success', 'Data Ekstrakurikuler berhasil dihapus.');
    }

    public function prestasi()
    {
        $model = new PrestasiModel();
        $data['prestasi'] = $model->findAll();
        return view('admin/kesiswaan/prestasi', $data);
    }

    public function simpan_prestasi()
    {
        $model = new PrestasiModel();
        $data = ['nama_prestasi' => $this->request->getPost('nama_prestasi')];
        $model->insert($data);
        return redirect()->to(base_url('admin/kesiswaan/prestasi'))->with('success', 'Data Prestasi berhasil ditambahkan.');
    }

    public function update_prestasi($id)
    {
        $model = new PrestasiModel();
        $data = ['nama_prestasi' => $this->request->getPost('nama_prestasi')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kesiswaan/prestasi'))->with('success', 'Data Prestasi berhasil diperbarui.');
    }

    public function hapus_prestasi($id)
    {
        $model = new PrestasiModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kesiswaan/prestasi'))->with('success', 'Data Prestasi berhasil dihapus.');
    }

    public function disiplin()
    {
        $model = new DisiplinModel();
        $data['disiplin'] = $model->findAll();
        return view('admin/kesiswaan/disiplin', $data);
    }

    public function simpan_disiplin()
    {
        $model = new DisiplinModel();
        $data = [
            'nama_pelanggaran' => $this->request->getPost('nama_pelanggaran'),
            'poin' => $this->request->getPost('poin')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kesiswaan/disiplin'))->with('success', 'Data Kedisiplinan berhasil ditambahkan.');
    }

    public function update_disiplin($id)
    {
        $model = new DisiplinModel();
        $data = [
            'nama_pelanggaran' => $this->request->getPost('nama_pelanggaran'),
            'poin' => $this->request->getPost('poin')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kesiswaan/disiplin'))->with('success', 'Data Kedisiplinan berhasil diperbarui.');
    }

    public function hapus_disiplin($id)
    {
        $model = new DisiplinModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kesiswaan/disiplin'))->with('success', 'Data Kedisiplinan berhasil dihapus.');
    }

    public function organisasi()
    {
        $model = new OrganisasiModel();
        $data['organisasi'] = $model->findAll();
        return view('admin/kesiswaan/organisasi', $data);
    }

    public function simpan_organisasi()
    {
        $model = new OrganisasiModel();
        $data = ['nama_organisasi' => $this->request->getPost('nama_organisasi')];
        $model->insert($data);
        return redirect()->to(base_url('admin/kesiswaan/organisasi'))->with('success', 'Data Organisasi berhasil ditambahkan.');
    }

    public function update_organisasi($id)
    {
        $model = new OrganisasiModel();
        $data = ['nama_organisasi' => $this->request->getPost('nama_organisasi')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kesiswaan/organisasi'))->with('success', 'Data Organisasi berhasil diperbarui.');
    }

    public function hapus_organisasi($id)
    {
        $model = new OrganisasiModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kesiswaan/organisasi'))->with('success', 'Data Organisasi berhasil dihapus.');
    }

    public function bk()
    {
        $model = new BkModel();
        $siswaModel = new SiswaModel();
        $data['bk'] = $model->findAll();
        $data['siswa'] = $siswaModel->findAll();
        return view('admin/kesiswaan/bk', $data);
    }

    public function simpan_bk()
    {
        $model = new BkModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'id_siswa' => $this->request->getPost('id_siswa'),
            'judul_kasus' => $this->request->getPost('judul_kasus'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/kesiswaan/bk'))->with('success', 'Data BK berhasil ditambahkan.');
    }

    public function update_bk($id)
    {
        $model = new BkModel();
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'id_siswa' => $this->request->getPost('id_siswa'),
            'judul_kasus' => $this->request->getPost('judul_kasus'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/kesiswaan/bk'))->with('success', 'Data BK berhasil diperbarui.');
    }

    public function hapus_bk($id)
    {
        $model = new BkModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/kesiswaan/bk'))->with('success', 'Data BK berhasil dihapus.');
    }
}