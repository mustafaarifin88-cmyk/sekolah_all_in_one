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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mapel berhasil ditambahkan.');
    }

    public function update_mapel($id)
    {
        $model = new MapelModel();
        $data = ['nama_mapel' => $this->request->getPost('nama_mapel')];
        $model->update($id, $data);
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mapel berhasil diperbarui.');
    }

    public function hapus_mapel($id)
    {
        $model = new MapelModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/mapel'))->with('success', 'Data Mapel berhasil dihapus.');
    }

    public function jadwal()
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('set_mapel_guru');
        $builder->select('set_mapel_guru.*, kelas.nama_kelas, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru');
        $builder->join('kelas', 'kelas.id_kelas = set_mapel_guru.id_kelas', 'left');
        $builder->join('mapel', 'mapel.id_mapel = set_mapel_guru.id_mapel', 'left');
        $builder->join('guru_tendik', 'guru_tendik.id_guru = set_mapel_guru.id_guru', 'left');
        $builder->orderBy('set_mapel_guru.jam_mulai', 'ASC');
        $raw_jadwal = $builder->get()->getResultArray();

        $jadwal_grouped = [
            'Senin' => [], 
            'Selasa' => [], 
            'Rabu' => [], 
            'Kamis' => [], 
            'Jumat' => [], 
            'Sabtu' => [], 
            'Minggu' => []
        ];

        foreach ($raw_jadwal as $j) {
            $hari = $j['hari'] ?? '';
            if (isset($jadwal_grouped[$hari])) {
                $jadwal_grouped[$hari][] = $j;
            } elseif ($hari != '') {
                $jadwal_grouped[$hari] = [$j];
            }
        }

        foreach ($jadwal_grouped as $h => $v) {
            if (empty($v)) unset($jadwal_grouped[$h]);
        }

        $data['jadwal_grouped'] = $jadwal_grouped;
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

    public function guru()
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('guru_tendik');
        $builder->select('guru_tendik.*, users.role as role_user, users.username');
        $builder->join('users', "users.id_relasi = guru_tendik.id_guru AND users.role != 'siswa'", 'left');
        
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
            'role' => 'guru',
            'foto' => 'default.png',
            'id_relasi' => $id_guru
        ];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil/', $newName);
            $userData['foto'] = $newName;
        }
        $userModel->insert($userData);

        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru berhasil ditambahkan.');
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

        // Cari user yang id_relasinya sesuai, tanpa membatasi hanya role 'guru'
        $user = $userModel->where('id_relasi', $id)->where('role !=', 'siswa')->first();
        if ($user) {
            $userData = ['username' => $this->request->getPost('username')];
            
            // Tangkap perubahan role jika form menyediakan input role
            $role_post = $this->request->getPost('role');
            if (!empty($role_post)) {
                $userData['role'] = $role_post;
            }

            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if ($user['foto'] && $user['foto'] !== 'default.png' && file_exists('uploads/profil/' . $user['foto'])) {
                    unlink('uploads/profil/' . $user['foto']);
                }
                $newName = $foto->getRandomName();
                $foto->move('uploads/profil/', $newName);
                $userData['foto'] = $newName;
            }
            $userModel->update($user['id_user'], $userData);
        }

        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru berhasil diperbarui.');
    }

    public function hapus_guru($id)
    {
        $model = new GuruModel();
        $userModel = new UserModel();
        
        // Sesuaikan juga pada fungsi hapus agar foto profil ikut terhapus
        $user = $userModel->where('id_relasi', $id)->where('role !=', 'siswa')->first();
        if ($user) {
            if ($user['foto'] && $user['foto'] !== 'default.png' && file_exists('uploads/profil/' . $user['foto'])) {
                unlink('uploads/profil/' . $user['foto']);
            }
            $userModel->delete($user['id_user']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru berhasil dihapus.');
    }

    public function import_guru()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($file->getTempName());
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                
                $model = new GuruModel();
                $userModel = new UserModel();

                foreach ($sheetData as $key => $row) {
                    if ($key == 0) continue;
                    if (empty($row[0])) continue;

                    $data = [
                        'nama_lengkap' => $row[0],
                        'jenis_kelamin' => $row[1] ?? 'Laki-Laki',
                        'status_pegawai' => $row[2] ?? 'Honor Murni',
                        'nip' => $row[3] ?? null,
                        'nik' => $row[4] ?? null,
                        'no_hp' => $row[5] ?? null
                    ];
                    $model->insert($data);
                    $id_guru = $model->getInsertID();

                    $userData = [
                        'username' => strtolower(str_replace(' ', '', $row[0])) . rand(10,99),
                        'password' => password_hash('123456', PASSWORD_DEFAULT),
                        'role' => 'guru',
                        'foto' => 'default.png',
                        'id_relasi' => $id_guru
                    ];
                    $userModel->insert($userData);
                }
                return redirect()->to(base_url('admin/akademik/guru'))->with('success', 'Data Guru berhasil diimport.');
            }
        }
        return redirect()->to(base_url('admin/akademik/guru'))->with('error', 'Gagal upload file.');
    }

    public function siswa()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $data['siswa'] = $builder->get()->getResultArray();
        
        $kelasModel = new KelasModel();
        $data['kelas'] = $kelasModel->findAll();
        
        return view('admin/akademik/siswa', $data);
    }

    public function simpan_siswa()
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
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
            'foto' => 'default.png',
            'id_relasi' => $id_siswa
        ];
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil/', $newName);
            $userData['foto'] = $newName;
        }
        $userModel->insert($userData);

        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function update_siswa($id)
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
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
        if ($user) {
            $userData = ['username' => $this->request->getPost('username')];
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if ($user['foto'] && $user['foto'] !== 'default.png' && file_exists('uploads/profil/' . $user['foto'])) {
                    unlink('uploads/profil/' . $user['foto']);
                }
                $newName = $foto->getRandomName();
                $foto->move('uploads/profil/', $newName);
                $userData['foto'] = $newName;
            }
            $userModel->update($user['id_user'], $userData);
        }

        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa berhasil diperbarui.');
    }

    public function hapus_siswa($id)
    {
        $model = new SiswaModel();
        $userModel = new UserModel();
        
        $user = $userModel->where('id_relasi', $id)->where('role', 'siswa')->first();
        if ($user) {
            if ($user['foto'] && $user['foto'] !== 'default.png' && file_exists('uploads/profil/' . $user['foto'])) {
                unlink('uploads/profil/' . $user['foto']);
            }
            $userModel->delete($user['id_user']);
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa berhasil dihapus.');
    }

    public function import_siswa()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($file->getTempName());
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                
                $model = new SiswaModel();
                $userModel = new UserModel();

                foreach ($sheetData as $key => $row) {
                    if ($key == 0) continue;
                    if (empty($row[0])) continue;

                    $data = [
                        'nama_siswa' => $row[0],
                        'nis' => $row[1] ?? null,
                        'nisn' => $row[2] ?? null,
                        'tempat_lahir' => $row[3] ?? null,
                        'tanggal_lahir' => $row[4] ?? null,
                        'jenis_pendaftaran' => 'Siswa Baru',
                        'id_kelas' => $this->request->getPost('id_kelas') ?? 0
                    ];
                    $model->insert($data);
                    $id_siswa = $model->getInsertID();

                    $userData = [
                        'username' => $row[1] ?? strtolower(str_replace(' ', '', $row[0])) . rand(10,99),
                        'password' => password_hash('123456', PASSWORD_DEFAULT),
                        'role' => 'siswa',
                        'foto' => 'default.png',
                        'id_relasi' => $id_siswa
                    ];
                    $userModel->insert($userData);
                }
                return redirect()->to(base_url('admin/akademik/siswa'))->with('success', 'Data Siswa berhasil diimport.');
            }
        }
        return redirect()->to(base_url('admin/akademik/siswa'))->with('error', 'Gagal upload file.');
    }

    public function pantau_rapor()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('nilai_rapor');
        $builder->select('nilai_rapor.*, siswa.nama_siswa, mapel.nama_mapel, kelas.nama_kelas, guru_tendik.nama_lengkap as nama_guru');
        $builder->join('siswa', 'siswa.id_siswa = nilai_rapor.id_siswa', 'left');
        $builder->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left');
        $builder->join('kelas', 'kelas.id_kelas = nilai_rapor.id_kelas', 'left');
        $builder->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left');
        
        $data['rapor'] = $builder->get()->getResultArray();
        return view('admin/akademik/pantau_rapor', $data);
    }

    public function cetak_rapor()
    {
        $db = \Config\Database::connect();
        $kelasModel = new \App\Models\KelasModel();
        $data['kelas_list'] = $kelasModel->findAll();

        $id_kelas = $this->request->getGet('id_kelas');
        
        if ($id_kelas) {
            $builder = $db->table('siswa');
            $builder->select('siswa.*, kelas.nama_kelas');
            $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
            $builder->where('siswa.id_kelas', $id_kelas);
            $data['siswa'] = $builder->get()->getResultArray();
        } else {
            $data['siswa'] = [];
        }
        
        $data['id_kelas_selected'] = $id_kelas;
        
        return view('admin/akademik/cetak_rapor', $data);
    }

    public function cetak_rapor_pdf($id_siswa)
    {
        $db = \Config\Database::connect();
        
        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        $siswa = $db->table('siswa')
                    ->select('siswa.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                    ->where('id_siswa', $id_siswa)
                    ->get()->getRowArray();
                    
        if (!$siswa) return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');

        $nilai = $db->table('nilai_rapor')
                    ->select('nilai_rapor.*, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru')
                    ->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left')
                    ->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left')
                    ->where('nilai_rapor.id_siswa', $id_siswa)
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->get()->getResultArray();

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        
        $html = view('admin/akademik/format_cetak_rapor', [
            'identitas' => $identitas,
            'siswa' => $siswa,
            'nilai' => $nilai
        ]);

        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Rapor_' . str_replace(' ', '_', $siswa['nama_siswa']) . '.pdf', 'I');
    }

    public function cetak_rapor_excel($id_siswa)
    {
        $db = \Config\Database::connect();
        
        $identitas = $db->table('identitas_sekolah')->get()->getRowArray();
        $siswa = $db->table('siswa')
                    ->select('siswa.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                    ->where('id_siswa', $id_siswa)
                    ->get()->getRowArray();
                    
        if (!$siswa) return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');

        $nilai = $db->table('nilai_rapor')
                    ->select('nilai_rapor.*, mapel.nama_mapel, guru_tendik.nama_lengkap as nama_guru')
                    ->join('mapel', 'mapel.id_mapel = nilai_rapor.id_mapel', 'left')
                    ->join('guru_tendik', 'guru_tendik.id_guru = nilai_rapor.id_guru', 'left')
                    ->where('nilai_rapor.id_siswa', $id_siswa)
                    ->orderBy('mapel.nama_mapel', 'ASC')
                    ->get()->getResultArray();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', strtoupper($identitas['nama_dinas'] ?? 'DINAS PENDIDIKAN'));
        $sheet->setCellValue('A2', strtoupper($identitas['nama_sekolah'] ?? 'NAMA SEKOLAH'));
        $sheet->setCellValue('A3', $identitas['alamat_sekolah'] ?? 'Alamat Sekolah');
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');
        $sheet->mergeCells('A3:F3');
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        
        $sheet->setCellValue('A5', 'Nama Siswa');
        $sheet->setCellValue('B5', ': ' . $siswa['nama_siswa']);
        $sheet->setCellValue('A6', 'NIS/NISN');
        $sheet->setCellValue('B6', ': ' . $siswa['nis'] . ' / ' . $siswa['nisn']);
        $sheet->setCellValue('E5', 'Kelas');
        $sheet->setCellValue('F5', ': ' . $siswa['nama_kelas']);
        $sheet->setCellValue('E6', 'Tahun Ajaran');
        $sheet->setCellValue('F6', ': ' . ($nilai[0]['tahun_ajaran'] ?? '-'));
        
        $sheet->setCellValue('A8', 'No');
        $sheet->setCellValue('B8', 'Mata Pelajaran');
        $sheet->setCellValue('C8', 'Semester');
        $sheet->setCellValue('D8', 'Nilai');
        $sheet->setCellValue('E8', 'Keterangan');
        $sheet->setCellValue('F8', 'Guru Pengampu');
        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
        $sheet->getStyle('A8:F8')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        $rowExcel = 9;
        $no = 1;
        foreach($nilai as $n) {
            $sheet->setCellValue('A'.$rowExcel, $no++);
            $sheet->setCellValue('B'.$rowExcel, $n['nama_mapel']);
            $sheet->setCellValue('C'.$rowExcel, $n['semester']);
            $sheet->setCellValue('D'.$rowExcel, $n['nilai']);
            $keterangan = $n['nilai'] >= 75 ? 'Tuntas' : 'Belum Tuntas';
            $sheet->setCellValue('E'.$rowExcel, $keterangan);
            $sheet->setCellValue('F'.$rowExcel, $n['nama_guru']);
            $sheet->getStyle('A'.$rowExcel.':F'.$rowExcel)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $rowExcel++;
        }
        
        $rowExcel += 2;
        $sheet->setCellValue('F'.$rowExcel, 'Kepala Sekolah,');
        $rowExcel += 4;
        $sheet->setCellValue('F'.$rowExcel, $identitas['nama_kepsek'] ?? '.......................');
        $sheet->setCellValue('F'.($rowExcel+1), 'NIP. ' . ($identitas['nip_kepsek'] ?? '-'));
        
        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Rapor_' . str_replace(' ', '_', $siswa['nama_siswa']) . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit();
    }
}