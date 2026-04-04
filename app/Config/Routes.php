<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Frontend::index');
$routes->get('berita', 'Frontend::berita');
$routes->get('berita/detail/(:num)', 'Frontend::detail_berita/$1');
$routes->get('pengumuman', 'Frontend::pengumuman');
$routes->post('cek_kelulusan', 'Frontend::cek_kelulusan');

$routes->group('akademik', static function ($routes) {
    $routes->get('kurikulum', 'Frontend::kurikulum');
    $routes->get('kelas', 'Frontend::kelas');
    $routes->get('siswa', 'Frontend::siswa');
    $routes->get('guru', 'Frontend::guru');
    $routes->get('visimisi', 'Frontend::visimisi');
    $routes->get('prestasi', 'Frontend::prestasi');
});

$routes->group('sarpras', static function ($routes) {
    $routes->get('fasilitas', 'Frontend::fasilitas');
});

$routes->group('transparansi', static function ($routes) {
    $routes->get('bos', 'Frontend::bos');
    $routes->get('pengeluaran', 'Frontend::pengeluaran');
});

$routes->group('arsip', static function ($routes) {
    $routes->get('dokumen', 'Frontend::dokumen');
});

$routes->get('login', 'Auth::index');
$routes->post('login/proses', 'Auth::proses');
$routes->get('logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    $routes->group('aplikasi', static function ($routes) {
        $routes->get('profil', 'Admin\Aplikasi::profil');
        $routes->post('update_profil', 'Admin\Aplikasi::update_profil');
        $routes->get('identitas', 'Admin\Aplikasi::identitas');
        $routes->post('simpan_identitas', 'Admin\Aplikasi::simpan_identitas');
        $routes->get('kepsek', 'Admin\Aplikasi::kepsek');
        $routes->post('simpan_kepsek', 'Admin\Aplikasi::simpan_kepsek');
        $routes->get('visimisi', 'Admin\Aplikasi::visimisi');
        $routes->post('update_visimisi', 'Admin\Aplikasi::update_visimisi');
        $routes->get('menu', 'Admin\Aplikasi::menu');
        $routes->post('simpan_menu', 'Admin\Aplikasi::simpan_menu');
        $routes->post('update_menu/(:num)', 'Admin\Aplikasi::update_menu/$1');
        $routes->get('hapus_menu/(:num)', 'Admin\Aplikasi::hapus_menu/$1');
        $routes->get('tema', 'Admin\Aplikasi::tema');
        $routes->post('update_tema', 'Admin\Aplikasi::update_tema');
        $routes->get('slider', 'Admin\Aplikasi::slider');
        $routes->post('simpan_slider', 'Admin\Aplikasi::simpan_slider');
        $routes->post('update_slider/(:num)', 'Admin\Aplikasi::update_slider/$1');
        $routes->get('hapus_slider/(:num)', 'Admin\Aplikasi::hapus_slider/$1');
        $routes->get('set_mapel', 'Admin\Aplikasi::set_mapel');
        $routes->post('simpan_set_mapel', 'Admin\Aplikasi::simpan_set_mapel');
        $routes->get('hapus_set_mapel/(:num)', 'Admin\Aplikasi::hapus_set_mapel/$1');
        $routes->get('set_kelas', 'Admin\Aplikasi::set_kelas');
        $routes->post('simpan_set_kelas', 'Admin\Aplikasi::simpan_set_kelas');
        $routes->get('hapus_set_kelas/(:num)', 'Admin\Aplikasi::hapus_set_kelas/$1');
    });

    $routes->group('akademik', static function ($routes) {
        $routes->get('kurikulum', 'Admin\Akademik::kurikulum');
        $routes->post('simpan_kurikulum', 'Admin\Akademik::simpan_kurikulum');
        $routes->post('update_kurikulum/(:num)', 'Admin\Akademik::update_kurikulum/$1');
        $routes->get('hapus_kurikulum/(:num)', 'Admin\Akademik::hapus_kurikulum/$1');
        $routes->get('kelas', 'Admin\Akademik::kelas');
        $routes->post('simpan_kelas', 'Admin\Akademik::simpan_kelas');
        $routes->post('update_kelas/(:num)', 'Admin\Akademik::update_kelas/$1');
        $routes->get('hapus_kelas/(:num)', 'Admin\Akademik::hapus_kelas/$1');
        $routes->get('mapel', 'Admin\Akademik::mapel');
        $routes->post('simpan_mapel', 'Admin\Akademik::simpan_mapel');
        $routes->post('update_mapel/(:num)', 'Admin\Akademik::update_mapel/$1');
        $routes->get('hapus_mapel/(:num)', 'Admin\Akademik::hapus_mapel/$1');
        $routes->get('jadwal', 'Admin\Akademik::jadwal');
        $routes->post('simpan_jadwal', 'Admin\Akademik::simpan_jadwal');
        $routes->post('update_jadwal/(:num)', 'Admin\Akademik::update_jadwal/$1');
        $routes->get('hapus_jadwal/(:num)', 'Admin\Akademik::hapus_jadwal/$1');
        $routes->get('guru', 'Admin\Akademik::guru');
        $routes->post('simpan_guru', 'Admin\Akademik::simpan_guru');
        $routes->post('update_guru/(:num)', 'Admin\Akademik::update_guru/$1');
        $routes->get('hapus_guru/(:num)', 'Admin\Akademik::hapus_guru/$1');
        $routes->post('import_guru', 'Admin\Akademik::import_guru');
        $routes->get('siswa', 'Admin\Akademik::siswa');
        $routes->post('simpan_siswa', 'Admin\Akademik::simpan_siswa');
        $routes->post('update_siswa/(:num)', 'Admin\Akademik::update_siswa/$1');
        $routes->get('hapus_siswa/(:num)', 'Admin\Akademik::hapus_siswa/$1');
        $routes->post('import_siswa', 'Admin\Akademik::import_siswa');
        $routes->get('pantau_rapor', 'Admin\Akademik::pantau_rapor');
        $routes->get('cetak_rapor', 'Admin\Akademik::cetak_rapor');
        $routes->get('cetak_rapor_pdf/(:num)', 'Admin\Akademik::cetak_rapor_pdf/$1');
        $routes->get('cetak_rapor_excel/(:num)', 'Admin\Akademik::cetak_rapor_excel/$1');
    });

    $routes->group('informasi', static function ($routes) {
        $routes->get('kategori_berita', 'Admin\Informasi::kategori_berita');
        $routes->post('simpan_kategori_berita', 'Admin\Informasi::simpan_kategori_berita');
        $routes->post('update_kategori_berita/(:num)', 'Admin\Informasi::update_kategori_berita/$1');
        $routes->get('hapus_kategori_berita/(:num)', 'Admin\Informasi::hapus_kategori_berita/$1');
        $routes->get('berita', 'Admin\Informasi::berita');
        $routes->post('simpan_berita', 'Admin\Informasi::simpan_berita');
        $routes->post('update_berita/(:num)', 'Admin\Informasi::update_berita/$1');
        $routes->get('hapus_berita/(:num)', 'Admin\Informasi::hapus_berita/$1');
        $routes->get('kategori_pengumuman', 'Admin\Informasi::kategori_pengumuman');
        $routes->post('simpan_kategori_pengumuman', 'Admin\Informasi::simpan_kategori_pengumuman');
        $routes->post('update_kategori_pengumuman/(:num)', 'Admin\Informasi::update_kategori_pengumuman/$1');
        $routes->get('hapus_kategori_pengumuman/(:num)', 'Admin\Informasi::hapus_kategori_pengumuman/$1');
        $routes->get('pengumuman', 'Admin\Informasi::pengumuman');
        $routes->post('simpan_pengumuman', 'Admin\Informasi::simpan_pengumuman');
        $routes->post('update_pengumuman/(:num)', 'Admin\Informasi::update_pengumuman/$1');
        $routes->get('hapus_pengumuman/(:num)', 'Admin\Informasi::hapus_pengumuman/$1');
    });

    $routes->group('kelulusan', static function ($routes) {
        $routes->get('setting', 'Admin\Kelulusan::setting');
        $routes->post('simpan_setting', 'Admin\Kelulusan::simpan_setting');
        $routes->post('update_setting/(:num)', 'Admin\Kelulusan::update_setting/$1');
        $routes->get('data', 'Admin\Kelulusan::data');
        $routes->post('simpan_data', 'Admin\Kelulusan::simpan_data');
        $routes->post('update_data/(:num)', 'Admin\Kelulusan::update_data/$1');
        $routes->get('hapus_data/(:num)', 'Admin\Kelulusan::hapus_data/$1');
    });

    $routes->group('kepegawaian', static function ($routes) {
        $routes->get('riwayat_pendidikan', 'Admin\Kepegawaian::riwayat_pendidikan');
        $routes->post('simpan_riwayat_pendidikan', 'Admin\Kepegawaian::simpan_riwayat_pendidikan');
        $routes->post('update_riwayat_pendidikan/(:num)', 'Admin\Kepegawaian::update_riwayat_pendidikan/$1');
        $routes->get('hapus_riwayat_pendidikan/(:num)', 'Admin\Kepegawaian::hapus_riwayat_pendidikan/$1');
        $routes->get('riwayat_pangkat', 'Admin\Kepegawaian::riwayat_pangkat');
        $routes->post('simpan_riwayat_pangkat', 'Admin\Kepegawaian::simpan_riwayat_pangkat');
        $routes->post('update_riwayat_pangkat/(:num)', 'Admin\Kepegawaian::update_riwayat_pangkat/$1');
        $routes->get('hapus_riwayat_pangkat/(:num)', 'Admin\Kepegawaian::hapus_riwayat_pangkat/$1');
        $routes->get('sertifikasi', 'Admin\Kepegawaian::sertifikasi');
        $routes->post('simpan_sertifikasi', 'Admin\Kepegawaian::simpan_sertifikasi');
        $routes->post('update_sertifikasi/(:num)', 'Admin\Kepegawaian::update_sertifikasi/$1');
        $routes->get('hapus_sertifikasi/(:num)', 'Admin\Kepegawaian::hapus_sertifikasi/$1');
        $routes->get('beban_kerja', 'Admin\Kepegawaian::beban_kerja');
        $routes->post('simpan_beban_kerja', 'Admin\Kepegawaian::simpan_beban_kerja');
        $routes->post('update_beban_kerja/(:num)', 'Admin\Kepegawaian::update_beban_kerja/$1');
        $routes->get('hapus_beban_kerja/(:num)', 'Admin\Kepegawaian::hapus_beban_kerja/$1');
    });

    $routes->group('kesiswaan', static function ($routes) {
        $routes->get('eskul', 'Admin\Kesiswaan::eskul');
        $routes->post('simpan_eskul', 'Admin\Kesiswaan::simpan_eskul');
        $routes->post('update_eskul/(:num)', 'Admin\Kesiswaan::update_eskul/$1');
        $routes->get('hapus_eskul/(:num)', 'Admin\Kesiswaan::hapus_eskul/$1');
        $routes->get('prestasi', 'Admin\Kesiswaan::prestasi');
        $routes->post('simpan_prestasi', 'Admin\Kesiswaan::simpan_prestasi');
        $routes->post('update_prestasi/(:num)', 'Admin\Kesiswaan::update_prestasi/$1');
        $routes->get('hapus_prestasi/(:num)', 'Admin\Kesiswaan::hapus_prestasi/$1');
        $routes->get('disiplin', 'Admin\Kesiswaan::disiplin');
        $routes->post('simpan_disiplin', 'Admin\Kesiswaan::simpan_disiplin');
        $routes->post('update_disiplin/(:num)', 'Admin\Kesiswaan::update_disiplin/$1');
        $routes->get('hapus_disiplin/(:num)', 'Admin\Kesiswaan::hapus_disiplin/$1');
        $routes->get('organisasi', 'Admin\Kesiswaan::organisasi');
        $routes->post('simpan_organisasi', 'Admin\Kesiswaan::simpan_organisasi');
        $routes->post('update_organisasi/(:num)', 'Admin\Kesiswaan::update_organisasi/$1');
        $routes->get('hapus_organisasi/(:num)', 'Admin\Kesiswaan::hapus_organisasi/$1');
        $routes->get('bk', 'Admin\Kesiswaan::bk');
        $routes->post('simpan_bk', 'Admin\Kesiswaan::simpan_bk');
        $routes->post('update_bk/(:num)', 'Admin\Kesiswaan::update_bk/$1');
        $routes->get('hapus_bk/(:num)', 'Admin\Kesiswaan::hapus_bk/$1');
    });

    $routes->group('keuangan', static function ($routes) {
        $routes->get('bos', 'Admin\Keuangan::bos');
        $routes->post('simpan_bos', 'Admin\Keuangan::simpan_bos');
        $routes->post('update_bos/(:num)', 'Admin\Keuangan::update_bos/$1');
        $routes->get('hapus_bos/(:num)', 'Admin\Keuangan::hapus_bos/$1');
        $routes->get('pengeluaran', 'Admin\Keuangan::pengeluaran');
        $routes->post('simpan_pengeluaran', 'Admin\Keuangan::simpan_pengeluaran');
        $routes->post('update_pengeluaran/(:num)', 'Admin\Keuangan::update_pengeluaran/$1');
        $routes->get('hapus_pengeluaran/(:num)', 'Admin\Keuangan::hapus_pengeluaran/$1');
        $routes->get('laporan', 'Admin\Keuangan::laporan');
        $routes->get('laporan/cetak_pdf', 'Admin\Keuangan::cetak_laporan_pdf');
        $routes->get('laporan/cetak_excel', 'Admin\Keuangan::cetak_laporan_excel');
    });

    $routes->group('sarpras', static function ($routes) {
        $routes->get('ruang', 'Admin\Sarpras::ruang');
        $routes->post('simpan_ruang', 'Admin\Sarpras::simpan_ruang');
        $routes->post('update_ruang/(:num)', 'Admin\Sarpras::update_ruang/$1');
        $routes->get('hapus_ruang/(:num)', 'Admin\Sarpras::hapus_ruang/$1');
        $routes->get('kondisi', 'Admin\Sarpras::kondisi');
        $routes->post('simpan_kondisi', 'Admin\Sarpras::simpan_kondisi');
        $routes->post('update_kondisi/(:num)', 'Admin\Sarpras::update_kondisi/$1');
        $routes->get('hapus_kondisi/(:num)', 'Admin\Sarpras::hapus_kondisi/$1');
        $routes->get('barang', 'Admin\Sarpras::barang');
        $routes->post('simpan_barang', 'Admin\Sarpras::simpan_barang');
        $routes->post('update_barang/(:num)', 'Admin\Sarpras::update_barang/$1');
        $routes->get('hapus_barang/(:num)', 'Admin\Sarpras::hapus_barang/$1');
        $routes->get('kerusakan', 'Admin\Sarpras::kerusakan');
        $routes->post('simpan_kerusakan', 'Admin\Sarpras::simpan_kerusakan');
        $routes->post('update_kerusakan/(:num)', 'Admin\Sarpras::update_kerusakan/$1');
        $routes->get('hapus_kerusakan/(:num)', 'Admin\Sarpras::hapus_kerusakan/$1');
    });

    $routes->group('administrasi', static function ($routes) {
        $routes->get('kode_surat', 'Admin\Administrasi::kode_surat');
        $routes->post('simpan_kode_surat', 'Admin\Administrasi::simpan_kode_surat');
        $routes->post('update_kode_surat/(:num)', 'Admin\Administrasi::update_kode_surat/$1');
        $routes->get('hapus_kode_surat/(:num)', 'Admin\Administrasi::hapus_kode_surat/$1');
        $routes->get('sifat_surat', 'Admin\Administrasi::sifat_surat');
        $routes->post('simpan_sifat_surat', 'Admin\Administrasi::simpan_sifat_surat');
        $routes->post('update_sifat_surat/(:num)', 'Admin\Administrasi::update_sifat_surat/$1');
        $routes->get('hapus_sifat_surat/(:num)', 'Admin\Administrasi::hapus_sifat_surat/$1');
        $routes->get('surat_masuk', 'Admin\Administrasi::surat_masuk');
        $routes->post('simpan_surat_masuk', 'Admin\Administrasi::simpan_surat_masuk');
        $routes->post('update_surat_masuk/(:num)', 'Admin\Administrasi::update_surat_masuk/$1');
        $routes->get('hapus_surat_masuk/(:num)', 'Admin\Administrasi::hapus_surat_masuk/$1');
        $routes->get('surat_keluar', 'Admin\Administrasi::surat_keluar');
        $routes->post('simpan_surat_keluar', 'Admin\Administrasi::simpan_surat_keluar');
        $routes->post('update_surat_keluar/(:num)', 'Admin\Administrasi::update_surat_keluar/$1');
        $routes->get('hapus_surat_keluar/(:num)', 'Admin\Administrasi::hapus_surat_keluar/$1');
    });
});

