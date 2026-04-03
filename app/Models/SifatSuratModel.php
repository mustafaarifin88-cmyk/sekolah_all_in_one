<?php

namespace App\Models;

use CodeIgniter\Model;

class SifatSuratModel extends Model
{
    protected $table            = 'sifat_surat';
    protected $primaryKey       = 'id_sifat_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sifat', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}