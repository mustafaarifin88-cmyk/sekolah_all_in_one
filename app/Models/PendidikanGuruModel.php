<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanGuruModel extends Model
{
    protected $table            = 'riwayat_pendidikan_guru';
    protected $primaryKey       = 'id_riwayat_pdd';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'asal_sekolah', 'jurusan', 'tahun_lulus'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}