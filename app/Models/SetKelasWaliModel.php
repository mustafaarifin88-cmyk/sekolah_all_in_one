<?php

namespace App\Models;

use CodeIgniter\Model;

class SetKelasWaliModel extends Model
{
    protected $table            = 'set_kelas_wali';
    protected $primaryKey       = 'id_set_wali';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'id_kelas'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}