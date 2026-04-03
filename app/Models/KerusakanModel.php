<?php

namespace App\Models;

use CodeIgniter\Model;

class KerusakanModel extends Model
{
    protected $table            = 'kerusakan_barang';
    protected $primaryKey       = 'id_kerusakan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang', 'tingkat_kondisi', 'tanggal_lapor', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}