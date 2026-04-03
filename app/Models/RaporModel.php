<?php

namespace App\Models;

use CodeIgniter\Model;

class RaporModel extends Model
{
    protected $table            = 'nilai_rapor';
    protected $primaryKey       = 'id_nilai';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_siswa', 'id_kelas', 'id_mapel', 'id_guru', 'semester', 'tahun_ajaran', 'nilai'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}