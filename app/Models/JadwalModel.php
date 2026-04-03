<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal_pelajaran';
    protected $primaryKey       = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'hari', 'id_mapel', 'id_guru', 'jam_mulai', 'jam_selesai'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}