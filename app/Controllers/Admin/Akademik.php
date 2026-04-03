<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KurikulumModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\JadwalModel;
use App\Models\RaporModel;
use App\Models\UserModel;

class Akademik extends BaseController
{
    public function kurikulum()
    {
        $model = new KurikulumModel();
        $data['kurikulum'] = $model->findAll();
        return view('admin/akademik/kurikulum', $data);
    }

    public function simpan_kurikulum()
    {
        $model = new KurikulumModel();
        $data = ['nama_kurikulum' => $this->request->getPost('nama_kurikulum')];
        $model->insert($data);
        return redirect()->to(base_url('admin/akademik/kurikulum'))->with('success', 'Data Kurikulum berhasil ditambahkan.');
    }

    public function update_kurikulum($id)
    {
        $model = new KurikulumModel();
        $data = ['nama_kurikulum' => $this->request->getPost('nama_kurikulum')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/akademik/kurikulum'))->with('success', 'Data Kurikulum berhasil diperbarui.');
    }

    public function hapus_kurikulum($id)
    {
        $model = new KurikulumModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/kurikulum'))->with('success', 'Data Kurikulum berhasil dihapus.');
    }

    public function kelas()
    {
        $model = new KelasModel();
        $data['kelas'] = $model->findAll();
        return view('admin/akademik/kelas', $data);
    }

    public function simpan_kelas()
    {
        $model = new KelasModel();
        $data = ['nama_kelas' => $this->request->getPost('nama_kelas')];
        $model->insert($data);
        return redirect()->to(base_url('admin/akademik/kelas'))->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function update_kelas($id)
    {
        $model = new KelasModel();
        $data = ['nama_kelas' => $this->request->getPost('nama_kelas')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/akademik/kelas'))->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function hapus_kelas($id)
    {
        $model = new KelasModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/kelas'))->with('success', 'Data Kelas berhasil dihapus.');
    }

    public function siswa()
    {
        $kelasModel = new KelasModel();
        $db = \Config\Database::connect();
        
        $builder = $db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas, users.username');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $builder->join('users', 'users.id_relasi = siswa.id_siswa AND users.role = "siswa"', 'left');
        
        $data['siswa'] = $builder->get()->getResultArray();
        $data['kelas'] = $kelasModel->findAll();
        
        return view('admin/akademik/siswa', $data);
    }

    public function simpan_siswa()
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $id_kelas = $this->request->getPost('id_kelas');
        $id_kelas = empty($id_kelas) ? null : $id_kelas;

        $data = [
            'id_kelas' => $id_kelas,
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nis' => $this->request->getPost('nis'),
            'nisn' => $this->request->getPost('nisn'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_pendaftaran' => $this->request->getPost('jenis_pendaftaran'),
            'asal_sd' => $this->request->getPost('asal_sd'),
            'no_ijazah_sd' => $this->request->getPost('no_ijazah_sd'),
            'tahun_ijazah_sd' => $this->request->getPost('tahun_ijazah_sd'),
            'no_shun_sd' => $this->request->getPost('no_shun_sd'),
            'tahun_shun_sd' => $this->request->getPost('tahun_shun_sd'),
            'asal_smp_sebelumnya' => $this->request->getPost('asal_smp_sebelumnya'),
            'no_ijazah_smp' => $this->request->getPost('no_ijazah_smp'),
            'tahun_ijazah_smp' => $this->request->getPost('tahun_ijazah_smp'),
            'no_shun_smp' => $this->request->getPost('no_shun_smp'),
            'tahun_shun_smp' => $this->request->getPost('tahun_shun_smp'),
            'nama_orang_tua' => $this->request->getPost('nama_orang_tua'),
            'pekerjaan_orang_tua' => $this->request->getPost('pekerjaan_orang_tua'),
            'penghasilan_orang_tua' => $this->request->getPost('penghasilan_orang_tua')
        ];
        
        $model->insert($data);
        $id_siswa = $model->getInsertID();

        $userData = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'siswa',
            'id_relasi' => $id_siswa
        ];
        $userModel->insert($userData);

        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa & Akun Login berhasil ditambahkan.');
    }

    public function update_siswa($id)
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $id_kelas = $this->request->getPost('id_kelas');
        $id_kelas = empty($id_kelas) ? null : $id_kelas;

        $data = [
            'id_kelas' => $id_kelas,
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nis' => $this->request->getPost('nis'),
            'nisn' => $this->request->getPost('nisn'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_pendaftaran' => $this->request->getPost('jenis_pendaftaran'),
            'asal_sd' => $this->request->getPost('asal_sd'),
            'no_ijazah_sd' => $this->request->getPost('no_ijazah_sd'),
            'tahun_ijazah_sd' => $this->request->getPost('tahun_ijazah_sd'),
            'no_shun_sd' => $this->request->getPost('no_shun_sd'),
            'tahun_shun_sd' => $this->request->getPost('tahun_shun_sd'),
            'asal_smp_sebelumnya' => $this->request->getPost('asal_smp_sebelumnya'),
            'no_ijazah_smp' => $this->request->getPost('no_ijazah_smp'),
            'tahun_ijazah_smp' => $this->request->getPost('tahun_ijazah_smp'),
            'no_shun_smp' => $this->request->getPost('no_shun_smp'),
            'tahun_shun_smp' => $this->request->getPost('tahun_shun_smp'),
            'nama_orang_tua' => $this->request->getPost('nama_orang_tua'),
            'pekerjaan_orang_tua' => $this->request->getPost('pekerjaan_orang_tua'),
            'penghasilan_orang_tua' => $this->request->getPost('penghasilan_orang_tua')
        ];
        
        $model->update($id, $data);

        $user = $userModel->where('id_relasi', $id)->where('role', 'siswa')->first();
        $userData = ['username' => $this->request->getPost('username')];
        $password = $this->request->getPost('password');
        
        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($user) {
            $userModel->update($user['id_user'], $userData);
        } else {
            $userData['role'] = 'siswa';
            $userData['id_relasi'] = $id;
            if (empty($userData['password'])) {
                $userData['password'] = password_hash('siswa123', PASSWORD_DEFAULT);
            }
            $userModel->insert($userData);
        }

        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa & Akun Login berhasil diperbarui.');
    }

    public function hapus_siswa($id)
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $userModel->where('id_relasi', $id)->where('role', 'siswa')->delete();
        $model->delete($id);
        
        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa dan Akun Login berhasil dihapus.');
    }

    public function import_siswa()
    {
        $file = $this->request->getFile('file_excel');
        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Import Data Siswa berhasil dilakukan.');
    }

    public function naik_kelas()
    {
        $id_siswa_array = $this->request->getPost('id_siswa');
        $id_kelas_tujuan = $this->request->getPost('id_kelas_tujuan');

        if (!empty($id_siswa_array) && !empty($id_kelas_tujuan)) {
            $db = \Config\Database::connect();
            $builder = $db->table('siswa');
            $builder->whereIn('id_siswa', $id_siswa_array);
            $builder->update(['id_kelas' => $id_kelas_tujuan]);

            $jumlah = count($id_siswa_array);
            return redirect()->to(base_url('admin/akademik/siswa'))->with('success', "$jumlah Siswa berhasil dipindahkan ke kelas baru.");
        }

        return redirect()->to(base_url('admin/akademik/siswa'))->with('error', 'Gagal memproses. Pilih siswa dan kelas tujuan terlebih dahulu.');
    }

    public function guru()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('guru_tendik');
        $builder->select('guru_tendik.*, users.username, users.role as role_user');
        $builder->join('users', 'users.id_relasi = guru_tendik.id_guru AND users.role IN ("guru", "walikelas", "admin")', 'left');
        
        $data['guru'] = $builder->get()->getResultArray();
        return view('admin/akademik/guru', $data);
    }

    public function simpan_guru()
    {
        $model = new GuruModel();
        $userModel = new UserModel();
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'status_pegawai' => $this->request->getPost('status_pegawai'),
            'nip' => $this->request->getPost('nip'),
            'nikki' => $this->request->getPost('nikki'),
            'nuptk' => $this->request->getPost('nuptk'),
            'no_kk' => $this->request->getPost('no_kk'),
            'nik' => $this->request->getPost('nik'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'no_hp' => $this->request->getPost('no_hp'),
            'no_sk_pengangkatan' => $this->request->getPost('no_sk_pengangkatan'),
            'tgl_sk_pengangkatan' => $this->request->getPost('tgl_sk_pengangkatan'),
            'tahun_sk_pengangkatan' => $this->request->getPost('tahun_sk_pengangkatan'),
            'no_npwp' => $this->request->getPost('no_npwp')
        ];
        
        $model->insert($data);
        $id_guru = $model->getInsertID();

        $userData = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role_user'),
            'id_relasi' => $id_guru
        ];
        $userModel->insert($userData);

        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru/Tendik & Akun Login berhasil ditambahkan.');
    }

