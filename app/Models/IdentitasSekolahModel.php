<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentitasSekolahModel extends Model
{
    protected $table            = 'identitas_sekolah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_sekolah', 'logo_sekolah', 'alamat_sekolah', 'logo_pemda', 
        'nama_dinas', 'foto_kepsek', 'nama_kepsek', 'nip_kepsek', 
        'sk_kepsek', 'ttd_kepsek', 'visi_misi', 'tema_header'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}