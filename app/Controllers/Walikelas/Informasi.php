<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\PengumumanModel;

class Informasi extends BaseController
{
    public function berita()
    {
        $model = new BeritaModel();
        $data['berita'] = $model->where('id_user', session()->get('id_user'))->findAll();
        return view('walikelas/berita', $data);
    }

    public function simpan_berita()
    {
        $model = new BeritaModel();
        $data = [
            'id_kategori_b' => $this->request->getPost('id_kategori_b') ?? 0,
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
        return redirect()->to(base_url('walikelas/informasi/berita'))->with('success', 'Berita berhasil ditambahkan');
    }

    public function update_berita($id)
    {
        $model = new BeritaModel();
        $data = [
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
        return redirect()->to(base_url('walikelas/informasi/berita'))->with('success', 'Berita berhasil diperbarui');
    }

    public function hapus_berita($id)
    {
        $model = new BeritaModel();
        $berita = $model->find($id);
        if ($berita && $berita['thumbnail'] && file_exists('uploads/berita/' . $berita['thumbnail'])) {
            unlink('uploads/berita/' . $berita['thumbnail']);
        }
        $model->delete($id);
        return redirect()->to(base_url('walikelas/informasi/berita'))->with('success', 'Berita berhasil dihapus');
    }

    public function pengumuman()
    {
        $model = new PengumumanModel();
        $data['pengumuman'] = $model->where('id_user', session()->get('id_user'))->findAll();
        return view('walikelas/pengumuman', $data);
    }

    public function simpan_pengumuman()
    {
        $model = new PengumumanModel();
        $data = [
            'id_kategori_p' => $this->request->getPost('id_kategori_p') ?? 0,
            'judul_pengumuman' => $this->request->getPost('judul_pengumuman'),
            'isi_pengumuman' => $this->request->getPost('isi_pengumuman'),
            'id_user' => session()->get('id_user')
        ];
        $model->insert($data);
        return redirect()->to(base_url('walikelas/informasi/pengumuman'))->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function update_pengumuman($id)
    {
        $model = new PengumumanModel();
        $data = [
            'judul_pengumuman' => $this->request->getPost('judul_pengumuman'),
            'isi_pengumuman' => $this->request->getPost('isi_pengumuman')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('walikelas/informasi/pengumuman'))->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function hapus_pengumuman($id)
    {
        $model = new PengumumanModel();
        $model->delete($id);
        return redirect()->to(base_url('walikelas/informasi/pengumuman'))->with('success', 'Pengumuman berhasil dihapus');
    }
}