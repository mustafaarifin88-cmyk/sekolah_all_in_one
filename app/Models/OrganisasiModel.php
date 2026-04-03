<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table            = 'organisasi';
    protected $primaryKey       = 'id_organisasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_organisasi'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}