$routes->group('guru', ['filter' => 'guru'], static function ($routes) {
    $routes->get('dashboard', 'Guru\Dashboard::index');
    $routes->get('profil', 'Guru\Profil::index');
    $routes->post('profil/update', 'Guru\Profil::update');
    
    $routes->group('akademik', static function ($routes) {
        $routes->get('jadwal', 'Guru\Akademik::jadwal');
        $routes->get('data_kelas', 'Guru\Akademik::data_kelas');
        $routes->get('data_siswa/(:num)', 'Guru\Akademik::data_siswa/$1');
        $routes->get('input_nilai', 'Guru\Akademik::input_nilai');
        $routes->post('simpan_nilai', 'Guru\Akademik::simpan_nilai');
        $routes->post('update_nilai/(:num)', 'Guru\Akademik::update_nilai/$1');
        $routes->get('hapus_nilai/(:num)', 'Guru\Akademik::hapus_nilai/$1');
        $routes->post('import_nilai', 'Guru\Akademik::import_nilai');
    });

    $routes->group('informasi', static function ($routes) {
        $routes->get('berita', 'Guru\Informasi::berita');
        $routes->post('simpan_berita', 'Guru\Informasi::simpan_berita');
        $routes->post('update_berita/(:num)', 'Guru\Informasi::update_berita/$1');
        $routes->get('hapus_berita/(:num)', 'Guru\Informasi::hapus_berita/$1');
        $routes->get('pengumuman', 'Guru\Informasi::pengumuman');
        $routes->post('simpan_pengumuman', 'Guru\Informasi::simpan_pengumuman');
        $routes->post('update_pengumuman/(:num)', 'Guru\Informasi::update_pengumuman/$1');
        $routes->get('hapus_pengumuman/(:num)', 'Guru\Informasi::hapus_pengumuman/$1');
    });

    $routes->group('kepegawaian', static function ($routes) {
        $routes->get('riwayat', 'Guru\Kepegawaian::riwayat');
        $routes->post('simpan_riwayat', 'Guru\Kepegawaian::simpan_riwayat');
        $routes->post('update_riwayat/(:num)', 'Guru\Kepegawaian::update_riwayat/$1');
        $routes->get('hapus_riwayat/(:num)', 'Guru\Kepegawaian::hapus_riwayat/$1');
        $routes->get('sertifikasi', 'Guru\Kepegawaian::sertifikasi');
        $routes->post('simpan_sertifikasi', 'Guru\Kepegawaian::simpan_sertifikasi');
        $routes->post('update_sertifikasi/(:num)', 'Guru\Kepegawaian::update_sertifikasi/$1');
        $routes->get('hapus_sertifikasi/(:num)', 'Guru\Kepegawaian::hapus_sertifikasi/$1');
        $routes->get('beban_kerja', 'Guru\Kepegawaian::beban_kerja');
    });
});

