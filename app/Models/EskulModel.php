<?php

namespace App\Models;

use CodeIgniter\Model;

class EskulModel extends Model
{
    protected $table            = 'eskul';
    protected $primaryKey       = 'id_eskul';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_eskul'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}