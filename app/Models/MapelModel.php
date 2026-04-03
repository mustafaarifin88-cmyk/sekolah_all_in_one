<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table            = 'mapel';
    protected $primaryKey       = 'id_mapel';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_mapel'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}