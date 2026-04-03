<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPengumModel extends Model
{
    protected $table            = 'kategori_pengumuman';
    protected $primaryKey       = 'id_kategori_p';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kategori'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}