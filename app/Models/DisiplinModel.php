<?php

namespace App\Models;

use CodeIgniter\Model;

class DisiplinModel extends Model
{
    protected $table            = 'kedisiplinan';
    protected $primaryKey       = 'id_disiplin';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_pelanggaran', 'poin'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}