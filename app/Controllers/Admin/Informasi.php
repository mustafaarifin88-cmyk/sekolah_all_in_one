<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\KategoriBeritaModel;
use App\Models\PengumumanModel;
use App\Models\KategoriPengumModel;

class Informasi extends BaseController
{
    public function kategori_berita()
    {
        $model = new KategoriBeritaModel();
        $data['kategori'] = $model->findAll();
        return view('admin/informasi/kategori_berita', $data);
    }

    public function simpan_kategori_berita()
    {
        $model = new KategoriBeritaModel();
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $model->insert($data);
        return redirect()->to(base_url('admin/informasi/kategori_berita'))->with('success', 'Kategori Berita berhasil ditambahkan');
    }

    public function update_kategori_berita($id)
    {
        $model = new KategoriBeritaModel();
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/informasi/kategori_berita'))->with('success', 'Kategori Berita berhasil diperbarui');
    }

    public function hapus_kategori_berita($id)
    {
        $model = new KategoriBeritaModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/informasi/kategori_berita'))->with('success', 'Kategori Berita berhasil dihapus');
    }

    public function berita()
    {
        $model = new BeritaModel();
        $katModel = new KategoriBeritaModel();
        $data['berita'] = $model->findAll();
        $data['kategori_list'] = $katModel->findAll();
        return view('admin/informasi/berita', $data);
    }

    public function simpan_berita()
    {
        $model = new BeritaModel();
        $data = [
            'id_kategori_b' => $this->request->getPost('id_kategori_b'),
            'judul_berita' => $this->request->getPost('judul_berita'),
            'isi_berita' => $this->request->getPost('isi_berita'),
            'status_publish' => $this->request->getPost('status_publish'),
            'tanggal_publish' => $this->request->getPost('tanggal_publish'),
            'id_user' => session()->get('id_user')
        ];
        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/berita/', $newName);
            $data['thumbnail'] = $newName;
        }
        $model->insert($data);
        return redirect()->to(base_url('admin/informasi/berita'))->with('success', 'Berita berhasil ditambahkan');
    }

    public function update_berita($id)
    {
        $model = new BeritaModel();
        $data = [
            'id_kategori_b' => $this->request->getPost('id_kategori_b'),
            'judul_berita' => $this->request->getPost('judul_berita'),
            'isi_berita' => $this->request->getPost('isi_berita'),
            'status_publish' => $this->request->getPost('status_publish'),
            'tanggal_publish' => $this->request->getPost('tanggal_publish')
        ];
        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $beritaLama = $model->find($id);
            if ($beritaLama && $beritaLama['thumbnail'] && file_exists('uploads/berita/' . $beritaLama['thumbnail'])) {
                unlink('uploads/berita/' . $beritaLama['thumbnail']);
            }
            $newName = $file->getRandomName();
            $file->move('uploads/berita/', $newName);
            $data['thumbnail'] = $newName;
        }
        $model->update($id, $data);
        return redirect()->to(base_url('admin/informasi/berita'))->with('success', 'Berita berhasil diperbarui');
    }

    public function hapus_berita($id)
    {
        $model = new BeritaModel();
        $berita = $model->find($id);
        if ($berita && $berita['thumbnail'] && file_exists('uploads/berita/' . $berita['thumbnail'])) {
            unlink('uploads/berita/' . $berita['thumbnail']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/informasi/berita'))->with('success', 'Berita berhasil dihapus');
    }

    public function kategori_pengumuman()
    {
        $model = new KategoriPengumModel();
        $data['kategori'] = $model->findAll();
        return view('admin/informasi/kategori_pengumuman', $data);
    }

    public function simpan_kategori_pengumuman()
    {
        $model = new KategoriPengumModel();
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $model->insert($data);
        return redirect()->to(base_url('admin/informasi/kategori_pengumuman'))->with('success', 'Kategori Pengumuman berhasil ditambahkan');
    }

    public function update_kategori_pengumuman($id)
    {
        $model = new KategoriPengumModel();
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/informasi/kategori_pengumuman'))->with('success', 'Kategori Pengumuman berhasil diperbarui');
    }

    public function hapus_kategori_pengumuman($id)
    {
        $model = new KategoriPengumModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/informasi/kategori_pengumuman'))->with('success', 'Kategori Pengumuman berhasil dihapus');
    }

    public function pengumuman()
    {
        $model = new PengumumanModel();
        $katModel = new KategoriPengumModel();
        $data['pengumuman'] = $model->findAll();
        $data['kategori_list'] = $katModel->findAll();
        return view('admin/informasi/pengumuman', $data);
    }

    public function simpan_pengumuman()
    {
        $model = new PengumumanModel();
        $data = [
            'id_kategori_p' => $this->request->getPost('id_kategori_p'),
            'judul_pengumuman' => $this->request->getPost('judul_pengumuman'),
            'isi_pengumuman' => $this->request->getPost('isi_pengumuman'),
            'id_user' => session()->get('id_user')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/informasi/pengumuman'))->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function update_pengumuman($id)
    {
        $model = new PengumumanModel();
        $data = [
            'id_kategori_p' => $this->request->getPost('id_kategori_p'),
            'judul_pengumuman' => $this->request->getPost('judul_pengumuman'),
            'isi_pengumuman' => $this->request->getPost('isi_pengumuman')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/informasi/pengumuman'))->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function hapus_pengumuman($id)
    {
        $model = new PengumumanModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/informasi/pengumuman'))->with('success', 'Pengumuman berhasil dihapus');
    }
}