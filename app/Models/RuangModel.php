<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangModel extends Model
{
    protected $table            = 'ruang';
    protected $primaryKey       = 'id_ruang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_ruang'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}