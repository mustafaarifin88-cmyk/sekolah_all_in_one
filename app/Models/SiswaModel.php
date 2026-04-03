<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kelas', 'nama_siswa', 'nis', 'nisn', 'tempat_lahir', 'tanggal_lahir', 
        'jenis_pendaftaran', 'asal_sd', 'no_ijazah_sd', 'tahun_ijazah_sd', 
        'no_shun_sd', 'tahun_shun_sd', 'asal_smp_sebelumnya', 'no_ijazah_smp', 
        'tahun_ijazah_smp', 'no_shun_smp', 'tahun_shun_smp', 'nama_orang_tua', 
        'pekerjaan_orang_tua', 'penghasilan_orang_tua'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}