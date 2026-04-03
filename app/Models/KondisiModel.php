<?php

namespace App\Models;

use CodeIgniter\Model;

class KondisiModel extends Model
{
    protected $table            = 'kondisi';
    protected $primaryKey       = 'id_kondisi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kondisi'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}