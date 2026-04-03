<?php

namespace App\Models;

use CodeIgniter\Model;

class SetMapelGuruModel extends Model
{
    protected $table            = 'set_mapel_guru';
    protected $primaryKey       = 'id_set_mapel';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'id_kelas', 'id_mapel', 'hari', 'jam_mulai', 'jam_selesai'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}