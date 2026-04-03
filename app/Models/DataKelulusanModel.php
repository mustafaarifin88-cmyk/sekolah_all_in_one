<?php

namespace App\Models;

use CodeIgniter\Model;

class DataKelulusanModel extends Model
{
    protected $table            = 'data_kelulusan';
    protected $primaryKey       = 'id_lulus';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_siswa', 'nomor_ujian', 'status_kelulusan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}