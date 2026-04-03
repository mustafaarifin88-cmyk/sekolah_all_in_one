<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\IdentitasSekolahModel;
use App\Models\MenuEksternalModel;
use App\Models\TemaModel;
use App\Models\SliderModel;
use App\Models\SetMapelGuruModel;
use App\Models\SetKelasWaliModel;
use App\Models\UserModel;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\KelasModel;

class Aplikasi extends BaseController
{
    public function profil()
    {
        $model = new UserModel();
        $data['profil'] = $model->find(session()->get('id_user'));
        return view('admin/aplikasi/profil', $data);
    }

    public function update_profil()
    {
        $model = new UserModel();
        $id = session()->get('id_user');
        $data = ['username' => $this->request->getPost('username')];
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil/', $newName);
            $data['foto'] = $newName;
            session()->set('foto', $newName);
        }
        session()->set('username', $data['username']);
        $model->update($id, $data);
        return redirect()->to(base_url('admin/aplikasi/profil'))->with('success', 'Profil admin berhasil diperbarui!');
    }

    public function identitas()
    {
        $model = new IdentitasSekolahModel();
        $data['identitas'] = $model->first();
        return view('admin/aplikasi/identitas', $data);
    }

    public function update_identitas()
    {
        $model = new IdentitasSekolahModel();
        $identitas = $model->first();
        $id = $identitas ? $identitas['id'] : null;
        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat_sekolah' => $this->request->getPost('alamat_sekolah'),
            'nama_dinas' => $this->request->getPost('nama_dinas')
        ];
        $logo = $this->request->getFile('logo_sekolah');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move('uploads/identitas/', $newName);
            $data['logo_sekolah'] = $newName;
        }
        $logoPemda = $this->request->getFile('logo_pemda');
        if ($logoPemda && $logoPemda->isValid() && !$logoPemda->hasMoved()) {
            $newNamePemda = $logoPemda->getRandomName();
            $logoPemda->move('uploads/identitas/', $newNamePemda);
            $data['logo_pemda'] = $newNamePemda;
        }
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('admin/aplikasi/identitas'))->with('success', 'Data Identitas berhasil diperbarui!');
    }

    public function kepsek()
    {
        $model = new IdentitasSekolahModel();
        $data['identitas'] = $model->first();
        return view('admin/aplikasi/kepsek', $data);
    }

    public function update_kepsek()
    {
        $model = new IdentitasSekolahModel();
        $identitas = $model->first();
        $id = $identitas ? $identitas['id'] : null;
        $data = [
            'nama_kepsek' => $this->request->getPost('nama_kepsek'),
            'nip_kepsek' => $this->request->getPost('nip_kepsek'),
            'sk_kepsek' => $this->request->getPost('sk_kepsek')
        ];
        $fotoKepsek = $this->request->getFile('foto_kepsek');
        if ($fotoKepsek && $fotoKepsek->isValid() && !$fotoKepsek->hasMoved()) {
            $newName = $fotoKepsek->getRandomName();
            $fotoKepsek->move('uploads/identitas/', $newName);
            $data['foto_kepsek'] = $newName;
        }
        $ttdKepsek = $this->request->getFile('ttd_kepsek');
        if ($ttdKepsek && $ttdKepsek->isValid() && !$ttdKepsek->hasMoved()) {
            $newNameTtd = $ttdKepsek->getRandomName();
            $ttdKepsek->move('uploads/identitas/', $newNameTtd);
            $data['ttd_kepsek'] = $newNameTtd;
        }
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('admin/aplikasi/kepsek'))->with('success', 'Data Kepala Sekolah berhasil diperbarui!');
    }

    public function menu()
    {
        $model = new MenuEksternalModel();
        $data['menu'] = $model->orderBy('urutan', 'ASC')->findAll();
        return view('admin/aplikasi/menu', $data);
    }

    public function simpan_menu()
    {
        $model = new MenuEksternalModel();
        $data = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'link_eksternal' => $this->request->getPost('link_eksternal'),
            'urutan' => $this->request->getPost('urutan')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/aplikasi/menu'))->with('success', 'Menu Eksternal berhasil ditambahkan.');
    }

    public function update_menu($id)
    {
        $model = new MenuEksternalModel();
        $data = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'link_eksternal' => $this->request->getPost('link_eksternal'),
            'urutan' => $this->request->getPost('urutan')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/aplikasi/menu'))->with('success', 'Menu Eksternal berhasil diperbarui.');
    }

    public function hapus_menu($id)
    {
        $model = new MenuEksternalModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/aplikasi/menu'))->with('success', 'Menu Eksternal berhasil dihapus.');
    }

    public function tema()
    {
        $model = new TemaModel();
        $data['tema'] = $model->first();
        return view('admin/aplikasi/tema', $data);
    }

    public function update_tema()
    {
        $model = new TemaModel();
        $tema = $model->first();
        $id = $tema ? $tema['id'] : null;
        $data = ['tema_header' => $this->request->getPost('tema_header')];
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('admin/aplikasi/tema'))->with('success', 'Tema Header berhasil diperbarui!');
    }

    public function visimisi()
    {
        $model = new IdentitasSekolahModel();
        $data['visimisi'] = $model->first();
        return view('admin/aplikasi/visimisi', $data);
    }

    public function update_visimisi()
    {
        $model = new IdentitasSekolahModel();
        $identitas = $model->first();
        $id = $identitas ? $identitas['id'] : null;
        $data = ['visi_misi' => $this->request->getPost('visi_misi')];
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('admin/aplikasi/visimisi'))->with('success', 'Visi Misi Sekolah berhasil diperbarui!');
    }

    public function set_kelas()
    {
        $guruModel = new GuruModel();
        $kelasModel = new KelasModel();
        $db = \Config\Database::connect();
        $builder = $db->table('set_kelas_wali');
        $builder->select('set_kelas_wali.*, guru_tendik.nama_lengkap as nama_guru, kelas.nama_kelas');
        $builder->join('guru_tendik', 'guru_tendik.id_guru = set_kelas_wali.id_guru', 'left');
        $builder->join('kelas', 'kelas.id_kelas = set_kelas_wali.id_kelas', 'left');
        
        $data['set_kelas'] = $builder->get()->getResultArray();
        $data['guru'] = $guruModel->findAll();
        $data['kelas'] = $kelasModel->findAll();
        return view('admin/aplikasi/set_kelas', $data);
    }

    public function simpan_set_kelas()
    {
        $model = new SetKelasWaliModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'id_kelas' => $this->request->getPost('id_kelas')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/aplikasi/set_kelas'))->with('success', 'Wali Kelas berhasil diset.');
    }

    public function update_set_kelas($id)
    {
        $model = new SetKelasWaliModel();
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'id_kelas' => $this->request->getPost('id_kelas')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/aplikasi/set_kelas'))->with('success', 'Data Set Wali Kelas berhasil diperbarui.');
    }

    public function hapus_set_kelas($id)
    {
        $model = new SetKelasWaliModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/aplikasi/set_kelas'))->with('success', 'Set Wali Kelas berhasil dihapus.');
    }

    public function set_mapel()
    {
        $guruModel = new GuruModel();
        $mapelModel = new MapelModel();
        $kelasModel = new KelasModel();
        $db = \Config\Database::connect();
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('set_mapel_guru.*, guru_tendik.nama_lengkap as nama_guru, mapel.nama_mapel, kelas.nama_kelas');
        $builder->join('guru_tendik', 'guru_tendik.id_guru = set_mapel_guru.id_guru', 'left');
        $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
        $builder->orderBy('kelas.nama_kelas', 'ASC');
        $builder->orderBy('set_mapel_guru.hari', 'ASC');

        $data['set_mapel'] = $builder->get()->getResultArray();
        $data['guru'] = $guruModel->findAll();
        $data['mapel'] = $mapelModel->findAll();
        $data['kelas'] = $kelasModel->findAll();
        return view('admin/aplikasi/set_mapel', $data);
    }

    public function simpan_set_mapel()
    {
        $model = new SetMapelGuruModel();
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'id_guru' => $this->request->getPost('id_guru'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/aplikasi/set_mapel'))->with('success', 'Jadwal & Tugas Mapel berhasil diset.');
    }

    public function update_set_mapel($id)
    {
        $model = new SetMapelGuruModel();
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'id_guru' => $this->request->getPost('id_guru'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/aplikasi/set_mapel'))->with('success', 'Jadwal & Tugas Mapel berhasil diperbarui.');
    }

    public function hapus_set_mapel($id)
    {
        $model = new SetMapelGuruModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/aplikasi/set_mapel'))->with('success', 'Jadwal & Tugas Mapel berhasil dihapus.');
    }

    public function slider()
    {
        $model = new SliderModel();
        $data['slider'] = $model->findAll();
        return view('admin/aplikasi/slider', $data);
    }

    public function simpan_slider()
    {
        $model = new SliderModel();
        $data = [
            'judul' => $this->request->getPost('judul'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/slider/', $newName);
            $data['foto'] = $newName;
        }
        $model->insert($data);
        return redirect()->to(base_url('admin/aplikasi/slider'))->with('success', 'Slider berhasil ditambahkan.');
    }

    public function update_slider($id)
    {
        $model = new SliderModel();
        $data = [
            'judul' => $this->request->getPost('judul'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $sliderLama = $model->find($id);
            if ($sliderLama && $sliderLama['foto'] && file_exists('uploads/slider/' . $sliderLama['foto'])) {
                unlink('uploads/slider/' . $sliderLama['foto']);
            }
            $newName = $foto->getRandomName();
            $foto->move('uploads/slider/', $newName);
            $data['foto'] = $newName;
        }
        $model->update($id, $data);
        return redirect()->to(base_url('admin/aplikasi/slider'))->with('success', 'Slider berhasil diperbarui.');
    }

    public function hapus_slider($id)
    {
        $model = new SliderModel();
        $slider = $model->find($id);
        if ($slider && $slider['foto'] && file_exists('uploads/slider/' . $slider['foto'])) {
            unlink('uploads/slider/' . $slider['foto']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/aplikasi/slider'))->with('success', 'Slider berhasil dihapus.');
    }
}