$routes->group('walikelas', ['filter' => 'walikelas'], static function ($routes) {
    $routes->get('dashboard', 'Walikelas\Dashboard::index');
    $routes->get('profil', 'Walikelas\Profil::index');
    $routes->post('profil/update', 'Walikelas\Profil::update');
    
    $routes->group('akademik', static function ($routes) {
        $routes->get('data_kelas', 'Walikelas\Akademik::data_kelas');
        $routes->get('data_siswa', 'Walikelas\Akademik::data_siswa');
        $routes->get('data_siswa/(:num)', 'Walikelas\Akademik::data_siswa/$1');
        $routes->get('jadwal', 'Walikelas\Akademik::jadwal');
        $routes->get('pantau_nilai', 'Walikelas\Akademik::pantau_nilai');
        $routes->get('cetak_rapor', 'Walikelas\Akademik::cetak_rapor');
        $routes->get('input_nilai', 'Walikelas\Akademik::input_nilai');
        $routes->post('simpan_nilai', 'Walikelas\Akademik::simpan_nilai');
        $routes->post('update_nilai/(:num)', 'Walikelas\Akademik::update_nilai/$1');
        $routes->get('hapus_nilai/(:num)', 'Walikelas\Akademik::hapus_nilai/$1');
        $routes->post('import_nilai', 'Walikelas\Akademik::import_nilai');
    });

    $routes->group('informasi', static function ($routes) {
        $routes->get('berita', 'Walikelas\Informasi::berita');
        $routes->post('simpan_berita', 'Walikelas\Informasi::simpan_berita');
        $routes->post('update_berita/(:num)', 'Walikelas\Informasi::update_berita/$1');
        $routes->get('hapus_berita/(:num)', 'Walikelas\Informasi::hapus_berita/$1');
        $routes->get('pengumuman', 'Walikelas\Informasi::pengumuman');
        $routes->post('simpan_pengumuman', 'Walikelas\Informasi::simpan_pengumuman');
        $routes->post('update_pengumuman/(:num)', 'Walikelas\Informasi::update_pengumuman/$1');
        $routes->get('hapus_pengumuman/(:num)', 'Walikelas\Informasi::hapus_pengumuman/$1');
    });

    $routes->group('kepegawaian', static function ($routes) {
        $routes->get('riwayat', 'Walikelas\Kepegawaian::riwayat');
        $routes->post('simpan_riwayat', 'Walikelas\Kepegawaian::simpan_riwayat');
        $routes->post('update_riwayat/(:num)', 'Walikelas\Kepegawaian::update_riwayat/$1');
        $routes->get('hapus_riwayat/(:num)', 'Walikelas\Kepegawaian::hapus_riwayat/$1');
        $routes->get('sertifikasi', 'Walikelas\Kepegawaian::sertifikasi');
        $routes->post('simpan_sertifikasi', 'Walikelas\Kepegawaian::simpan_sertifikasi');
        $routes->post('update_sertifikasi/(:num)', 'Walikelas\Kepegawaian::update_sertifikasi/$1');
        $routes->get('hapus_sertifikasi/(:num)', 'Walikelas\Kepegawaian::hapus_sertifikasi/$1');
        $routes->get('beban_kerja', 'Walikelas\Kepegawaian::beban_kerja');
    });
});

$routes->group('siswa', ['filter' => 'siswa'], static function ($routes) {
    $routes->get('dashboard', 'Siswa\Dashboard::index');
    $routes->get('profil', 'Siswa\Profil::index');
    $routes->post('profil/update', 'Siswa\Profil::update');
    
    $routes->group('rapor', static function ($routes) {
        $routes->get('cetak_rapor', 'Siswa\Rapor::cetak_rapor');
    });
});