    public function update_guru($id)
    {
        $model = new GuruModel();
        $userModel = new UserModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'status_pegawai' => $this->request->getPost('status_pegawai'),
            'nip' => $this->request->getPost('nip'),
            'nikki' => $this->request->getPost('nikki'),
            'nuptk' => $this->request->getPost('nuptk'),
            'no_kk' => $this->request->getPost('no_kk'),
            'nik' => $this->request->getPost('nik'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'no_hp' => $this->request->getPost('no_hp'),
            'no_sk_pengangkatan' => $this->request->getPost('no_sk_pengangkatan'),
            'tgl_sk_pengangkatan' => $this->request->getPost('tgl_sk_pengangkatan'),
            'tahun_sk_pengangkatan' => $this->request->getPost('tahun_sk_pengangkatan'),
            'no_npwp' => $this->request->getPost('no_npwp')
        ];
        
        $model->update($id, $data);

        $user = $userModel->where('id_relasi', $id)->whereIn('role', ['guru', 'walikelas', 'admin'])->first();
        
        $userData = [
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role_user')
        ];
        
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($user) {
            $userModel->update($user['id_user'], $userData);
        } else {
            $userData['id_relasi'] = $id;
            if (empty($userData['password'])) {
                $userData['password'] = password_hash('guru123', PASSWORD_DEFAULT);
            }
            $userModel->insert($userData);
        }

        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru/Tendik & Akun Login berhasil diperbarui.');
    }

