<?php 
$request = \Config\Services::request();
$uri = $request->getUri();
$seg1 = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
$seg2 = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';
$seg3 = $uri->getTotalSegments() >= 3 ? $uri->getSegment(3) : '';
$role = session()->get('role');

$identitasModel = new \App\Models\IdentitasSekolahModel();
$identitas = $identitasModel->first();
$logoSidebar = ($identitas && !empty($identitas['logo_sekolah'])) ? base_url('uploads/identitas/' . $identitas['logo_sekolah']) : base_url('assets/dist/img/AdminLTELogo.png');
$namaSidebar = ($identitas && !empty($identitas['nama_sekolah'])) ? $identitas['nama_sekolah'] : 'SIS PANEL';

// Logic untuk mengambil nama asli user
$namaUser = session()->get('username');
if ($role == 'guru' || $role == 'walikelas') {
    $guruDb = \Config\Database::connect()->table('guru_tendik')->where('id_guru', session()->get('id_relasi'))->get()->getRow();
    if($guruDb) $namaUser = $guruDb->gelar_depan . ' ' . $guruDb->nama_lengkap . ' ' . $guruDb->gelar_belakang;
} elseif ($role == 'siswa') {
    $siswaDb = \Config\Database::connect()->table('siswa')->where('id_siswa', session()->get('id_relasi'))->get()->getRow();
    if($siswaDb) $namaUser = $siswaDb->nama_siswa;
}
?>

<style>
    .sidebar-futuristic {
        background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%) !important;
        box-shadow: 4px 0 20px rgba(0,0,0,0.2) !important;
        border-right: 1px solid rgba(255,255,255,0.05);
    }
    .brand-glass {
        background: rgba(255, 255, 255, 0.05) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        padding: 1.2rem 1rem !important;
        transition: all 0.3s ease;
    }
    .brand-glass:hover {
        background: rgba(255, 255, 255, 0.1) !important;
    }
    .nav-futuristic .nav-item {
        margin-bottom: 4px;
    }
    .nav-futuristic .nav-link {
        border-radius: 12px;
        margin: 0 12px;
        padding: 10px 15px;
        color: #94a3b8 !important;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .nav-futuristic .nav-link i.nav-icon {
        color: #64748b;
        transition: all 0.3s ease;
    }
    .nav-futuristic .nav-link:hover {
        background: rgba(255,255,255,0.05);
        color: #f8fafc !important;
        transform: translateX(5px);
    }
    .nav-futuristic .nav-link:hover i.nav-icon {
        color: #818cf8;
        transform: scale(1.1);
    }
    .nav-futuristic .nav-link.active {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }
    .nav-futuristic .nav-link.active i.nav-icon {
        color: #ffffff !important;
    }
    .nav-header-custom {
        color: #475569 !important;
        font-size: 0.75rem !important;
        font-weight: 800 !important;
        letter-spacing: 1.5px;
        padding: 1.5rem 1.5rem 0.5rem 1.5rem !important;
        text-transform: uppercase;
    }
    .user-panel-glass {
        background: rgba(255,255,255,0.03);
        border-radius: 16px;
        margin: 15px;
        padding: 15px !important;
        border: 1px solid rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
    }
    .nav-treeview .nav-link {
        padding-left: 45px !important;
        font-size: 0.9rem;
    }
    .nav-treeview .nav-link::before {
        content: '';
        position: absolute;
        left: 24px;
        top: 50%;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #475569;
        transform: translateY(-50%);
        transition: all 0.3s;
    }
    .nav-treeview .nav-link:hover::before,
    .nav-treeview .nav-link.active::before {
        background: #ffffff;
        box-shadow: 0 0 10px #ffffff;
    }
    .nav-treeview .nav-link i.nav-icon {
        display: none;
    }
    ::-webkit-scrollbar-sidebar {
        width: 5px;
    }
</style>

