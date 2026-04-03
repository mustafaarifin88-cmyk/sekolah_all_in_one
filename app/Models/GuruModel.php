<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru_tendik';
    protected $primaryKey       = 'id_guru';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap', 'gelar_depan', 'gelar_belakang', 'jenis_kelamin', 
        'status_pegawai', 'nip', 'nikki', 'nuptk', 'no_kk', 'nik', 
        'alamat_lengkap', 'no_hp', 'no_sk_pengangkatan', 'tgl_sk_pengangkatan', 
        'tahun_sk_pengangkatan', 'no_npwp'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}