    public function hapus_guru($id)
    {
        $model = new GuruModel();
        $userModel = new UserModel();
        
        $userModel->where('id_relasi', $id)->whereIn('role', ['guru', 'walikelas', 'admin'])->delete();
        $model->delete($id);
        
        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru/Tendik & Akun Login berhasil dihapus.');
    }

    public function import_guru()
    {
        $file = $this->request->getFile('file_excel');
        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Import Data Guru berhasil dilakukan.');
    }

    public function mapel()
    {
        $model = new MapelModel();
        $data['mapel'] = $model->findAll();
        return view('admin/akademik/mapel', $data);
    }

    public function simpan_mapel()
    {
        $model = new MapelModel();
        $data = ['nama_mapel' => $this->request->getPost('nama_mapel')];
        $model->insert($data);
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mata Pelajaran berhasil ditambahkan.');
    }

    public function update_mapel($id)
    {
        $model = new MapelModel();
        $data = ['nama_mapel' => $this->request->getPost('nama_mapel')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mata Pelajaran berhasil diperbarui.');
    }

    public function hapus_mapel($id)
    {
        $model = new MapelModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mata Pelajaran berhasil dihapus.');
    }

    public function jadwal()
    {
        $model = new JadwalModel();
        $kelasModel = new KelasModel();
        $mapelModel = new MapelModel();
        $guruModel = new GuruModel();
        $data['jadwal'] = $model->findAll();
        $data['kelas'] = $kelasModel->findAll();
        $data['mapel'] = $mapelModel->findAll();
        $data['guru'] = $guruModel->findAll();
        return view('admin/akademik/jadwal', $data);
    }

    public function simpan_jadwal()
    {
        $model = new JadwalModel();
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'hari' => $this->request->getPost('hari'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'id_guru' => $this->request->getPost('id_guru'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai')
        ];
        $model->insert($data);
        return redirect()->to(base_url('admin/akademik/jadwal'))->with('success', 'Data Jadwal berhasil ditambahkan.');
    }

    public function update_jadwal($id)
    {
        $model = new JadwalModel();
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'hari' => $this->request->getPost('hari'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'id_guru' => $this->request->getPost('id_guru'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/akademik/jadwal'))->with('success', 'Data Jadwal berhasil diperbarui.');
    }

    public function hapus_jadwal($id)
    {
        $model = new JadwalModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/jadwal'))->with('success', 'Data Jadwal berhasil dihapus.');
    }

    public function pantau_rapor()
    {
        $model = new RaporModel();
        $data['rapor'] = $model->findAll();
        return view('admin/akademik/pantau_rapor', $data);
    }

    public function cetak_rapor()
    {
        $model = new RaporModel();
        $data['rapor'] = $model->findAll();
        return view('admin/akademik/cetak_rapor', $data);
    }
}