<aside class="main-sidebar sidebar-futuristic elevation-4">
    <a href="<?= base_url($role . '/dashboard') ?>" class="brand-link brand-glass d-flex align-items-center">
        <img src="<?= $logoSidebar ?>" alt="Logo" class="brand-image img-circle elevation-2 bg-white" style="opacity: .9; padding: 2px;">
        <span class="brand-text fw-bold text-white tracking-wider ms-2 text-truncate" style="font-size: 1.1rem;"><?= strtoupper($namaSidebar) ?></span>
    </a>

    <div class="sidebar pb-4">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center user-panel-glass">
            <div class="image">
                <img src="<?= base_url('uploads/profil/' . (session()->get('foto') ?? 'default.png')) ?>" class="img-circle elevation-2 bg-white" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
            </div>
            <div class="info ms-2 w-100 text-truncate">
                <a href="<?= base_url($role . '/profil') ?>" class="d-block text-white fw-bold fs-6 mb-0" title="<?= $namaUser ?>"><?= $namaUser ?></a>
                <span class="badge bg-indigo rounded-pill text-xs fw-semibold px-2 mt-1" style="background: rgba(99, 102, 241, 0.2) !important; color: #a5b4fc !important; border: 1px solid rgba(99, 102, 241, 0.3);"><?= strtoupper($role) ?></span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-futuristic" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?= base_url($role . '/dashboard') ?>" class="nav-link <?= ($seg2 == 'dashboard' || $seg2 == '') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Dashboard Overview</p>
                    </a>
                </li>

                <?php if($role === 'admin'): ?>
                <li class="nav-header nav-header-custom">Main Menu Admin</li>
                
                <li class="nav-item <?= ($seg2 == 'aplikasi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'aplikasi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>Pengaturan Aplikasi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/identitas') ?>" class="nav-link <?= ($seg3 == 'identitas') ? 'active' : '' ?>"><p>Identitas Sekolah</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/kepsek') ?>" class="nav-link <?= ($seg3 == 'kepsek') ? 'active' : '' ?>"><p>Data Kepala Sekolah</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/menu') ?>" class="nav-link <?= ($seg3 == 'menu') ? 'active' : '' ?>"><p>Menu Eksternal</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/tema') ?>" class="nav-link <?= ($seg3 == 'tema') ? 'active' : '' ?>"><p>Tema Website</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/visimisi') ?>" class="nav-link <?= ($seg3 == 'visimisi') ? 'active' : '' ?>"><p>Visi & Misi</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/set_mapel') ?>" class="nav-link <?= ($seg3 == 'set_mapel') ? 'active' : '' ?>"><p>Tugas & Jadwal Guru</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/set_kelas') ?>" class="nav-link <?= ($seg3 == 'set_kelas') ? 'active' : '' ?>"><p>Tugas Wali Kelas</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/aplikasi/slider') ?>" class="nav-link <?= ($seg3 == 'slider') ? 'active' : '' ?>"><p>Slide Show (Banner)</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'informasi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'informasi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pusat Informasi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/informasi/kategori_berita') ?>" class="nav-link <?= ($seg3 == 'kategori_berita') ? 'active' : '' ?>"><p>Kategori Berita</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/informasi/berita') ?>" class="nav-link <?= ($seg3 == 'berita') ? 'active' : '' ?>"><p>Manajemen Berita</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/informasi/kategori_pengumuman') ?>" class="nav-link <?= ($seg3 == 'kategori_pengumuman') ? 'active' : '' ?>"><p>Kategori Pengumuman</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/informasi/pengumuman') ?>" class="nav-link <?= ($seg3 == 'pengumuman') ? 'active' : '' ?>"><p>Data Pengumuman</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'akademik') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'akademik') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Akademik Utama <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/kurikulum') ?>" class="nav-link <?= ($seg3 == 'kurikulum') ? 'active' : '' ?>"><p>Data Kurikulum</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/kelas') ?>" class="nav-link <?= ($seg3 == 'kelas') ? 'active' : '' ?>"><p>Data Kelas</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/siswa') ?>" class="nav-link <?= ($seg3 == 'siswa') ? 'active' : '' ?>"><p>Data Siswa</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/guru') ?>" class="nav-link <?= ($seg3 == 'guru') ? 'active' : '' ?>"><p>Data Guru & Tendik</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/mapel') ?>" class="nav-link <?= ($seg3 == 'mapel') ? 'active' : '' ?>"><p>Mata Pelajaran</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/jadwal') ?>" class="nav-link <?= ($seg3 == 'jadwal') ? 'active' : '' ?>"><p>Jadwal Pelajaran</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/pantau_rapor') ?>" class="nav-link <?= ($seg3 == 'pantau_rapor') ? 'active' : '' ?>"><p>Pantau Nilai Rapor</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/akademik/cetak_rapor') ?>" class="nav-link <?= ($seg3 == 'cetak_rapor') ? 'active' : '' ?>"><p>Cetak Rapor Digital</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'kesiswaan') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'kesiswaan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kesiswaan & BK <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/kesiswaan/eskul') ?>" class="nav-link <?= ($seg3 == 'eskul') ? 'active' : '' ?>"><p>Ekstrakurikuler</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kesiswaan/prestasi') ?>" class="nav-link <?= ($seg3 == 'prestasi') ? 'active' : '' ?>"><p>Prestasi Siswa</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kesiswaan/disiplin') ?>" class="nav-link <?= ($seg3 == 'disiplin') ? 'active' : '' ?>"><p>Data Kedisiplinan</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kesiswaan/organisasi') ?>" class="nav-link <?= ($seg3 == 'organisasi') ? 'active' : '' ?>"><p>Organisasi Siswa</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kesiswaan/bk') ?>" class="nav-link <?= ($seg3 == 'bk') ? 'active' : '' ?>"><p>Bimbingan Konseling</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'kepegawaian') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'kepegawaian') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>Kepegawaian <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/kepegawaian/riwayat_pendidikan') ?>" class="nav-link <?= ($seg3 == 'riwayat_pendidikan') ? 'active' : '' ?>"><p>Riwayat Pendidikan</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kepegawaian/riwayat_pangkat') ?>" class="nav-link <?= ($seg3 == 'riwayat_pangkat') ? 'active' : '' ?>"><p>Riwayat Kepangkatan</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kepegawaian/sertifikasi') ?>" class="nav-link <?= ($seg3 == 'sertifikasi') ? 'active' : '' ?>"><p>Data Sertifikasi</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kepegawaian/beban_kerja') ?>" class="nav-link <?= ($seg3 == 'beban_kerja') ? 'active' : '' ?>"><p>Beban Kerja Guru</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'keuangan') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'keuangan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Kelola Keuangan <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/keuangan/bos') ?>" class="nav-link <?= ($seg3 == 'bos') ? 'active' : '' ?>"><p>Dana BOS Masuk</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/keuangan/pengeluaran') ?>" class="nav-link <?= ($seg3 == 'pengeluaran') ? 'active' : '' ?>"><p>Data Pengeluaran</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/keuangan/laporan') ?>" class="nav-link <?= ($seg3 == 'laporan') ? 'active' : '' ?>"><p>Laporan Keuangan</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'sarpras') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'sarpras') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Sarana Prasarana <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/sarpras/ruang') ?>" class="nav-link <?= ($seg3 == 'ruang') ? 'active' : '' ?>"><p>Master Ruang</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/sarpras/kondisi') ?>" class="nav-link <?= ($seg3 == 'kondisi') ? 'active' : '' ?>"><p>Master Kondisi</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/sarpras/barang') ?>" class="nav-link <?= ($seg3 == 'barang') ? 'active' : '' ?>"><p>Data Inventaris</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/sarpras/kerusakan') ?>" class="nav-link <?= ($seg3 == 'kerusakan') ? 'active' : '' ?>"><p>Status Kerusakan</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'administrasi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'administrasi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Persuratan & Arsip <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/administrasi/kode_surat') ?>" class="nav-link <?= ($seg3 == 'kode_surat') ? 'active' : '' ?>"><p>Kode Surat</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/administrasi/sifat_surat') ?>" class="nav-link <?= ($seg3 == 'sifat_surat') ? 'active' : '' ?>"><p>Sifat Surat</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/administrasi/surat_masuk') ?>" class="nav-link <?= ($seg3 == 'surat_masuk') ? 'active' : '' ?>"><p>Surat Masuk</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/administrasi/surat_keluar') ?>" class="nav-link <?= ($seg3 == 'surat_keluar') ? 'active' : '' ?>"><p>Surat Keluar</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'kelulusan') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'kelulusan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Info Kelulusan <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('admin/kelulusan/setting') ?>" class="nav-link <?= ($seg3 == 'setting') ? 'active' : '' ?>"><p>Pengaturan Sistem</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('admin/kelulusan/data') ?>" class="nav-link <?= ($seg3 == 'data') ? 'active' : '' ?>"><p>Data Status Kelulusan</p></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($role === 'guru'): ?>
                <li class="nav-header nav-header-custom">PANEL GURU</li>
                
                <li class="nav-item <?= ($seg2 == 'informasi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'informasi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pusat Informasi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('guru/informasi/berita') ?>" class="nav-link <?= ($seg3 == 'berita') ? 'active' : '' ?>"><p>Manajemen Berita</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('guru/informasi/pengumuman') ?>" class="nav-link <?= ($seg3 == 'pengumuman') ? 'active' : '' ?>"><p>Pengumuman</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'akademik') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'akademik') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>Data Akademik <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('guru/akademik/jadwal') ?>" class="nav-link <?= ($seg3 == 'jadwal') ? 'active' : '' ?>"><p>Jadwal Mengajar</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('guru/akademik/data_kelas') ?>" class="nav-link <?= ($seg3 == 'data_kelas' || $seg3 == 'data_siswa') ? 'active' : '' ?>"><p>Daftar Kelas & Siswa</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('guru/akademik/input_nilai') ?>" class="nav-link <?= ($seg3 == 'input_nilai') ? 'active' : '' ?>"><p>Input Nilai Rapor</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'kepegawaian') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'kepegawaian') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>Kepegawaian (Pribadi) <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('guru/kepegawaian/riwayat') ?>" class="nav-link <?= ($seg3 == 'riwayat') ? 'active' : '' ?>"><p>Riwayat Pendidikan</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('guru/kepegawaian/sertifikasi') ?>" class="nav-link <?= ($seg3 == 'sertifikasi') ? 'active' : '' ?>"><p>Sertifikasi</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('guru/kepegawaian/beban_kerja') ?>" class="nav-link <?= ($seg3 == 'beban_kerja') ? 'active' : '' ?>"><p>Beban Kerja</p></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($role === 'walikelas'): ?>
                <li class="nav-header nav-header-custom">PANEL WALI KELAS</li>
                
                <li class="nav-item <?= ($seg2 == 'informasi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'informasi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pusat Informasi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('walikelas/informasi/berita') ?>" class="nav-link <?= ($seg3 == 'berita') ? 'active' : '' ?>"><p>Berita Sekolah</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/informasi/pengumuman') ?>" class="nav-link <?= ($seg3 == 'pengumuman') ? 'active' : '' ?>"><p>Pengumuman</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'akademik') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'akademik') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-school"></i>
                        <p>Kelola Kelas <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/data_kelas') ?>" class="nav-link <?= ($seg3 == 'data_kelas') ? 'active' : '' ?>"><p>Informasi Kelas</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/data_siswa') ?>" class="nav-link <?= ($seg3 == 'data_siswa') ? 'active' : '' ?>"><p>Daftar Siswa Kelas</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/jadwal') ?>" class="nav-link <?= ($seg3 == 'jadwal') ? 'active' : '' ?>"><p>Jadwal Pelajaran</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/input_nilai') ?>" class="nav-link <?= ($seg3 == 'input_nilai') ? 'active' : '' ?>"><p>Input Nilai Mapel</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/pantau_nilai') ?>" class="nav-link <?= ($seg3 == 'pantau_nilai') ? 'active' : '' ?>"><p>Pantau Nilai Guru Lain</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/akademik/cetak_rapor') ?>" class="nav-link <?= ($seg3 == 'cetak_rapor') ? 'active' : '' ?>"><p>Cetak Rapor Kelas</p></a></li>
                    </ul>
                </li>

                <li class="nav-item <?= ($seg2 == 'kepegawaian') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($seg2 == 'kepegawaian') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p>Kepegawaian Pribadi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="<?= base_url('walikelas/kepegawaian/riwayat') ?>" class="nav-link <?= ($seg3 == 'riwayat') ? 'active' : '' ?>"><p>Riwayat Pendidikan</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/kepegawaian/sertifikasi') ?>" class="nav-link <?= ($seg3 == 'sertifikasi') ? 'active' : '' ?>"><p>Sertifikasi</p></a></li>
                        <li class="nav-item"><a href="<?= base_url('walikelas/kepegawaian/beban_kerja') ?>" class="nav-link <?= ($seg3 == 'beban_kerja') ? 'active' : '' ?>"><p>Beban Kerja</p></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($role === 'siswa'): ?>
                <li class="nav-header nav-header-custom">LAYANAN SISWA</li>
                
                <li class="nav-item">
                    <a href="<?= base_url('siswa/rapor/cetak_rapor') ?>" class="nav-link <?= ($seg2 == 'rapor') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Rapor Digital Saya</p>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>