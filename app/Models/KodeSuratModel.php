<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeSuratModel extends Model
{
    protected $table            = 'kode_surat';
    protected $primaryKey       = 'id_kode_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}